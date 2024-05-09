<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome Email</title>
</head>

<body style="font-family: Arial, sans-serif; margin: 0; padding: 0;">
    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0">
        <tr>
            <td align="center" style="padding: 20px 0;">
                <h1>Welcome to Our Community!</h1>
            </td>
        </tr>
        <tr>
            <td align="center" style="padding: 20px 0;">
                <p>Dear {{$user?->name}},</p>
                <p>Thank you for joining us. We're thrilled to have you as part of our community!</p>
                <p>Feel free to explore our website and discover all the exciting features we have to offer.</p>
                <p>If you have any questions or need assistance, don't hesitate to contact us. We're here to help!</p>
                <p>Best regards,<br> [Your Company Name]</p>
            </td>
        </tr>
    </table>
</body>

</html>
