<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vaccination Appointment Confirmation</title>
</head>

<body>
    <h1>Dear {{ $userName }},</h1>
    <p>This is a reminder for your vaccination appointment scheduled on {{ $vaccinationDate }} at
        {{ $vaccineCenterName }}.</p>
    <p>Please arrive on time.</p>
    <p>Best regards,</p>
    <p>Vaccination Team</p>
</body>

</html>
