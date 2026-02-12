<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body { 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
            line-height: 1.6; 
            color: #333; 
            margin: 0; 
            padding: 0; 
            background-color: #f5f5f5; 
        }
        .container { 
            max-width: 600px; 
            margin: 0 auto; 
            background-color: #ffffff; 
        }
        .header { 
            background: linear-gradient(135deg, #FFD700 0%, #B8860B 100%); 
            color: #ffffff; 
            padding: 30px 20px; 
            text-align: center; 
        }
        .header h1 { 
            margin: 0; 
            font-size: 28px; 
            font-weight: 300; 
            letter-spacing: 2px; 
        }
        .content { 
            padding: 30px 20px; 
        }
        .section { 
            margin: 25px 0; 
        }
        .section-title { 
            background-color: #dc2626; 
            color: #ffffff; 
            padding: 12px 15px; 
            font-size: 16px; 
            font-weight: bold; 
            margin: 0 -20px 15px -20px; 
            letter-spacing: 1px; 
        }
        .detail-row { 
            padding: 8px 0; 
            border-bottom: 1px solid #f0f0f0; 
        }
        .detail-label { 
            font-weight: bold; 
            color: #B8860B; 
            display: inline-block; 
            width: 180px; 
        }
        .detail-value { 
            color: #333; 
        }
        .info-box { 
            background-color: #fef2f2; 
            border-left: 4px solid #dc2626; 
            padding: 15px; 
            margin: 20px 0; 
        }
        .footer { 
            background-color: #fafafa; 
            padding: 20px; 
            text-align: center; 
            border-top: 3px solid #FFD700; 
            color: #666; 
            font-size: 12px; 
        }
        .contact-info { 
            margin: 15px 0; 
        }
        .contact-info a { 
            color: #B8860B; 
            text-decoration: none; 
        }
        .signature { 
            margin-top: 30px; 
            color: #333; 
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1>GOLDEN SKY HOTEL &amp; WELLNESS</h1>
        </div>
        
        <!-- Content -->
        <div class="content">
            <p>Dear {{ $guest->first_name }} {{ $guest->last_name }},</p>
            <p>This email confirms that your reservation at Golden Sky Hotel &amp; Wellness has been successfully cancelled.</p>
            
            <!-- Cancellation Details Section -->
            <div class="section">
                <div class="section-title">CANCELLATION CONFIRMATION</div>
                <div class="detail-row">
                    <span class="detail-label">Booking Reference:</span>
                    <span class="detail-value">{{ $booking->booking_id }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Room Number:</span>
                    <span class="detail-value">{{ $room->room_number }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Room Type:</span>
                    <span class="detail-value">{{ $room->room_type }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Original Check-In:</span>
                    <span class="detail-value">{{ $checkInFormatted }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Original Check-Out:</span>
                    <span class="detail-value">{{ $checkOutFormatted }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Cancellation Date:</span>
                    <span class="detail-value">{{ now()->format('d F Y') }} at {{ now()->format('h:i A') }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Status:</span>
                    <span class="detail-value"><strong style="color: #dc2626;">CANCELLED</strong></span>
                </div>
            </div>
            
            <!-- Important Information -->
            <div class="info-box">
                <strong>Cancellation Policy:</strong>
                <ul style="margin: 10px 0; padding-left: 20px;">
                    <li>Your booking has been cancelled as requested</li>
                    <li>Any advance payments will be processed for refund according to our policy</li>
                    <li>Refunds typically take 5-7 business days to process</li>
                    <li>Please keep this email for your records</li>
                </ul>
            </div>
            
            <!-- Contact Information -->
            <div class="section">
                <div class="section-title" style="background-color: #FFD700; color: #000000;">NEED ASSISTANCE?</div>
                <div class="contact-info">
                    <p>If you have any questions about this cancellation or would like to make a new reservation, please contact us:</p>
                    <strong>Golden Sky Hotel &amp; Wellness</strong><br>
                    Phone / WhatsApp: <a href="tel:+94714831035">+94 71 483 1035</a><br>
                    Email: <a href="mailto:reservations@goldenskyhotelandwellness.com">reservations@goldenskyhotelandwellness.com</a><br>
                    Address: 53/1, Hanthane Housing Scheme, Hanthane, Kandy
                </div>
            </div>
            
            <!-- Signature -->
            <div class="signature">
                <p>We're sorry we won't have the opportunity to serve you this time. We hope to welcome you in the future!</p>
                <p><strong>Warm regards,</strong><br>
                The Golden Sky Hotel &amp; Wellness Team</p>
            </div>
        </div>
        
        <!-- Footer -->
        <div class="footer">
            <p>This is an automated cancellation confirmation email.</p>
            <p>&copy; {{ date('Y') }} Golden Sky Hotel &amp; Wellness. All rights reserved.</p>
            <p style="margin-top: 10px;">Powered by Forge Digital Solutions</p>
        </div>
    </div>
</body>
</html>






































































