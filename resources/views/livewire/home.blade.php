<section class="py-4">
    <x-posts.featured-post :post="$this->featuredPost" />
    <div class="max-w-screen-xl mx-auto px-4" >
        <x-posts.featured-posts title="Berita" :posts="$this->beritaPosts" class="my-4" />
        <x-posts.featured-posts title="Edukasi" :posts="$this->edukasiPosts" class="my-4" />
        <x-posts.featured-posts title="Inspirasi" :posts="$this->inspirasiPosts" class="my-4" />
        <x-posts.featured-posts title="Inovasi" :posts="$this->inovasiPosts" class="my-4" />
        <x-posts.featured-posts title="Hiburan" :posts="$this->hiburanPosts" class="my-4" />
    </div>
</section>
