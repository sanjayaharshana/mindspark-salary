<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Salary Sheet Declined</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            line-height: 1.6;
            color: #374151;
            background-color: #f3f4f6;
            margin: 0;
            padding: 0;
        }
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
        }
        .email-header {
            background: linear-gradient(135deg, #ef4444 0%, #b91c1c 100%);
            padding: 2rem;
            text-align: center;
            color: #ffffff;
        }
        .email-header h1 {
            margin: 0;
            font-size: 1.5rem;
            font-weight: 600;
        }
        .email-body {
            padding: 2rem;
        }
        .info-box {
            background-color: #fef2f2;
            border-left: 4px solid #ef4444;
            padding: 1rem;
            margin: 1.5rem 0;
            border-radius: 0.375rem;
        }
        .info-box strong {
            color: #1f2937;
            display: block;
            margin-bottom: 0.5rem;
        }
        .info-box span {
            color: #991b1b;
            font-weight: 600;
        }
        .reason-box {
            background-color: #fffbeb;
            border: 1px solid #fcd34d;
            padding: 1rem 1.25rem;
            margin: 1.5rem 0;
            border-radius: 0.5rem;
        }
        .reason-box strong {
            color: #92400e;
            display: block;
            margin-bottom: 0.5rem;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.04em;
        }
        .reason-box p {
            margin: 0;
            color: #78350f;
            white-space: pre-wrap;
        }
        .button-container {
            text-align: center;
            margin: 2rem 0;
        }
        .button {
            display: inline-block;
            padding: 0.75rem 2rem;
            background-color: #ef4444;
            color: #ffffff;
            text-decoration: none;
            border-radius: 0.5rem;
            font-weight: 600;
            transition: background-color 0.2s;
        }
        .button:hover {
            background-color: #b91c1c;
        }
        .email-footer {
            background-color: #f9fafb;
            padding: 1.5rem;
            text-align: center;
            color: #6b7280;
            font-size: 0.875rem;
            border-top: 1px solid #e5e7eb;
        }
        .details-table {
            width: 100%;
            margin: 1.5rem 0;
            border-collapse: collapse;
        }
        .details-table td {
            padding: 0.75rem;
            border-bottom: 1px solid #e5e7eb;
        }
        .details-table td:first-child {
            font-weight: 600;
            color: #374151;
            width: 40%;
        }
        .details-table td:last-child {
            color: #6b7280;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="email-header">
            <h1>Salary Sheet Declined</h1>
        </div>

        <div class="email-body">
            <p>Hello,</p>

            <p>A salary sheet has been declined by the reporter and needs your attention.</p>

            <div class="info-box">
                <strong>Sheet Number:</strong>
                <span>{{ $salarySheet->sheet_no }}</span>
            </div>

            <div class="reason-box">
                <strong>Reason for Decline</strong>
                <p>{{ $reason }}</p>
            </div>

            <table class="details-table">
                <tr>
                    <td>Job Number:</td>
                    <td>{{ $salarySheet->job->job_number ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <td>Job Name:</td>
                    <td>{{ $salarySheet->job->job_name ?? 'N/A' }}</td>
                </tr>
                @if($salarySheet->job && $salarySheet->job->client)
                <tr>
                    <td>Client:</td>
                    <td>{{ $salarySheet->job->client->name ?? 'N/A' }}</td>
                </tr>
                @endif
                <tr>
                    <td>Location:</td>
                    <td>{{ $salarySheet->location ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <td>Status:</td>
                    <td><strong style="color: #dc2626;">Rejected</strong></td>
                </tr>
                <tr>
                    <td>Declined Date:</td>
                    <td>{{ now()->format('F d, Y') }}</td>
                </tr>
                @if($salarySheet->job && $salarySheet->job->reporter)
                <tr>
                    <td>Declined By:</td>
                    <td>{{ $salarySheet->job->reporter->name }}</td>
                </tr>
                @endif
            </table>

            <div class="button-container">
                <a href="{{ route('admin.salary-sheets.show', $salarySheet) }}" class="button">
                    View Salary Sheet
                </a>
            </div>

            <p style="color: #6b7280; font-size: 0.875rem; margin-top: 2rem;">
                Please review the reason above, make the necessary corrections, and resubmit the salary sheet.
            </p>
        </div>

        <div class="email-footer">
            <p style="margin: 0;">This is an automated notification from the Salary Management System.</p>
            <p style="margin: 0.5rem 0 0 0;">Please do not reply to this email.</p>
        </div>
    </div>
</body>
</html>
