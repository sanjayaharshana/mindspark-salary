<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\SalarySheet;

class SalarySheetDeclinedNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $salarySheet;
    public $reason;

    /**
     * Create a new message instance.
     */
    public function __construct(SalarySheet $salarySheet, string $reason)
    {
        $this->salarySheet = $salarySheet;
        $this->reason = $reason;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Salary Sheet Declined - ' . $this->salarySheet->sheet_no,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.salary-sheet-declined',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
