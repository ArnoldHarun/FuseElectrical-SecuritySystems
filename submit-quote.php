<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

// Check if request is POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'error' => 'Method not allowed']);
    exit;
}

// Sanitize and validate input data
function sanitizeInput($data) {
    return htmlspecialchars(strip_tags(trim($data)));
}

function validateEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

// Get form data
$firstName = sanitizeInput($_POST['first_name'] ?? '');
$lastName = sanitizeInput($_POST['last_name'] ?? '');
$email = sanitizeInput($_POST['email'] ?? '');
$phone = sanitizeInput($_POST['phone'] ?? '');
$location = sanitizeInput($_POST['location'] ?? '');
$company = sanitizeInput($_POST['company'] ?? '');
$projectType = sanitizeInput($_POST['project_type'] ?? '');
$propertySize = sanitizeInput($_POST['property_size'] ?? '');
$timeline = sanitizeInput($_POST['timeline'] ?? '');
$budget = sanitizeInput($_POST['budget'] ?? '');
$services = $_POST['services'] ?? [];
$projectDescription = sanitizeInput($_POST['project_description'] ?? '');
$preferredContact = sanitizeInput($_POST['preferred_contact'] ?? '');

// Validate required fields
$errors = [];

if (empty($firstName)) $errors[] = 'First name is required';
if (empty($lastName)) $errors[] = 'Last name is required';
if (empty($email)) $errors[] = 'Email is required';
if (!validateEmail($email)) $errors[] = 'Valid email is required';
if (empty($phone)) $errors[] = 'Phone number is required';
if (empty($location)) $errors[] = 'Project location is required';
if (empty($projectType)) $errors[] = 'Project type is required';
if (empty($services)) $errors[] = 'At least one service must be selected';

// Return errors if validation fails
if (!empty($errors)) {
    http_response_code(400);
    echo json_encode(['success' => false, 'errors' => $errors, 'message' => implode(', ', $errors)]);
    exit;
}

// Sanitize services array
$services = array_map('sanitizeInput', $services);
$servicesText = implode(', ', $services);

// Prepare email content
$to = 'harunk3570@gmail.com';
$subject = 'New Quote Request - ' . $firstName . ' ' . $lastName;

$message = "
NEW QUOTE REQUEST FROM FUSE ELECTRICAL WEBSITE

CONTACT INFORMATION:
====================
Name: {$firstName} {$lastName}
Email: {$email}
Phone: {$phone}
Location: {$location}
Company: " . ($company ?: 'Not specified') . "
Preferred Contact: {$preferredContact}

PROJECT DETAILS:
================
Project Type: {$projectType}
Property Size: " . ($propertySize ?: 'Not specified') . "
Timeline: " . ($timeline ?: 'Not specified') . "
Budget: " . ($budget ?: 'Not specified') . "

SERVICES REQUESTED:
==================
{$servicesText}

PROJECT DESCRIPTION:
===================
" . ($projectDescription ?: 'No additional description provided') . "

---
This quote request was submitted on " . date('Y-m-d H:i:s') . " from the Fuse Electrical and Security Systems website.
Please respond within 24 hours for the best customer experience.
";

// Email headers
$headers = "From: noreply@fuseelectrical.ug\r\n";
$headers .= "Reply-To: {$email}\r\n";
$headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

// Send email
$emailSent = mail($to, $subject, $message, $headers);

// Also send confirmation email to customer
$customerSubject = 'Quote Request Confirmation - Fuse Electrical and Security Systems';
$customerMessage = "
Dear {$firstName} {$lastName},

Thank you for your interest in Fuse Electrical and Security Systems!

We have received your quote request for the following services:
{$servicesText}

Our team will review your requirements and contact you within 24 hours via your preferred contact method ({$preferredContact}).

Project Details Summary:
- Project Type: {$projectType}
- Location: {$location}
- Timeline: " . ($timeline ?: 'Flexible') . "

If you have any urgent questions, please don't hesitate to contact us:
Phone: +256 704 000 474
Email: harunk3570@gmail.com

Best regards,
Fuse Electrical and Security Systems Team
Professional Electrical & Security Solutions in Uganda
";

$customerHeaders = "From: harunk3570@gmail.com\r\n";
$customerHeaders .= "Content-Type: text/plain; charset=UTF-8\r\n";

mail($email, $customerSubject, $customerMessage, $customerHeaders);

// Log the quote request
$logEntry = date('Y-m-d H:i:s') . " - Quote request from {$firstName} {$lastName} ({$email}) for {$servicesText}\n";
@file_put_contents('quote_requests.log', $logEntry, FILE_APPEND | LOCK_EX);

// Return success response
if ($emailSent) {
    echo json_encode([
        'success' => true,
        'message' => 'Quote request submitted successfully'
    ]);
} else {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'error' => 'Failed to send email. Please try again or contact us directly at harunk3570@gmail.com'
    ]);
}
?>
