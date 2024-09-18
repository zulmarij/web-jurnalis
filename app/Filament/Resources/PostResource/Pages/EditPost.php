<?php

namespace App\Filament\Resources\PostResource\Pages;

use App\Concerns\HasPreview;
use App\Enums\PostStatus;
use App\Filament\Resources\PostResource;
use App\Models\Post;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Resources\Pages\EditRecord;
use Pboivin\FilamentPeek\Pages\Actions\PreviewAction;
use Pboivin\FilamentPeek\Pages\Concerns\HasPreviewModal;

class EditPost extends EditRecord
{
    use HasPreview, HasPreviewModal;
    protected static string $resource = PostResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Action::make('view')
            //     ->label('View')
            //     ->url(fn($record) => $record->url)
            //     ->extraAttributes(['target' => '_blank']),
            PreviewAction::make(),
            DeleteAction::make(),
            ForceDeleteAction::make(),
            RestoreAction::make(),
        ];
    }

    protected function beforeSave()
    {
        if ($this->data['status'] === PostStatus::PUBLISHED->value) {
            $this->record->published_at = $this->record->published_at ?? date('Y-m-d H:i:s');
        }
    }

    protected function afterSave(): void
    {
        $this->dispatch('updateAuditsRelationManager');

        if ($this->record->is_featured) {
            Post::where('is_featured', true)
                ->where('id', '!=', $this->record->id)
                ->update(['is_featured' => false]);
        }
    }

    protected function getPreviewModalUrl(): ?string
    {
        $this->generatePreviewSession();

        return route('post.show', [
            'slug' => $this->record->slug,
            'previewToken' => $this->previewToken,
        ]);
    }
}
