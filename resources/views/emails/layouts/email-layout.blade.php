<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Job to Apply')</title>
    <style>
        /* Reset styles */
        body,
        table,
        td,
        a {
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
        }

        table,
        td {
            mso-table-lspace: 0pt;
            mso-table-rspace: 0pt;
        }

        img {
            -ms-interpolation-mode: bicubic;
            border: 0;
            height: auto;
            line-height: 100%;
            outline: none;
            text-decoration: none;
        }

        body {
            height: 100% !important;
            margin: 0 !important;
            padding: 0 !important;
            width: 100% !important;
        }

        /* Brand colors */
        :root {
            --primary: #0d2266;
            --secondary: #275896;
            --tertiary: #808080;
        }

        /* Base styles */
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        /* Container */
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
        }

        /* Header */
        .header {
            background: linear-gradient(135deg, #0d2266 0%, #275896 100%);
            padding: 40px 30px;
            text-align: center;
        }

        .logo {
            font-size: 32px;
            font-weight: bold;
            color: #ffffff;
            text-decoration: none;
            letter-spacing: 1px;
        }

        /* Content */
        .content {
            padding: 40px 30px;
            color: #333333;
            line-height: 1.6;
        }

        .greeting {
            font-size: 24px;
            font-weight: bold;
            color: #0d2266;
            margin-bottom: 20px;
        }

        .text {
            font-size: 16px;
            color: #555555;
            margin-bottom: 15px;
        }

        /* Buttons */
        .button-container {
            text-align: center;
            margin: 30px 0;
        }

        .button-primary {
            display: inline-block;
            padding: 15px 40px;
            background-color: #0d2266;
            color: #ffffff !important;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        .button-secondary {
            display: inline-block;
            padding: 15px 40px;
            background-color: #275896;
            color: #ffffff !important;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        .button-outline {
            display: inline-block;
            padding: 14px 40px;
            background-color: transparent;
            color: #0d2266 !important;
            text-decoration: none;
            border: 2px solid #0d2266;
            border-radius: 5px;
            font-weight: bold;
            font-size: 16px;
            transition: all 0.3s;
        }

        /* Table styles */
        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            background-color: #ffffff;
            border: 1px solid #e0e0e0;
        }

        .data-table th {
            background-color: #0d2266;
            color: #ffffff;
            padding: 12px;
            text-align: left;
            font-weight: bold;
        }

        .data-table td {
            padding: 12px;
            border-bottom: 1px solid #e0e0e0;
            color: #555555;
        }

        .data-table tr:last-child td {
            border-bottom: none;
        }

        .data-table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        /* List styles */
        .list-container {
            margin: 20px 0;
        }

        .list-item {
            padding: 15px;
            margin-bottom: 10px;
            background-color: #f9f9f9;
            border-left: 4px solid #0d2266;
            border-radius: 4px;
        }

        .list-item-title {
            font-weight: bold;
            color: #0d2266;
            margin-bottom: 5px;
        }

        .list-item-description {
            color: #666666;
            font-size: 14px;
        }

        /* Info boxes */
        .info-box {
            background-color: #e8f0fe;
            border-left: 4px solid #275896;
            padding: 20px;
            margin: 20px 0;
            border-radius: 4px;
        }

        .warning-box {
            background-color: #fff3cd;
            border-left: 4px solid #ffc107;
            padding: 20px;
            margin: 20px 0;
            border-radius: 4px;
        }

        .success-box {
            background-color: #d4edda;
            border-left: 4px solid #28a745;
            padding: 20px;
            margin: 20px 0;
            border-radius: 4px;
        }

        /* Card styles */
        .card {
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            padding: 20px;
            margin: 20px 0;
            background-color: #ffffff;
        }

        .card-header {
            font-size: 18px;
            font-weight: bold;
            color: #0d2266;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 2px solid #f0f0f0;
        }

        .card-body {
            color: #555555;
            line-height: 1.6;
        }

        /* Divider */
        .divider {
            height: 1px;
            background-color: #e0e0e0;
            margin: 30px 0;
        }

        /* Footer */
        .footer {
            background-color: #f9f9f9;
            padding: 30px;
            text-align: center;
            border-top: 1px solid #e0e0e0;
        }

        .footer-text {
            font-size: 14px;
            color: #808080;
            margin-bottom: 10px;
        }

        .footer-links {
            margin: 15px 0;
        }

        .footer-link {
            color: #275896;
            text-decoration: none;
            margin: 0 10px;
            font-size: 14px;
        }

        .social-links {
            margin: 20px 0;
        }

        .social-link {
            display: inline-block;
            margin: 0 10px;
            color: #808080;
            text-decoration: none;
        }

        /* Responsive */
        @media only screen and (max-width: 600px) {
            .content {
                padding: 30px 20px !important;
            }

            .greeting {
                font-size: 20px !important;
            }

            .button-primary,
            .button-secondary,
            .button-outline {
                display: block !important;
                width: 100% !important;
                box-sizing: border-box;
                margin-bottom: 10px;
            }

            .data-table {
                font-size: 14px;
            }

            .data-table th,
            .data-table td {
                padding: 8px;
            }
        }
    </style>
</head>

<body>
    <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%"
        style="background-color: #f4f4f4; padding: 20px 0;">
        <tr>
            <td align="center">
                <table role="presentation" class="email-container" cellspacing="0" cellpadding="0" border="0"
                    width="600">
                    <!-- Header -->
                    <tr>
                        <td class="header">
                            <a href="{{ config('app.url') }}" class="logo">Job to Apply</a>
                        </td>
                    </tr>

                    <!-- Content -->
                    <tr>
                        <td class="content">
                            @yield('content')
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td class="footer">
                            <p class="footer-text">© {{ date('Y') }} Job to Apply. All rights reserved.</p>

                            <div class="footer-links">
                                <a href="{{ config('app.url') }}/about" class="footer-link">About Us</a>
                                <a href="{{ config('app.url') }}/contact" class="footer-link">Contact</a>
                                <a href="{{ config('app.url') }}/privacy" class="footer-link">Privacy Policy</a>
                                <a href="{{ config('app.url') }}/terms" class="footer-link">Terms</a>
                            </div>

                            <div class="social-links">
                                <a href="#" class="social-link">LinkedIn</a>
                                <a href="#" class="social-link">Twitter</a>
                                <a href="#" class="social-link">Facebook</a>
                            </div>

                            <p class="footer-text" style="margin-top: 20px; font-size: 12px;">
                                You're receiving this email because you have an account with Job to Apply.<br>
                                <a href="{{ config('app.url') }}/unsubscribe" style="color: #808080;">Unsubscribe</a>
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>
