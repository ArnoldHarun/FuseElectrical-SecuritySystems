<?php
header('Content-Type: application/json');

// Check if form was submitted
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
    exit;
}

// Sanitize and validate input data
function sanitizeInput($data) {
    return htmlspecialchars(strip_tags(trim($data)));
}

// Collect form data
$firstName = sanitizeInput($_POST['firstName'] ?? '');
$lastName = sanitizeInput($_POST['lastName'] ?? '');
$email = filter_var($_POST['email'] ?? '', FILTER_SANITIZE_EMAIL);
$phone = sanitizeInput($_POST['phone'] ?? '');
$propertyDescription = sanitizeInput($_POST['propertyDescription'] ?? '');
$city = sanitizeInput($_POST['city'] ?? '');
$streetAddress = sanitizeInput($_POST['streetAddress'] ?? '');
$state = sanitizeInput($_POST['state'] ?? '');
$postalCode = sanitizeInput($_POST['postalCode'] ?? '');
$services = $_POST['services'] ?? [];
$projectScope = sanitizeInput($_POST['projectScope'] ?? '');
$budget = sanitizeInput($_POST['budget'] ?? '');
$timeline = sanitizeInput($_POST['timeline'] ?? '');
$additionalInfo = sanitizeInput($_POST['additionalInfo'] ?? '');

// Validate required fields
$errors = [];
if (empty($firstName)) $errors[] = 'First name is required';
if (empty($lastName)) $errors[] = 'Last name is required';
if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Valid email is required';
if (empty($phone)) $errors[] = 'Phone number is required';
if (empty($city)) $errors[] = 'City is required';
if (empty($streetAddress)) $errors[] = 'Street address is required';

if (!empty($errors)) {
    echo json_encode(['success' => false, 'message' => 'Please fill in all required fields', 'errors' => $errors]);
    exit;
}

// Prepare email content
$to = 'info@fuseelectrical.ug';
$subject = 'New Quotation Request from ' . $firstName . ' ' . $lastName;

$emailBody = "
<html>
<head>
    <title>New Quotation Request</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .header { background: #18d26e; color: white; padding: 20px; text-align: center; }
        .content { padding: 20px; }
        .section { margin-bottom: 25px; }
        .section h3 { color: #18d26e; border-bottom: 2px solid #18d26e; padding-bottom: 5px; }
        .info-row { margin-bottom: 10px; }
        .label { font-weight: bold; display: inline-block; width: 150px; }
        .services-list { background: #f8f9fa; padding: 15px; border-radius: 5px; }
        .services-list ul { margin: 0; padding-left: 20px; }
    </style>
</head>
<body>
    <div class='header'>
        <h2>New Quotation Request</h2>
        <p>Fuse Electrical and Security Systems</p>
    </div>
    
    <div class='content'>
        <div class='section'>
            <h3>Personal Information</h3>
            <div class='info-row'><span class='label'>Name:</span> {$firstName} {$lastName}</div>
            <div class='info-row'><span class='label'>Email:</span> {$email}</div>
            <div class='info-row'><span class='label'>Phone:</span> {$phone}</div>
        </div>
        
        <div class='section'>
            <h3>Address Information</h3>
            <div class='info-row'><span class='label'>Street Address:</span> {$streetAddress}</div>
            <div class='info-row'><span class='label'>City:</span> {$city}</div>
            <div class='info-row'><span class='label'>State/Province:</span> {$state}</div>
            <div class='info-row'><span class='label'>Postal Code:</span> {$postalCode}</div>
        </div>
        
        <div class='section'>
            <h3>Property Description</h3>
            <p>{$propertyDescription}</p>
        </div>
        
        <div class='section'>
            <h3>Services Requested</h3>
            <div class='services-list'>
                <ul>";

if (!empty($services)) {
    foreach ($services as $service) {
        $emailBody .= "<li>" . sanitizeInput($service) . "</li>";
    }
} else {
    $emailBody .= "<li>No specific services selected</li>";
}

$emailBody .= "
                </ul>
            </div>
        </div>
        
        <div class='section'>
            <h3>Project Details</h3>
            <div class='info-row'><span class='label'>Project Scope:</span> {$projectScope}</div>
            <div class='info-row'><span class='label'>Budget Range:</span> {$budget}</div>
            <div class='info-row'><span class='label'>Timeline:</span> {$timeline}</div>
        </div>";

if (!empty($additionalInfo)) {
    $emailBody .= "
        <div class='section'>
            <h3>Additional Information</h3>
            <p>{$additionalInfo}</p>
        </div>";
}

$emailBody .= "
        <div class='section'>
            <h3>Contact Information</h3>
            <p><strong>Please contact the customer at:</strong></p>
            <p>Email: <a href='mailto:{$email}'>{$email}</a></p>
            <p>Phone: <a href='tel:{$phone}'>{$phone}</a></p>
        </div>
    </div>
</body>
</html>";

// Email headers
$headers = [
    'MIME-Version: 1.0',
    'Content-type: text/html; charset=UTF-8',
    'From: Fuse Electrical Website <noreply@fuseelectrical.ug>',
    'Reply-To: ' . $email,
    'X-Mailer: PHP/' . phpversion()
];

// Send email
$mailSent = mail($to, $subject, $emailBody, implode("\r\n", $headers));

if ($mailSent) {
    // Log the submission (optional)
    $logEntry = date('Y-m-d H:i:s') . " - Quote request from: {$firstName} {$lastName} ({$email})\n";
    file_put_contents('quote_requests.log', $logEntry, FILE_APPEND | LOCK_EX);
    
    echo json_encode([
        'success' => true, 
        'message' => 'Quote request submitted successfully'
    ]);
} else {
    echo json_encode([
        'success' => false, 
        'message' => 'Failed to send quote request. Please try again or contact us directly.'
    ]);
}
?>
