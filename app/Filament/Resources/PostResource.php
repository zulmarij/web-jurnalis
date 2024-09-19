<?php

namespace App\Filament\Resources;

use App\Enums\PostStatus;
use App\Filament\Resources\PostResource\Pages\CreatePost;
use App\Filament\Resources\PostResource\Pages\EditPost;
use App\Filament\Resources\PostResource\Pages\ListPosts;
use App\Filament\Resources\PostResource\Pages\ManaePostSeoDetail;
use App\Filament\Resources\PostResource\Pages\ManagePostComments;
use App\Filament\Resources\PostResource\Pages\ViewPost;
use App\Filament\Resources\PostResource\RelationManagers\CommentsRelationManager;
use App\Filament\Resources\PostResource\RelationManagers\SeoDetailRelationManager;
use App\Models\Post;
use App\Filament\Tables\Columns\UserAvatarName;
use Awcodes\Curator\Components\Tables\CuratorColumn;
use BezhanSalleh\FilamentShield\Contracts\HasShieldPermissions;
use Filament\Forms\Form;
use Filament\Infolists\Components\Fieldset;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Pages\Page;
use Filament\Pages\SubNavigationPosition;
use Filament\Resources\Resource;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ForceDeleteBulkAction;
use Filament\Tables\Actions\RestoreBulkAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;
use Spatie\Analytics\Analytics;
use Spatie\Analytics\Period;
use Tapp\FilamentAuditing\RelationManagers\AuditsRelationManager;

class PostResource extends Resource implements HasShieldPermissions
{
    protected static ?string $model = Post::class;
    protected static ?string $navigationIcon = 'heroicon-o-document-minus';
    protected static ?string $navigationGroup = 'Content Management';
    protected static ?string $recordTitleAttribute = 'title';
    protected static ?int $navigationSort = -4;
    protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;

    public static function getPermissionPrefixes(): array
    {
        return [
            'view',
            'view_any',
            'create',
            'update',
            'restore',
            'restore_any',
            'delete',
            'delete_any',
            'force_delete',
            'force_delete_any',
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return strval(Post::count());
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema(Post::getForm());
    }

    public static function table(Table $table): Table
    {
        return $table
            ->deferLoading()
            ->columns([
                CuratorColumn::make('media')
                    ->size(32),

                TextColumn::make('title')
                    ->description(function (Post $record) {
                        return Str::limit($record->sub_title, 40);
                    })
                    ->searchable()->limit(40),
                TextColumn::make('status')
                    ->badge()
                    ->color(function ($state) {
                        return $state->getColor();
                    }),

                UserAvatarName::make('user')
                    ->label('Author'),

                TextColumn::make('pageviews')
                    ->label('Views')
                    ->formatStateUsing(function ($state, $record) {
                        $analytics = app(Analytics::class);
                        $urlPath = $record->slug;

                        $startDate = $record->created_at->format('Y-m-d');
                        $endDate = now()->format('Y-m-d');

                        $results = $analytics->performQuery(
                            Period::between($startDate, $endDate),
                            'ga:pageviews',
                            [
                                'dimensions' => 'ga:pagePath',
                                'filters' => 'ga:pagePath==' . $urlPath
                            ]
                        );

                        return $results->totalsForAllResults['ga:pageviews'] ?? 0;
                    }),

                TextColumn::make('created_at')
                    ->date()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->date()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('deleted_at')
                    ->date()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])->defaultSort('id', 'desc')
            ->filters([
                SelectFilter::make('user.name')
                    ->searchable()
                    ->preload()
                    ->multiple(),
                TrashedFilter::make(),
            ])
            ->actions([
                ActionGroup::make([
                    Action::make('view')
                        ->label('View')
                        ->requiresConfirmation()
                        ->icon('heroicon-o-eye')
                        ->url(fn($record) => $record->url)
                        ->extraAttributes(['target' => '_blank']),
                    EditAction::make(),
                    // ViewAction::make(),
                ]),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                ]),
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist->schema([
            Section::make('Post')
                ->schema([
                    Fieldset::make('General')
                        ->schema([
                            TextEntry::make('title'),
                            TextEntry::make('slug'),
                            TextEntry::make('sub_title'),
                        ]),
                    Fieldset::make('Publish Information')
                        ->schema([
                            TextEntry::make('status')
                                ->badge()->color(function ($state) {
                                    return $state->getColor();
                                }),
                            TextEntry::make('published_at')->visible(function (Post $record) {
                                return $record->status === PostStatus::PUBLISHED;
                            }),

                            TextEntry::make('scheduled_for')->visible(function (Post $record) {
                                return $record->status === PostStatus::SCHEDULED;
                            }),
                        ]),
                    Fieldset::make('Description')
                        ->schema([
                            TextEntry::make('body')
                                ->html()
                                ->columnSpanFull(),
                        ]),
                ]),
        ]);
    }

    public static function getRecordSubNavigation(Page $page): array
    {
        return $page->generateNavigationItems([
            EditPost::class,
            // ViewPost::class,
            ManaePostSeoDetail::class,
            ManagePostComments::class,
        ]);
    }
    public static function getRelations(): array
    {
        return [
            SeoDetailRelationManager::class,
            CommentsRelationManager::class,
            AuditsRelationManager::class,
        ];
    }


    public static function getPages(): array
    {
        return [
            'index' => ListPosts::route('/'),
            'create' => CreatePost::route('/create'),
            'edit' => EditPost::route('/{record}/edit'),
            // 'view' => ViewPost::route('/{record}'),
            'comments' => ManagePostComments::route('/{record}/comments'),
            'seoDetail' => ManaePostSeoDetail::route('/{record}/seo-details'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
