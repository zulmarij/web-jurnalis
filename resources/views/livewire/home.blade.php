<section class="py-4">
    <x-posts.featured-post :post="$this->featuredPost" />
    <div class="max-w-screen-xl mx-auto px-4" >
        <x-posts.featured-posts title="Berita" :posts="$this->beritaPosts" class="mb-4" />
        <x-posts.featured-posts title="Edukasi" :posts="$this->edukasiPosts" class="mb-4" />
        <x-posts.featured-posts title="Inspirasi" :posts="$this->inspirasiPosts" class="mb-4" />
        <x-posts.featured-posts title="Inovasi" :posts="$this->inovasiPosts" class="mb-4" />
        <x-posts.featured-posts title="Hiburan" :posts="$this->hiburanPosts" class="mb-4" />
    </div>
</section>
