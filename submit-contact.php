<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'Method not allowed']);
    exit;
}

function sanitizeInput($data) {
    return htmlspecialchars(strip_tags(trim($data)));
}

$name = sanitizeInput($_POST['name'] ?? '');
$email = sanitizeInput($_POST['email'] ?? '');
$subject = sanitizeInput($_POST['subject'] ?? '');
$message = sanitizeInput($_POST['message'] ?? '');

// Validate required fields
$errors = [];
if (empty($name) || strlen($name) < 4) $errors[] = 'Name must be at least 4 characters';
if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Valid email is required';
if (empty($subject) || strlen($subject) < 8) $errors[] = 'Subject must be at least 8 characters';
if (empty($message)) $errors[] = 'Message is required';

if (!empty($errors)) {
    http_response_code(400);
    echo json_encode(['errors' => $errors]);
    exit;
}

// Prepare email
$to = 'harunk3570@gmail.com';
$emailSubject = 'Contact Form: ' . $subject;

$emailMessage = "
New Contact Form Submission

Name: {$name}
Email: {$email}
Subject: {$subject}

Message:
{$message}

---
Sent from Fuse Electrical and Security Systems website
Date: " . date('Y-m-d H:i:s') . "
";

$headers = "From: noreply@fuseelectrical.ug\r\n";
$headers .= "Reply-To: {$email}\r\n";
$headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

$emailSent = mail($to, $emailSubject, $emailMessage, $headers);

if ($emailSent) {
    echo json_encode(['success' => true, 'message' => 'Message sent successfully']);
} else {
    http_response_code(500);
    echo json_encode(['error' => 'Failed to send message']);
}
?>
