<?php
// Validate the email
$email_address = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);

// Check required fields
if (empty($_POST['name']) ||
    empty($_POST['email']) ||
    empty($_POST['subject']) ||
    empty($_POST['message']) ||
    !$email_address) {
    echo "Missing required fields or invalid email.";
    return false;
}

// Sanitize inputs
$name = htmlspecialchars(strip_tags($_POST['name']));
$email_address = htmlspecialchars(strip_tags($_POST['email']));
$subject = htmlspecialchars(strip_tags($_POST['subject']));
$message = htmlspecialchars(strip_tags($_POST['message']));

// Honeypot check for spambots
if (!empty($_POST['_gotcha'])) {
    echo "Bot detected.";
    return false;
}

// Prepare email
$to = 'vaishakhashok101@gmail.com';
$email_subject = "Contact Form: $subject";
$email_body = "You have received a new message from your website contact form.\n\n"
            . "Here are the details:\n"
            . "Name: $name\n"
            . "Email: $email_address\n"
            . "Subject: $subject\n"
            . "Message:\n$message\n";

$headers = "From: noreply@yourdomain.com\n";
$headers .= "Reply-To: $email_address";

// Send email
if (mail($to, $email_subject, $email_body, $headers)) {
    echo "Message sent successfully!";
    return true;
} else {
    echo "Message failed to send.";
    return false;
}
?>
