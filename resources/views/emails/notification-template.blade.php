<!DOCTYPE html>
<html>
<head>
    <title>{{ $subject ?? 'Notification' }}</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .email-container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px 40px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
            font-weight: 600;
        }
        .header .icon {
            font-size: 48px;
            margin-bottom: 10px;
        }
        .content {
            padding: 40px;
        }
        .notification-title {
            color: #2c3e50;
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #e9ecef;
        }
        .notification-message {
            color: #555;
            font-size: 16px;
            line-height: 1.8;
            margin-bottom: 30px;
        }
        .notification-message p {
            margin-bottom: 15px;
        }
        .notification-message ul, 
        .notification-message ol {
            margin-bottom: 15px;
            padding-left: 20px;
        }
        .notification-message li {
            margin-bottom: 5px;
        }
        .meta-info {
            background-color: #f8f9fa;
            border-left: 4px solid #667eea;
            padding: 15px 20px;
            margin: 20px 0;
            border-radius: 0 4px 4px 0;
        }
        .meta-info .label {
            font-weight: 600;
            color: #495057;
            margin-right: 8px;
        }
        .meta-info .value {
            color: #6c757d;
        }
        .footer {
            background-color: #f8f9fa;
            padding: 20px 40px;
            text-align: center;
            border-top: 1px solid #e9ecef;
        }
        .footer p {
            margin: 0;
            font-size: 14px;
            color: #6c757d;
        }
        .footer .company-name {
            font-weight: 600;
            color: #495057;
        }
        .divider {
            height: 2px;
            background: linear-gradient(to right, #667eea, #764ba2);
            margin: 20px 0;
            border: none;
        }
        
        /* Responsive styles */
        @media only screen and (max-width: 600px) {
            .email-container {
                margin: 10px;
                border-radius: 0;
            }
            .header, .content, .footer {
                padding: 20px;
            }
            .header h1 {
                font-size: 20px;
            }
            .notification-title {
                font-size: 18px;
            }
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <div class="icon">📢</div>
            <h1>{{ config('app.name') }}</h1>
        </div>
        
        <div class="content">
            <div class="notification-title">
                {{ $subject }}
            </div>
            
            <div class="notification-message">
                {!! $body !!}
            </div>
            
            <hr class="divider">
            
            <div class="meta-info">
                <div>
                    <span class="label">Sent on:</span>
                    <span class="value">{{ date('F j, Y \a\t g:i A') }}</span>
                </div>
            </div>
        </div>
        
        <div class="footer">
            <p>
                This notification was sent from 
                <span class="company-name">{{ config('app.name') }}</span>
            </p>
            <p style="margin-top: 5px; font-size: 12px;">
                Please do not reply to this email. This is an automated message.
            </p>
        </div>
    </div>
</body>
</html>
