<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Collaboration Invitation</title>
</head>
<body style="margin: 0; padding: 0; background-color: #f8f5f0; font-family: 'Georgia', serif; color: #4a4a4a;">
    <table width="100%" cellpadding="0" cellspacing="0" style="background-color: #f8f5f0; padding: 40px 20px;">
        <tr>
            <td align="center">
                <table width="600" cellpadding="0" cellspacing="0" style="max-width: 600px; background-color: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 20px rgba(85, 107, 47, 0.08); border: 1px solid #e8e4d8;">
                    <!-- Header with subtle olive accent -->
                    <tr>
                        <td style="background-color: #6d712e; padding: 40px 30px; text-align: center;">
                            <h1 style="margin: 0; font-size: 28px; color: #ffffff; font-weight: normal; letter-spacing: 1px;">Collaboration Invitation</h1>
                        </td>
                    </tr>
                    <!-- Body -->
                    <tr>
                        <td style="padding: 50px 40px; text-align: center; background-color: #ffffff;">
                            <p style="font-size: 18px; line-height: 1.6; color: #5a5a5a; margin: 0 0 30px;">
                                Dear Recipient,
                            </p>
                            <p style="font-size: 16px; line-height: 1.8; color: #4a5a3a; margin: 0 0 30px;">
                                You have been graciously invited to collaborate on the project<br>
                                <strong style="color: #6d712e; font-size: 20px;">{{ $invitation->project->name }}</strong>.
                            </p>
                            <p style="font-size: 16px; line-height: 1.8; color: #5a5a5a; margin: 0 0 40px;">
                                We would be delighted to have you join us.
                            </p>
                            <!-- Call to Action Button -->
                            <a href="{{ url('/invitations/accept/'.$invitation->token) }}" style="display: inline-block; background-color: #6d712e; color: #ffffff; font-size: 18px; padding: 16px 40px; text-decoration: none; border-radius: 8px; box-shadow: 0 4px 10px rgba(109, 113, 46, 0.2); transition: background-color 0.3s;">
                                Accept Invitation
                            </a>
                            <p style="font-size: 14px; line-height: 1.6; color: #888888; margin: 40px 0 0;">
                                This invitation expires on<br>
                                <strong style="color: #6d712e;">{{ $invitation->expires_at->format('Y-m-d H:i') }}</strong>
                            </p>
                        </td>
                    </tr>
                    <!-- Footer -->
                    <tr>
                        <td style="background-color: #f8f5f0; padding: 30px; text-align: center; font-size: 14px; color: #888888;">
                            Thank you for considering this opportunity.<br>
                            If you have any questions, please don't hesitate to reach out.
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>