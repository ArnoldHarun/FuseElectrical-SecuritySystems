<?php
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and collect form data
    $firstName = htmlspecialchars($_POST['firstName'] ?? '');
    $lastName = htmlspecialchars($_POST['lastName'] ?? '');
    $email = filter_var($_POST['email'] ?? '', FILTER_SANITIZE_EMAIL);
    $phone = htmlspecialchars($_POST['phone'] ?? '');
    $propertyDescription = htmlspecialchars($_POST['propertyDescription'] ?? '');
    $city = htmlspecialchars($_POST['city'] ?? '');
    $streetAddress = htmlspecialchars($_POST['streetAddress'] ?? '');
    $state = htmlspecialchars($_POST['state'] ?? '');
    $postalCode = htmlspecialchars($_POST['postalCode'] ?? '');
    $services = htmlspecialchars($_POST['services'] ?? '');
    $projectScope = htmlspecialchars($_POST['projectScope'] ?? '');
    $budget = htmlspecialchars($_POST['budget'] ?? '');
    $timeline = htmlspecialchars($_POST['timeline'] ?? '');
    $additionalInfo = htmlspecialchars($_POST['additionalInfo'] ?? '');
    
    // Validate required fields
    if (empty($firstName) || empty($lastName) || empty($email) || empty($phone)) {
        echo json_encode(['success' => false, 'message' => 'Please fill in all required fields.']);
        exit;
    }
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(['success' => false, 'message' => 'Please enter a valid email address.']);
        exit;
    }
    
    // Email configuration
    $to = 'quotes@fuseelectrotech.com'; // Replace with your company email
    $subject = 'New Quote Request from ' . $firstName . ' ' . $lastName;
    
    // Create email content
    $message = "
    <html>
    <head>
        <title>New Quote Request</title>
        <style>
            body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
            .header { background-color: #f8f9fa; padding: 20px; border-bottom: 3px solid #007bff; }
            .content { padding: 20px; }
            .section { margin-bottom: 25px; }
            .section h3 { color: #007bff; border-bottom: 2px solid #007bff; padding-bottom: 5px; }
            .info-row { margin-bottom: 10px; }
            .label { font-weight: bold; color: #555; }
            .value { margin-left: 10px; }
        </style>
    </head>
    <body>
        <div class='header'>
            <h2>New Quote Request - Fuse Electrotech</h2>
            <p>Received on: " . date('Y-m-d H:i:s') . "</p>
        </div>
        
        <div class='content'>
            <div class='section'>
                <h3>Personal Information</h3>
                <div class='info-row'><span class='label'>Name:</span><span class='value'>{$firstName} {$lastName}</span></div>
                <div class='info-row'><span class='label'>Email:</span><span class='value'>{$email}</span></div>
                <div class='info-row'><span class='label'>Phone:</span><span class='value'>{$phone}</span></div>
            </div>
            
            <div class='section'>
                <h3>Address Information</h3>
                <div class='info-row'><span class='label'>Street Address:</span><span class='value'>{$streetAddress}</span></div>
                <div class='info-row'><span class='label'>City:</span><span class='value'>{$city}</span></div>
                <div class='info-row'><span class='label'>State:</span><span class='value'>{$state}</span></div>
                <div class='info-row'><span class='label'>Postal Code:</span><span class='value'>{$postalCode}</span></div>
            </div>
            
            <div class='section'>
                <h3>Project Details</h3>
                <div class='info-row'><span class='label'>Services Requested:</span><span class='value'>{$services}</span></div>
                <div class='info-row'><span class='label'>Project Scope:</span><span class='value'>{$projectScope}</span></div>
                <div class='info-row'><span class='label'>Budget Range:</span><span class='value'>{$budget}</span></div>
                <div class='info-row'><span class='label'>Timeline:</span><span class='value'>{$timeline}</span></div>
            </div>
            
            <div class='section'>
                <h3>Property Description</h3>
                <p>{$propertyDescription}</p>
            </div>
            
            <div class='section'>
                <h3>Additional Information</h3>
                <p>{$additionalInfo}</p>
            </div>
        </div>
    </body>
    </html>
    ";
    
    // Email headers
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= "From: noreply@fuseelectrotech.com" . "\r\n";
    $headers .= "Reply-To: {$email}" . "\r\n";
    
    // Send email
    if (mail($to, $subject, $message, $headers)) {
        // Log the submission (optional)
        $logEntry = date('Y-m-d H:i:s') . " - Quote request from {$firstName} {$lastName} ({$email})\n";
        file_put_contents('quote_requests.log', $logEntry, FILE_APPEND | LOCK_EX);
        
        echo json_encode(['success' => true, 'message' => 'Quote request submitted successfully.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to send email. Please try again.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
}
?>
