<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\URL;
use App\Models\SalarySheet;

class SalarySheetCompleteNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $salarySheet;
    public $approveUrl;

    /**
     * Create a new message instance.
     */
    public function __construct(SalarySheet $salarySheet)
    {
        $this->salarySheet = $salarySheet;
        // Signed URL valid for 7 days — no login required
        $this->approveUrl = URL::signedRoute(
            'salary-sheets.email-approve',
            ['salarySheet' => $salarySheet->id],
            now()->addDays(7)
        );
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Salary Sheet Ready for Review - ' . $this->salarySheet->sheet_no,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.salary-sheet-complete',
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
