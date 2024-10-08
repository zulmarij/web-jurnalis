<?php

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
    $trail->push('Home', route('home'));
});


Breadcrumbs::for('post', function (BreadcrumbTrail $trail, $post) {
    $trail->parent('home')->push($post->title, route('post.show', $post));
});

Breadcrumbs::for('preview', function (BreadcrumbTrail $trail, $post) {
    $trail->parent('home')->push($post->title, route('post.preview', $post));
});
