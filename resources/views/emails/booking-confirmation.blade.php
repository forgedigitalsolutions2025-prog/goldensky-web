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
            background-color: #FFD700; 
            color: #000000; 
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
            background-color: #fffef0; 
            border-left: 4px solid #FFD700; 
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
        .highlight {
            background-color: #FFD700;
            padding: 2px 6px;
            border-radius: 3px;
            font-weight: bold;
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
            <p>Thank you for choosing Golden Sky Hotel &amp; Wellness. We are delighted to confirm your reservation and look forward to providing you with an exceptional stay.</p>
            
            <!-- Reservation Details Section -->
            <div class="section">
                <div class="section-title">RESERVATION CONFIRMATION</div>
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
                    <span class="detail-label">Check-In Date:</span>
                    <span class="detail-value">{{ $checkInFormatted }} (After 2:00 PM)</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Check-Out Date:</span>
                    <span class="detail-value">{{ $checkOutFormatted }} (Before 11:00 AM)</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Number of Nights:</span>
                    <span class="detail-value">{{ $booking->number_of_nights }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Number of Adults:</span>
                    <span class="detail-value">{{ $booking->number_of_adults }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Number of Children:</span>
                    <span class="detail-value">{{ $booking->number_of_children }}</span>
                </div>
            </div>
            
            <!-- Pricing Section -->
            <div class="section">
                <div class="section-title">PRICING DETAILS</div>
                <div class="detail-row">
                    <span class="detail-label">Rate per Night:</span>
                    <span class="detail-value">LKR {{ number_format($room->price_per_night, 2) }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Number of Nights:</span>
                    <span class="detail-value">{{ $booking->number_of_nights }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Total Amount:</span>
                    <span class="detail-value"><strong>LKR {{ number_format($totalAmount, 2) }}</strong></span>
                </div>
            </div>
            
            <!-- Important Information -->
            <div class="info-box">
                <strong>Important Information:</strong>
                <ul style="margin: 10px 0; padding-left: 20px;">
                    <li>Check-in time: 2:00 PM onwards</li>
                    <li>Check-out time: 11:00 AM</li>
                    <li>Please bring a valid ID and this confirmation email</li>
                    <li>Early check-in and late check-out are subject to availability</li>
                    <li>Full payment is due upon check-in</li>
                </ul>
            </div>
            
            <!-- Cancellation Policy -->
            <div class="section">
                <div class="section-title">CANCELLATION POLICY</div>
                <p>Free cancellation is available up to 24 hours before your check-in date. Cancellations made within 24 hours may incur charges. Please contact us to cancel or modify your reservation.</p>
            </div>
            
            <!-- Contact Information -->
            <div class="section">
                <div class="section-title">CONTACT INFORMATION</div>
                <div class="contact-info">
                    <strong>Golden Sky Hotel &amp; Wellness</strong><br>
                    Phone / WhatsApp: <a href="tel:+94714831035">+94 71 483 1035</a><br>
                    Email: <a href="mailto:reservations@goldenskyhotelandwellness.com">reservations@goldenskyhotelandwellness.com</a><br>
                    Address: 53/1, Hanthane Housing Scheme, Hanthane, Kandy
                </div>
            </div>
            
            <!-- Signature -->
            <div class="signature">
                <p>We look forward to welcoming you to Golden Sky Hotel &amp; Wellness and ensuring you have a memorable stay.</p>
                <p><strong>Warm regards,</strong><br>
                The Golden Sky Hotel &amp; Wellness Team</p>
            </div>
        </div>
        
        <!-- Footer -->
        <div class="footer">
            <p>This is an automated confirmation email. Please do not reply to this email.</p>
            <p>&copy; {{ date('Y') }} Golden Sky Hotel &amp; Wellness. All rights reserved.</p>
            <p style="margin-top: 10px;">Powered by Forge Digital Solutions</p>
        </div>
    </div>
</body>
</html>






































































