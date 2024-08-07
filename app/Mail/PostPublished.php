<?php

namespace App\Mail;

use App\Exceptions\CannotSendEmail;
use App\Models\Post;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PostPublished extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(private Post $post, private string $toEmail = '')
    {
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        if ($this->post->isNotPublished()) {
            throw CannotSendEmail::postNotPublished();
        }

        return new Envelope(
            to: $this->toEmail,
            subject: 'New Purchase Mail'
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'mails.blog-published',
            with: ['post' => $this->post]
        );
    }
}
