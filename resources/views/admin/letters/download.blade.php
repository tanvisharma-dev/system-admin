<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ ucfirst($letter->letter_type) }} Letter - {{ $letter->employee->name }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 20px;
        }
        .letter-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 30px;
            border: 1px solid #ddd;
        }
        .letter-header {
            text-align: center;
            margin-bottom: 30px;
        }
        .letter-header h1 {
            color: #333;
            margin-bottom: 5px;
        }
        .letter-header p {
            color: #666;
            margin-top: 0;
        }
        .letter-footer {
            margin-top: 50px;
            text-align: left;
        }
        .letter-signature {
            margin-top: 60px;
        }
        .letter-date {
            text-align: right;
            margin-bottom: 30px;
        }
        @media print {
            body {
                padding: 0;
            }
            .letter-container {
                border: none;
            }
            .no-print {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="no-print" style="text-align: center; margin-bottom: 20px;">
        <button onclick="window.print()" style="padding: 10px 20px; background-color: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer;">
            <i class="fas fa-print"></i> Print Letter
        </button>
        <a href="{{ route('letters.show', $letter) }}" style="padding: 10px 20px; background-color: #6c757d; color: white; border: none; border-radius: 4px; text-decoration: none; margin-left: 10px;">
            <i class="fas fa-arrow-left"></i> Back to Letter
        </a>
    </div>
    
    <div class="letter-container">
        <div class="letter-header">
            <h1>{{ config('app.name', 'Employee Management') }}</h1>
            <p>123 Business Street, City, Country</p>
            <p>Phone: +1-234-567-8900 | Email: info@company.com</p>
            <hr>
        </div>
        
        <div class="letter-date">
            <p>{{ now()->format('F d, Y') }}</p>
        </div>
        
        <div class="letter-content">
            {!! $letter->content !!}
        </div>
        
        <div class="letter-signature">
            <p>Sincerely,</p>
            <p>HR Department</p>
            <p>{{ config('app.name', 'Employee Management') }}</p>
        </div>
    </div>
</body>
</html>