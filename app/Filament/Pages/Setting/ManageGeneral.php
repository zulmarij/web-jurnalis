<?php

namespace App\Filament\Pages\Setting;

use App\Services\FileService;
use App\Settings\GeneralSettings;
use BezhanSalleh\FilamentShield\Traits\HasPageShield;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\SettingsPage;
use Filament\Support\Facades\FilamentView;
use Illuminate\Contracts\Support\Htmlable;
use Riodwanto\FilamentAceEditor\AceEditor;

use function Filament\Support\is_app_url;

class ManageGeneral extends SettingsPage
{
    use HasPageShield;
    protected static string $settings = GeneralSettings::class;
    protected static ?int $navigationSort = -2;
    protected static ?string $navigationIcon = 'fluentui-settings-20';
    protected static ?string $navigationGroup = 'Settings';
    protected static ?string $navigationLabel = 'General Settings';

    /**
     * @var array<string, mixed> | null
     */
    public ?array $data = [];

    public string $cssPath = '';
    public string $twConfigPath = '';
    public string $cssAdminPath = '';
    public string $twAdminConfigPath = '';

    public function mount(): void
    {
        $this->cssPath = resource_path('css/app.css');
        $this->twConfigPath = resource_path('css/tailwind.config.js');
        $this->cssAdminPath = resource_path('css/admin.css');
        $this->twAdminConfigPath = resource_path('css/tailwind.admin.js');

        $this->fillForm();
    }

    protected function fillForm(): void
    {
        $settings = app(static::getSettings());

        $data = $this->mutateFormDataBeforeFill($settings->toArray());

        $fileService = new FileService;

        $data['css-editor'] = $fileService->readfile($this->cssPath);
        $data['tw-config-editor'] = $fileService->readfile($this->twConfigPath);
        $data['css-admin-editor'] = $fileService->readfile($this->cssAdminPath);
        $data['tw-admin-config-editor'] = $fileService->readfile($this->twAdminConfigPath);

        $this->form->fill($data);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Site')
                    ->label(fn () => __('page.general_settings.sections.site'))
                    ->description(fn () => __('page.general_settings.sections.site.description'))
                    ->icon('fluentui-web-asset-24-o')
                    ->schema([
                        Forms\Components\Grid::make()->schema([
                            Forms\Components\TextInput::make('site_name')
                                ->label(fn () => __('page.general_settings.fields.site_name'))
                                ->required(),
                            Forms\Components\TextInput::make('site_description')
                                ->label(fn () => __('page.general_settings.fields.site_description'))
                                ->required(),
                        ]),
                        Forms\Components\Grid::make()->schema([
                            Forms\Components\FileUpload::make('site_favicon')
                                ->label(fn () => __('page.general_settings.fields.site_favicon'))
                                ->image()
                                ->directory('sites')
                                ->visibility('public')
                                ->moveFiles()
                                ->acceptedFileTypes(['image/x-icon', 'image/vnd.microsoft.icon'])
                                ->required(),
                            Forms\Components\FileUpload::make('site_logo')
                                ->label(fn () => __('page.general_settings.fields.site_logo'))
                                ->image()
                                ->directory('sites')
                                ->visibility('public')
                                ->moveFiles()
                                ->required(),
                        ]),
                    ]),
                Forms\Components\Tabs::make('Tabs')
                    ->tabs([
                        Forms\Components\Tabs\Tab::make('Color Palette')
                            ->schema([
                                Forms\Components\ColorPicker::make('site_colors.primary')
                                    ->label(fn () => __('page.general_settings.fields.site_colors.primary'))->rgb(),
                                Forms\Components\ColorPicker::make('site_colors.secondary')
                                    ->label(fn () => __('page.general_settings.fields.site_colors.secondary'))->rgb(),
                                Forms\Components\ColorPicker::make('site_colors.gray')
                                    ->label(fn () => __('page.general_settings.fields.site_colors.gray'))->rgb(),
                                Forms\Components\ColorPicker::make('site_colors.success')
                                    ->label(fn () => __('page.general_settings.fields.site_colors.success'))->rgb(),
                                Forms\Components\ColorPicker::make('site_colors.danger')
                                    ->label(fn () => __('page.general_settings.fields.site_colors.danger'))->rgb(),
                                Forms\Components\ColorPicker::make('site_colors.info')
                                    ->label(fn () => __('page.general_settings.fields.site_colors.info'))->rgb(),
                                Forms\Components\ColorPicker::make('site_colors.warning')
                                    ->label(fn () => __('page.general_settings.fields.site_colors.warning'))->rgb(),
                            ])
                            ->columns(3),
                        Forms\Components\Tabs\Tab::make('Code Editor')
                            ->schema([
                                Forms\Components\Grid::make()->schema([
                                    AceEditor::make('css-editor')
                                        ->label('app.css')
                                        ->mode('css')
                                        ->height('24rem'),
                                    AceEditor::make('tw-config-editor')
                                        ->label('tailwind.config.js')
                                        ->height('24rem')
                                ]),

                                Forms\Components\Grid::make()->schema([
                                    AceEditor::make('css-admin-editor')
                                        ->label('admin.css')
                                        ->mode('css')
                                        ->height('24rem'),
                                    AceEditor::make('tw-admin-config-editor')
                                        ->label('tailwind.admin.js')
                                        ->height('24rem')
                                ])
                            ]),
                    ])
                    ->persistTabInQueryString()
                    ->columnSpanFull(),
            ])
            ->columns(3)
            ->statePath('data');
    }

    public function save(): void
    {
        try {
            $data = $this->mutateFormDataBeforeSave($this->form->getState());

            $settings = app(static::getSettings());

            $settings->fill($data);
            $settings->save();

            $fileService = new FileService;
            $fileService->writeFile($this->cssPath, $data['css-editor']);
            $fileService->writeFile($this->twConfigPath, $data['tw-config-editor']);
            $fileService->writeFile($this->cssAdminPath, $data['css-admin-editor']);
            $fileService->writeFile($this->twAdminConfigPath, $data['tw-admin-config-editor']);

            Notification::make()
                ->title('Settings updated.')
                ->success()
                ->send();

            $this->redirect(static::getUrl(), navigate: FilamentView::hasSpaMode() && is_app_url(static::getUrl()));
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public static function getNavigationGroup(): ?string
    {
        return __("menu.nav_group.settings");
    }

    public static function getNavigationLabel(): string
    {
        return __("page.general_settings.navigationLabel");
    }

    public function getTitle(): string|Htmlable
    {
        return __("page.general_settings.title");
    }

    public function getHeading(): string|Htmlable
    {
        return __("page.general_settings.heading");
    }

    public function getSubheading(): string|Htmlable|null
    {
        return __("page.general_settings.subheading");
    }
}
