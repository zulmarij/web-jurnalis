<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Category;
use App\Models\Comment;
use App\Models\NewsLetter;
use App\Models\Post;
use App\Models\SeoDetail;
use App\Models\Tag;
use App\Models\User;
use App\Policies\ActivityPolicy;
use App\Policies\CategoryPolicy;
use App\Policies\CommentPolicy;
use App\Policies\ExceptionPolicy;
use App\Policies\NewsLetterPolicy;
use App\Policies\PostPolicy;
use App\Policies\QueueMonitorPolicy;
use App\Policies\RolePolicy;
use App\Policies\SeoDetailPolicy;
use App\Policies\TagPolicy;
use App\Policies\UserPolicy;
use BezhanSalleh\FilamentExceptions\Models\Exception;
use Croustibat\FilamentJobsMonitor\Models\QueueMonitor;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Spatie\Activitylog\Models\Activity;
use Spatie\Permission\Models\Role;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Activity::class => ActivityPolicy::class,
        Category::class => CategoryPolicy::class,
        Comment::class => CommentPolicy::class,
        Exception::class => ExceptionPolicy::class,
        NewsLetter::class => NewsLetterPolicy::class,
        Post::class => PostPolicy::class,
        Role::class => RolePolicy::class,
        SeoDetail::class => SeoDetailPolicy::class,
        Tag::class => TagPolicy::class,
        User::class => UserPolicy::class,
        QueueMonitor::class => QueueMonitorPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}
