<?php

namespace App\Models;

use App\Enums\PostStatus;
use Awcodes\Curator\Components\Forms\CuratorPicker;
use Awcodes\Curator\Models\Media;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Set;
use FilamentTiptapEditor\TiptapEditor;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class Post extends Model implements Auditable
{
    use HasFactory, SoftDeletes, AuditableTrait;

    protected $fillable = [
        'title',
        'slug',
        'sub_title',
        'body',
        'image_id',
        'status',
        'published_at',
        'scheduled_for',
        'user_id',
    ];

    protected $dates = [
        'scheduled_for',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'scheduled_for' => 'datetime',
        'status' => PostStatus::class,
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_post');
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'post_tag');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function seoDetail()
    {
        return $this->hasOne(SeoDetail::class);
    }

    public function image(): BelongsTo
    {
        return $this->belongsTo(Media::class);
    }

    public function isNotPublished()
    {
        return !$this->isStatusPublished();
    }

    public function scopePublished(Builder $query)
    {
        return $query->where('status', PostStatus::PUBLISHED)->latest('published_at');
    }

    public function scopeScheduled(Builder $query)
    {
        return $query->where('status', PostStatus::SCHEDULED)->latest('scheduled_for');
    }

    public function scopePending(Builder $query)
    {
        return $query->where('status', PostStatus::PENDING)->latest('created_at');
    }

    public function formattedPublishedDate()
    {
        return $this->published_at?->format('d M Y');
    }

    public function isScheduled()
    {
        return $this->status === PostStatus::SCHEDULED;
    }

    public function isStatusPublished()
    {
        return $this->status === PostStatus::PUBLISHED;
    }

    protected function getImageUrlAttribute()
    {
        return Storage::url($this->image->path);;
    }

    public function relatedPosts($take = 3)
    {
        return $this->whereHas('categories', function ($query) {
            $query->whereIn('categories.id', $this->categories->pluck('id'))
                ->whereNotIn('posts.id', [$this->id]);
        })->published()->with('user')->take($take)->get();
    }

    public static function getForm()
    {
        return [
            TextInput::make('title')
                ->live(true)
                ->afterStateUpdated(fn (Set $set, ?string $state) => $set(
                    'slug',
                    Str::slug($state)
                ))
                ->required()
                ->unique(ignoreRecord: true)
                ->maxLength(255),

            TextInput::make('slug')
                ->maxLength(255),

            // Textarea::make('sub_title')
            //     ->maxLength(255),

            Select::make('category_id')
                ->multiple()
                ->preload()
                ->createOptionForm(Category::getForm())
                ->searchable()
                ->relationship('categories', 'name'),

            Select::make('tag_id')
                ->multiple()
                ->preload()
                ->createOptionForm(Tag::getForm())
                ->searchable()
                ->relationship('tags', 'name'),

            TiptapEditor::make('body')
                ->profile('default')
                ->extraInputAttributes(['style' => 'max-height: 30rem; min-height: 24rem'])
                ->required()
                ->columnSpanFull(),

            CuratorPicker::make('image_id')
                ->label('Featured Image'),

            Fieldset::make()
                ->schema([
                    ToggleButtons::make('status')
                        ->live()
                        ->inline()
                        ->options(PostStatus::class)
                        ->required(),

                    DateTimePicker::make('scheduled_for')
                        ->visible(function ($get) {
                            return $get('status') === PostStatus::SCHEDULED->value;
                        })
                        ->required(function ($get) {
                            return $get('status') === PostStatus::SCHEDULED->value;
                        })
                        ->native(false),
                ]),

            Select::make('user_id')
                ->relationship('user')
                ->getOptionLabelFromRecordUsing(fn (Model $record) => $record->name)
                ->searchable(['firstname', 'lastname'])
                ->required()
                ->default(auth()->id())
                ->columnSpanFull(),
        ];
    }
}
