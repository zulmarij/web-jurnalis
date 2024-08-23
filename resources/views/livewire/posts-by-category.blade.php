<section class="max-w-screen-xl p-4 mx-auto">
    <x-posts.section-1 :posts="$this->posts" />

    @if ($this->hasMore())
        <div class="flex justify-center mt-8">
            <button wire:click="loadMore"
                class="inline-flex items-center px-4 py-2 bg-blue-500 text-white font-semibold rounded-lg shadow-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-600"
                wire:loading.attr="disabled">
                <span wire:loading>
                    Loading...
                </span>
                <span wire:loading.remove>
                    Load More
                </span>

            </button>
        </div>
    @endif
</section>
