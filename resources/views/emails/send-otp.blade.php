<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registration Successful</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background-color: #f8f9fa;
            padding: 20px;
            text-align: center;
            border-radius: 5px;
        }
        .content {
            padding: 20px 0;
        }
        .footer {
            background-color: #f8f9fa;
            padding: 15px;
            text-align: center;
            border-radius: 5px;
            font-size: 12px;
            color: #666;
        }
    </style>
</head>
<body>
    

    <div class="header">
        <h2>OTP Verification</h2>
    </div>
    <div class="content">
        <p>Dear user,</p>
        <p>Your One-Time Password (OTP) for verification is:</p>
        <h1 style="letter-spacing: 5px; color: #007bff;">{{ $otp }}</h1>
        <p>This OTP is valid for 10 minutes. Please do not share it with anyone.</p>
    </div>
    <div class="footer">
        &copy; {{ date('Y') }} ATM Application. All rights reserved.
    </div>
    
</body>
</html>