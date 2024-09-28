<?php

namespace App\Models;

use App\Enums\PostStatus;
use App\Filament\Resources\PostResource;
use Awcodes\Curator\Components\Forms\CuratorPicker;
use Awcodes\Curator\Models\Media;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Set;
use FilamentTiptapEditor\TiptapEditor;
use Google\Analytics\Data\V1beta\Filter;
use Google\Analytics\Data\V1beta\Filter\StringFilter\MatchType;
use Google\Analytics\Data\V1beta\FilterExpression;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;
use Spatie\Analytics\Facades\Analytics;
use Spatie\Analytics\Period;

class Post extends Model implements Auditable
{
    use HasFactory, SoftDeletes, AuditableTrait;

    // Attributes
    protected $fillable = [
        'title',
        'slug',
        'sub_title',
        'body',
        'is_featured',
        'media_id',
        'status',
        'published_at',
        'scheduled_for',
        'user_id',
    ];

    protected $dates = [
        'scheduled_for',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'published_at' => 'datetime',
        'scheduled_for' => 'datetime',
        'status' => PostStatus::class,
    ];

    // Relationships
    public function categories(): BelongsToMany
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

    public function media(): BelongsTo
    {
        return $this->belongsTo(Media::class, 'media_id', 'id');
    }

    // Accessors
    protected function getMediaUrlAttribute()
    {
        return Storage::url($this->media->path);
    }

    public function getReadTimeAttribute()
    {
        $wordCount = str_word_count(strip_tags(tiptap_converter()->asText($this->body)));
        $wordsPerMinute = 200;
        $readTime = ceil($wordCount / $wordsPerMinute);

        return $readTime;
    }

    public function getUrlAttribute()
    {
        return route('post.show', ['slug' => $this->slug]);
    }

    public function getEditUrlAttribute()
    {
        return PostResource::getUrl('edit', ['record' => $this]);
    }

    // Mutators
    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    // Methods
    public function excerpt($length = 150)
    {
        $content = tiptap_converter()->asText($this->attributes['body']);

        return substr($content, 0, $length);
    }

    public function firstCategory()
    {
        return $this->categories->first();
    }

    public function fetchViews()
{
    if (isset($this->published_at)) {
        return Cache::remember("post_views_{$this->slug}", now()->addHours(1), function () {
            $analytics = Analytics::get(
                period: Period::create($this->published_at, now()),
                metrics: ['screenPageViews'],
                dimensions: ['pagePath'],
                dimensionFilter: (new FilterExpression())->setFilter(
                    (new Filter())->setFieldName('pagePath')->setStringFilter(
                        (new Filter\StringFilter())->setMatchType(MatchType::BEGINS_WITH)->setValue('/' . $this->slug)
                    )
                )
            );

            return $analytics->sum('screenPageViews') ?? 0;
        });
    }
    return 0;
}


    // Scopes
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

    public function isNotPublished()
    {
        return !$this->isStatusPublished();
    }

    public function isScheduled()
    {
        return $this->status === PostStatus::SCHEDULED;
    }

    public function isStatusPublished()
    {
        return $this->status === PostStatus::PUBLISHED;
    }

    public static function getForm()
    {
        return [
            TextInput::make('title')
                ->live(true)
                ->afterStateUpdated(fn(Set $set, ?string $state) => $set(
                    'slug',
                    Str::slug($state)
                ))
                ->required()
                ->unique(ignoreRecord: true)
                ->maxLength(255),

            TextInput::make('slug')
                ->required()
                ->maxLength(255),

            Textarea::make('sub_title')
                ->maxLength(255)
                ->columnSpanFull(),

            Select::make('category_id')
                ->required()
                ->label('Category')
                ->preload()
                ->createOptionForm(Category::getForm())
                ->searchable()
                ->relationship('categories', 'name'),

            Select::make('tag_id')
                ->required()
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

            CuratorPicker::make('media_id')
                ->label('Media')
                ->required(),

            Toggle::make('is_featured')
                ->inline(false)
                ->columnSpanFull(),

            Fieldset::make()
                ->schema([
                    ToggleButtons::make('status')
                        ->live()
                        ->inline()
                        ->options(PostStatus::class)
                        ->required(),

                    DateTimePicker::make('scheduled_for')
                        ->visible(fn($get) => $get('status') === PostStatus::SCHEDULED->value)
                        ->required(fn($get) => $get('status') === PostStatus::SCHEDULED->value)
                        ->native(false),
                ]),

            Select::make('user_id')
                ->relationship('user')
                ->getOptionLabelFromRecordUsing(fn(Model $record) => $record->name)
                ->searchable(['firstname', 'lastname'])
                ->required()
                ->default(auth()->id())
                ->columnSpanFull(),
        ];
    }
}
