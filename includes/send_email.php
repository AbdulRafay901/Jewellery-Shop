<?php

// Include PHPMailer autoload
require_once __DIR__. '/../vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

/**
 * Sends an order confirmation email to the customer.
 * 
 * @param string $email Customer's email address
 * @param string $first Customer's first name
 * @param string $last Customer's last name
 * @param string $order_number The generated order number
 * @param float|string $product_total The total amount of the order
 * @return bool True if email was sent successfully, false otherwise
 */
function sendOrderConfirmationEmail($email, $first, $last, $order_number, $product_total) {
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';       // Set the SMTP server to send through
        $mail->SMTPAuth   = true;                     // Enable SMTP authentication
        $mail->Username   = 'shaikhsabah979@gmail.com'; // SMTP username
        $mail->Password   = 'wusa mqxa jjtd pgyx';          // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption
        $mail->Port       = 587;                      // TCP port to connect to

        // Recipients
        $mail->setFrom('shaikhsabah979@gmail.com', 'Jewellery Shop');
        $mail->addAddress($email, $first . ' ' . $last); // Add a recipient

        // Content
        $mail->isHTML(true); // Set email format to HTML
        $mail->Subject = 'Order Confirmation - ' . $order_number;
        
        // Constructing Email Body
        $emailBody = "<h2>Thank you for your order, {$first}!</h2>";
        $emailBody .= "<p>Your order number is <strong>{$order_number}</strong>.</p>";
        $emailBody .= "<p>Total Amount: <strong>\${$product_total}.00</strong></p>";
        $emailBody .= "<br><p>We will process your order soon.</p>";
        
        $mail->Body    = $emailBody;
        $mail->AltBody = "Thank you for your order, {$first}! Your order number is {$order_number}. Total Amount: \${$product_total}.00. We will process your order soon.";

        $mail->send();
        return true;
    } catch (Exception $e) {
        // Log the error silently so the normal checkout flow isn't interrupted
        error_log("PHPMailer Error: " . $mail->ErrorInfo);
        return false;
    }
}
