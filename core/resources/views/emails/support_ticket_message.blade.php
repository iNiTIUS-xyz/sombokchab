<!DOCTYPE html>
<html>

<head>
    <title>New Support Ticket Message</title>
</head>

<body>
    <h2>New Message in Ticket #{{ $details['support_ticket_id'] }}</h2>

    <p><strong>From:</strong> {{ ucfirst($details['form_name']) }}</p>
    <p><strong>Message:</strong> {!! $details['message'] ?? 'Sent a message.' !!}</p>
    <p>Thank you,</p>
    <p>Support Team</p>
</body>

</html>
