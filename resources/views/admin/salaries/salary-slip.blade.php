<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Salary Slip</title>
    <style>
        @page {
            size: A4;
            margin: 15mm;
        }
        
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            font-size: 13px;
            line-height: 1.4;
            color: #333;
        }
        
        .header {
            width: 100%;
            margin-bottom: 20px;
            padding-bottom: 10px;
        }
        
        .header-table {
            width: 100%;
            border-collapse: collapse;
        }
        
        .header-table td {
            vertical-align: top;
            padding: 0;
        }
        
        .company-info {
            width: 60%;
        }
        
        .company-logo {
            width: 45px;
            height: 45px;
            background-color: #6f42c1;
            color: white;
            text-align: center;
            font-weight: bold;
            font-size: 28px;
            line-height: 45px;
            float: left;
            margin-right: 10px;
        }
        
        .company-details {
            margin-left: 2px;
        }
        
        .company-name {
            font-size: 16px;
            font-weight: bold;
            color: #333;
            margin-bottom: 3px;
        }
        
        .company-address {
            font-size: 11px;
            color: #666;
        }
        
        .payslip-info {
            text-align: right;
            width: 40%;
        }
        
        .payslip-title {
            font-size: 12px;
            color: #666;
            margin-bottom: 3px;
        }
        
        .payslip-month {
            font-size: 18px;
            font-weight: bold;
            color: #333;
        }
        
        .divider {
            height: 1px;
            background-color: #ddd;
            margin: 20px 0;
        }
        
        .employee-section {
            width: 100%;
            margin-bottom: 20px;
        }
        
        .employee-table {
            width: 100%;
            border-collapse: collapse;
        }
        
        .employee-table td {
            vertical-align: top;
            padding: 0;
        }
        
        .employee-details {
            /* width: 60%; */
            margin-top: 40px;
        }
        
        .employee-details div {
            margin-bottom: 4px;
            font-size: 15px;
            padding: 1px 0;
        }
        
        .employee-details strong {
            display: inline-block;
            /* width: 90px; */
            font-weight: 600;
            margin-bottom: 0px !important;
        }
        
        .net-pay-section {
            width: 40%;
            padding-left: 10px;
            border-radius: 10px !important;
        }
        
        .bdr-box {
            border: 1px solid #ddd;
            margin-bottom: 10px;
            border-radius: 10px !important;
        }
        
        .net-pay-box {
            background-color: #d4edda;
            padding: 12px 8px 8px 8px;
            text-align: center;
        }
        
        .net-pay-amount {
            font-size: 22px;
            font-weight: bold;
            color: #333;
            margin-bottom: 3px;
        }
        
        .net-pay-label {
            font-size: 11px;
            color: #666;
            margin-bottom: 8px;
        }
        
        .pay-days {
            font-size: 12px;
            color: #000;
            padding: 15px 12px 15px 12px;
        }
        
        .pay-days div {
            margin-bottom: 3px;
        }
        
        .salary-table {
            width: 100%;
            margin-bottom: 20px;
        }
        .salary-table th {
            padding: 10px;
            text-align: left;
            font-weight: bold;
             /* border-top: 1px solid #dee2e6; */
            /* border-left: 1px solid #dee2e6; */
            /* border-right: 1px solid #dee2e6;  */
            font-size: 13px;
        }
        .salary-table-top-left-bdr{
            border-top-left-radius: 10px  !important;
        }
        .salary-table-top-right-bdr{
            border-top-right-radius: 10px  !important;
        }
        .salary-table-bottom-left-bdr{
            border-bottom-left-radius: 10px  !important;
        }
        .salary-table-bottom-right-bdr{
            border-bottom-right-radius: 10px  !important;
        }
        .salary-table-right-bdr {
            border-right: 1px solid #dee2e6 !important;
        }
        .salary-table-left-bdr {
            border-left: 1px solid #dee2e6 !important;
        }
        .salary-table-top-bdr {
            border-top: 1px solid #dee2e6 !important;
        }
        .salary-table-bottom-bdr {
            border-bottom: 1px solid #dee2e6 !important;
        }
        .salary-table td {
            padding: 8px 10px;
            /* border: 1px solid #dee2e6; */
            font-size: 13px;
        }
        
        .total-row {
            /* background-color: #f8f9fa; */
            font-weight: bold;
        }
        
        .final-total {
            /* background-color: #e9ecef; */
            font-weight: bold;
        }
        
        .final-total td {
            padding: 8px;
            font-size: 13px;
        }
        
        .amount-words {
            text-align: right;
            font-style: italic;
            margin-top: 15px;
            font-size: 12px;
            color: #666;
        }
        
        .fw-bold {
            font-weight: 700;
        }
        
        .clearfix::after {
            content: "";
            display: table;
            clear: both;
        }
    </style>
