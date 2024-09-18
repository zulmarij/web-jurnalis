<section class="py-4">
    @isset($featuredPost)
        <x-posts.featured-post :post="$featuredPost" />
    @endisset
    <div class="max-w-screen-xl mx-auto px-4">
        <x-posts.featured-posts title="Headline" :posts="$headlinePosts" class="my-4" />
        <x-posts.featured-posts title="Now You Know" :posts="$nowYouKnowPosts" class="my-4" />
        <x-posts.featured-posts title="Soul Nutrient" :posts="$soultNutrientPosts" class="my-4" />
        <x-posts.featured-posts title="Big Shift" :posts="$bigShiftPosts" class="my-4" />
        <x-posts.featured-posts title="Pop Culture" :posts="$popCulturePosts" class="my-4" />
        <x-posts.featured-posts title="Human of Change" :posts="$humanOfChangePosts" class="my-4" />
        <x-posts.featured-posts title="Social Podium" :posts="$socialPodiumPosts" class="my-4" />
    </div>
</section>
