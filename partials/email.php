<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>{TITLE}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f9f9f9;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .code {
            font-size: 24px;
            font-weight: bold;
            color: #007bff;
            margin: 20px 0;
        }
        .footer {
            margin-top: 20px;
            font-size: 12px;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>{TITLE}</h2>
        <p>Dear {NAME},</p>
        <p>{MESSAGE}</p>
        <div class="code">{LINK}</div>
        <p>Best regards,</p>
        <p><strong>{COMPANY_NAME}</strong></p>
        <p class="footer">Need help? Contact our support team at {EMAIL}.</p>
    </div>
</body>
</html>
