<?php
header('Content-Type: application/json');

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
if (empty($firstName) || empty($lastName) || empty($email) || empty($phone)) {
    echo json_encode(['success' => false, 'message' => 'Please fill in all required fields']);
    exit;
}

// Validate email
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(['success' => false, 'message' => 'Please enter a valid email address']);
    exit;
}

// Prepare email content
$to = 'info@fuseelectrical.ug';
$subject = 'New Quote Request from ' . $firstName . ' ' . $lastName;

// Create HTML email content
$htmlMessage = '
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>New Quote Request</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .header { background: #50d8af; color: white; padding: 20px; text-align: center; }
        .content { padding: 20px; }
        .section { margin-bottom: 25px; }
        .section h3 { color: #50d8af; border-bottom: 2
        .section { margin-bottom: 25px; }
        .section h3 { color: #50d8af; border-bottom: 2px solid #50d8af; padding-bottom: 5px; }
        .info-row { margin: 10px 0; }
        .label { font-weight: bold; color: #666; }
        .value { margin-left: 10px; }
        .services-list { list-style: none; padding: 0; }
        .services-list li { background: #f8f9fa; margin: 5px 0; padding: 8px; border-left: 3px solid #50d8af; }
        .footer { background: #f8f9fa; padding: 15px; text-align: center; font-size: 12px; color: #666; }
    </style>
</head>
<body>
    <div class="header">
        <h2>New Quote Request - Fuse Electrical and Security Systems</h2>
    </div>
    
    <div class="content">
        <div class="section">
            <h3>Personal Information</h3>
            <div class="info-row"><span class="label">Name:</span><span class="value">' . $firstName . ' ' . $lastName . '</span></div>
            <div class="info-row"><span class="label">Email:</span><span class="value">' . $email . '</span></div>
            <div class="info-row"><span class="label">Phone:</span><span class="value">' . $phone . '</span></div>
        </div>
        
        <div class="section">
            <h3>Property Information</h3>
            <div class="info-row"><span class="label">Address:</span><span class="value">' . $streetAddress . ', ' . $city . ', ' . $state . ' ' . $postalCode . '</span></div>
            <div class="info-row"><span class="label">Property Description:</span><span class="value">' . $propertyDescription . '</span></div>
        </div>
        
        <div class="section">
            <h3>Project Details</h3>
            <div class="info-row"><span class="label">Services Requested:</span></div>
            <ul class="services-list">';

if (!empty($services)) {
    foreach ($services as $service) {
        $htmlMessage .= '<li>' . sanitizeInput($service) . '</li>';
    }
} else {
    $htmlMessage .= '<li>No specific services selected</li>';
}

$htmlMessage .= '
            </ul>
            <div class="info-row"><span class="label">Project Scope:</span><span class="value">' . $projectScope . '</span></div>
            <div class="info-row"><span class="label">Budget Range:</span><span class="value">' . $budget . '</span></div>
            <div class="info-row"><span class="label">Timeline:</span><span class="value">' . $timeline . '</span></div>
            <div class="info-row"><span class="label">Additional Information:</span><span class="value">' . $additionalInfo . '</span></div>
        </div>
    </div>
    
    <div class="footer">
        <p>This quote request was submitted on ' . date('Y-m-d H:i:s') . ' from the Fuse Electrical and Security Systems website.</p>
        <p>Please respond to this request within 24 hours for the best customer experience.</p>
    </div>
</body>
</html>';

// Email headers
$headers = array(
    'MIME-Version: 1.0',
    'Content-type: text/html; charset=UTF-8',
    'From: Quote System <noreply@fuseelectrical.ug>',
    'Reply-To: ' . $email,
    'X-Mailer: PHP/' . phpversion()
);

// Send email
$mailSent = mail($to, $subject, $htmlMessage, implode("\r\n", $headers));

// Log the quote request (optional)
$logEntry = date('Y-m-d H:i:s') . " - Quote request from: " . $firstName . " " . $lastName . " (" . $email . ")\n";
file_put_contents('quote_requests.log', $logEntry, FILE_APPEND | LOCK_EX);

// Return response
if ($mailSent) {
    echo json_encode([
        'success' => true, 
        'message' => 'Quote request submitted successfully'
    ]);
} else {
    echo json_encode([
        'success' => false, 
        'message' => 'Failed to send quote request. Please try again.'
    ]);
}
?>