</head>
<body>
    <div class="header">
        <table class="header-table">
            <tr>
                <td class="company-info">
                    <div class="clearfix">
                        <div class="company-logo">m</div>
                        <div class="company-details">
                            <div class="company-name">MindCode Lab Pvt. Ltd.</div>
                            <div class="company-address">SCO 12-13 Airport Road, Phase-11, Mohali, 160055 India</div>
                        </div>
                    </div>
                </td>
                <td class="payslip-info">
                    <div class="payslip-title">Payslip for the Month</div>
                    <div class="payslip-month">
                        @php
                            $monthYear = $salary->month;
                            if (preg_match('/^(\d{4})-(\d{2})$/', $monthYear, $matches)) {
                                $year = $matches[1];
                                $month = $matches[2];
                                $monthName = DateTime::createFromFormat('!m', $month)->format('F');
                                echo $monthName . ' ' . $year;
                            } else {
                                echo $monthYear;
                            }
                        @endphp
                    </div>
                </td>
            </tr>
        </table>
    </div>

    <div class="divider"></div>

    <div class="employee-section">
        <table class="employee-table">
            <tr>
                <td class="employee-details">
                    <div><strong class="fw-bold">Employee Name:</strong> {{ $salary->employee->name }}</div>
                    <div><strong>Employee ID:</strong> {{ $salary->employee->employee_id }}</div>
                    <div><strong>Pay Period:</strong> 
                        @php
                            $monthYear = $salary->month;
                            if (preg_match('/^(\d{4})-(\d{2})$/', $monthYear, $matches)) {
                                $year = $matches[1];
                                $month = $matches[2];
                                $monthName = DateTime::createFromFormat('!m', $month)->format('F');
                                echo $monthName;
                            } else {
                                echo $monthYear;
                            }
                        @endphp
                    </div>
                    <div><strong>Pay Date:</strong> {{ $salary->pay_date ? $salary->pay_date->format('Y-m-d') : date('Y-m-d') }}</div>
                </td>
                <td class="net-pay-section">
                    <div class="bdr-box">
                        <div class="net-pay-box">
                            <div class="net-pay-amount">Rs. {{ number_format($salary->net_salary, 2) }}</div>
                            <div class="net-pay-label">Employee Net Pay</div>
                        </div>
                        <div class="pay-days">
                            <div><strong>Paid Days:</strong> {{ $salary->paid_days ?? '24' }}</div>
                            <div><strong>LOP Days:</strong> {{ $salary->lop_days ?? '0' }}</div>
                        </div>
                    </div>
                </td>
            </tr>
        </table>
    </div>
 
    {{-- <table class="salary-table">
        <thead>
            <tr>
                <th style="width: 25%;">Earnings</th>
                <th style="width: 25%;">Amount</th>
                <th style="width: 25%;">Deductions</th>
                <th style="width: 25%;">Amount</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Basic</td>
                <td class="amount">Rs. {{ number_format($salary->basic, 2) }}</td>
                <td>Income Tax</td>
                <td class="amount">Rs. 0.00</td>
            </tr>
            <tr>
                <td>HRA</td>
                <td class="amount">Rs. {{ number_format($salary->hra, 2) }}</td>
                <td>Provident Fund</td>
                <td class="amount">Rs. 0.00</td>
            </tr>
            <tr>
                <td></td>
                <td class="amount"></td>
                <td>Absent</td>
                <td class="amount">Rs. {{ number_format($salary->deductions, 2) }}</td>
            </tr>
            <tr class="total-row">
                <td><strong>Gross Earnings</strong></td>
                <td class="amount"><strong>Rs. {{ number_format($salary->gross, 2) }}</strong></td>
                <td><strong>Total Deductions</strong></td>
                <td class="amount"><strong>Rs. {{ number_format($salary->deductions, 2) }}</strong></td>
            </tr>
            <tr class="final-total">
                <td colspan="3"><strong>Total Net Payable</strong></td>
                <td class="amount"><strong>Rs. {{ number_format($salary->net_salary, 2) }}</strong></td>
            </tr>
        </tbody>
    </table> --}}
    <table class="salary-table" border="0">
        <thead>
            <tr>
                <th style="width: 25%; text-align: center;" class="salary-table-left-bdr salary-table-top-left-bdr salary-table-top-bdr">Earnings</th>
                <th style="width: 25%; text-align: center;" class="salary-table-top-bdr">Amount</th>
                <th style="width: 25%; text-align: center;" class="salary-table-top-bdr">Deductions</th>
                <th style="width: 25%; text-align: center;" class="salary-table-right-bdr salary-table-top-bdr salary-table-top-right-bdr">Amount</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="width: 25%; text-align: center;" class="salary-table-left-bdr salary-table-top-bdr">Basic</td>
                <td style="width: 25%; text-align: center;" class="salary-table-top-bdr amount">Rs. {{ number_format($salary->basic, 2) }}</td>
                <td style="width: 25%; text-align: center;" class="salary-table-top-bdr">Income Tax</td>
                <td style="width: 25%; text-align: center;" class="salary-table-top-bdr salary-table-right-bdr amount">Rs. 0.00</td>
            </tr>
            <tr>
                <td style="width: 25%; text-align: center;" class="salary-table-left-bdr">HRA</td>
                <td style="width: 25%; text-align: center;" class="amount">Rs. {{ number_format($salary->hra, 2) }}</td>
                <td style="width: 25%; text-align: center;">Provident Fund</td>
                <td style="width: 25%; text-align: center;" class="amount salary-table-right-bdr">Rs. 0.00</td>
            </tr>
            <tr>
                <td style="width: 25%; text-align: center;" class="salary-table-left-bdr"></td>
                <td style="width: 25%; text-align: center;" class="amount"></td>
                <td style="width: 25%; text-align: center;">Absent</td>
                <td style="width: 25%; text-align: center;" class="amount salary-table-right-bdr">Rs. {{ number_format($salary->deductions, 2) }}</td>
            </tr>
            <tr class="total-row">
                <td style="width: 25%; text-align: center;" class="salary-table-left-bdr salary-table-bottom-bdr" ><strong>Gross Earnings</strong></td>
                <td style="width: 25%; text-align: center;" class="amount salary-table-bottom-bdr"><strong>Rs. {{ number_format($salary->gross, 2) }}</strong></td>
                <td style="width: 25%; text-align: center;" class="salary-table-bottom-bdr"><strong>Total Deductions</strong></td>
                <td style="width: 25%; text-align: center;" class="amount salary-table-right-bdr salary-table-bottom-bdr"><strong>Rs. {{ number_format($salary->deductions, 2) }}</strong></td>
            </tr>
            <tr class="final-total">
                <td style="width: 25%; padding-left: 110px;" class="salary-table-left-bdr salary-table-bottom-bdr salary-table-bottom-left-bdr" colspan="3"><strong>Total Net Payable</strong></td>
                <td style="width: 25%; text-align: center;" class="amount salary-table-right-bdr salary-table-bottom-bdr salary-table-bottom-right-bdr"><strong>Rs. {{ number_format($salary->net_salary, 2) }}</strong></td>
            </tr>
        </tbody>
    </table>

    <div class="amount-words">
        <strong>Amount in Words:</strong> 
        @php
            $netSalary = $salary->net_salary;
            // Simple number to words conversion
            function numberToWords($number) {
                $ones = array(
                    0 => 'Zero', 1 => 'One', 2 => 'Two', 3 => 'Three', 4 => 'Four',
                    5 => 'Five', 6 => 'Six', 7 => 'Seven', 8 => 'Eight', 9 => 'Nine',
                    10 => 'Ten', 11 => 'Eleven', 12 => 'Twelve', 13 => 'Thirteen',
                    14 => 'Fourteen', 15 => 'Fifteen', 16 => 'Sixteen', 17 => 'Seventeen',
                    18 => 'Eighteen', 19 => 'Nineteen'
                );
                $tens = array(
                    20 => 'Twenty', 30 => 'Thirty', 40 => 'Forty', 50 => 'Fifty',
                    60 => 'Sixty', 70 => 'Seventy', 80 => 'Eighty', 90 => 'Ninety'
                );
                
                if ($number < 20) {
                    return $ones[$number];
                } elseif ($number < 100) {
                    return $tens[floor($number / 10) * 10] . ($number % 10 ? ' ' . $ones[$number % 10] : '');
                } elseif ($number < 1000) {
                    return $ones[floor($number / 100)] . ' Hundred' . ($number % 100 ? ' ' . numberToWords($number % 100) : '');
                } elseif ($number < 100000) {
                    return numberToWords(floor($number / 1000)) . ' Thousand' . ($number % 1000 ? ' ' . numberToWords($number % 1000) : '');
                } else {
                    return numberToWords(floor($number / 100000)) . ' Lakh' . ($number % 100000 ? ' ' . numberToWords($number % 100000) : '');
                }
            }
            // weapon, gun , ammo, bullet, rifile, awm, m24, akm, m416, m16
            $words = numberToWords(floor($netSalary)); 
            echo 'Indian Rupee ' . $words . ' Only';
        @endphp
    </div>
</body>
</html>
