<section class="py-4">
    <x-posts.featured-post :post="$this->featuredPost" />
    <div class="max-w-screen-xl mx-auto px-4" >
        <x-posts.featured-posts title="Headline" :posts="$this->headlinePosts" class="my-4" />
        <x-posts.featured-posts title="Now You Know" :posts="$this->nowYouKnowPosts" class="my-4" />
        <x-posts.featured-posts title="Soul Nutrient" :posts="$this->soultNutrientPosts" class="my-4" />
        <x-posts.featured-posts title="Big Shift" :posts="$this->bigShiftPosts" class="my-4" />
        <x-posts.featured-posts title="Pop Culture" :posts="$this->popCulturePosts" class="my-4" />
        <x-posts.featured-posts title="Human of Change" :posts="$this->humanOfChangePosts" class="my-4" />
        <x-posts.featured-posts title="Social Podium" :posts="$this->socialPodiumPosts" class="my-4" />
    </div>
</section>
