<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(to right, #fff8f5, #ffece7);
            padding: 40px;
            margin: 0;
        }
        .email-container {
            background: #ffffff;
            border-radius: 12px;
            padding: 35px;
            max-width: 650px;
            margin: auto;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
        }
        h2 {
            color: #E7592B;
            margin-top: 0;
        }
        p {
            font-size: 16px;
            line-height: 1.6;
            color: #333;
        }
        blockquote {
            margin: 15px 0;
            padding: 18px 20px;
            border-left: 5px solid #E7592B;
            background-color: #f9f9f9;
            border-radius: 6px;
            color: #555;
        }
        .reply-block {
            background-color: #e7f6eb;
            border-left-color: #34a853;
        }
        hr {
            border: none;
            height: 1px;
            background-color: #eee;
            margin: 30px 0;
        }
        .footer {
            font-size: 14px;
            color: #999;
            text-align: left;
            margin-top: 30px;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <h2>Hello {{ $name }},</h2>
        <p>Thank you for reaching out to us! We're happy to get back to you. Below is our response to your message:</p>

        <hr>

        <p><strong>Your original message:</strong></p>
        <blockquote>{{ $original_message }}</blockquote>

        <p><strong>Our reply:</strong></p>
        <blockquote class="reply-block">{{ $reply_message }}</blockquote>

        <hr>

        <p class="footer">
            If you have any further questions, feel free to reply to this email.<br>
            <strong>Best regards,<br>Flame & Crust Pizzeria</strong>
        </p>
    </div>
</body>
</html>
