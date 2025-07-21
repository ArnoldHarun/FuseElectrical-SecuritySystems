<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $project_type = strip_tags(trim($_POST["project_type"]));
    $project_size = strip_tags(trim($_POST["project_size"]));
    $timeline = strip_tags(trim($_POST["timeline"]));
    $budget = strip_tags(trim($_POST["budget"]));
    $services = isset($_POST["services"]) ? $_POST["services"] : array();
    $project_description = strip_tags(trim($_POST["project_description"]));
    $full_name = strip_tags(trim($_POST["full_name"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $phone = strip_tags(trim($_POST["phone"]));
    $company = strip_tags(trim($_POST["company"]));
    $location = strip_tags(trim($_POST["location"]));
    $preferred_contact = strip_tags(trim($_POST["preferred_contact"]));
    $additional_notes = strip_tags(trim($_POST["additional_notes"]));

    // Validate required fields
    if (empty($project_type) || empty($project_size) || empty($full_name) || empty($email) || empty($phone) || empty($location) || empty($services)) {
        http_response_code(400);
        echo "Please fill in all required fields.";
        exit;
    }

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        http_response_code(400);
        echo "Please provide a valid email address.";
        exit;
    }

    // Set the recipient email address
    $recipient = "harunk3570@gmail.com";

    // Set the email subject
    $email_subject = "New Quote Request from $full_name";

    // Build the email content
    $email_content = "New Quote Request Details:\n\n";
    $email_content .= "=== PROJECT INFORMATION ===\n";
    $email_content .= "Project Type: $project_type\n";
    $email_content .= "Project Size: $project_size\n";
    $email_content .= "Timeline: $timeline\n";
    $email_content .= "Budget: $budget\n\n";
    
    $email_content .= "=== SERVICES REQUIRED ===\n";
    foreach ($services as $service) {
        $service_name = str_replace('-', ' ', ucwords($service, '-'));
        $email_content .= "• $service_name\n";
    }
    $email_content .= "\n";
    
    if (!empty($project_description)) {
        $email_content .= "=== PROJECT DESCRIPTION ===\n";
        $email_content .= "$project_description\n\n";
    }
    
    $email_content .= "=== CONTACT INFORMATION ===\n";
    $email_content .= "Name: $full_name\n";
    $email_content .= "Email: $email\n";
    $email_content .= "Phone: $phone\n";
    if (!empty($company)) {
        $email_content .= "Company: $company\n";
    }
    $email_content .= "Location: $location\n";
    $email_content .= "Preferred Contact: $preferred_contact\n";
    
    if (!empty($additional_notes)) {
        $email_content .= "\n=== ADDITIONAL NOTES ===\n";
        $email_content .= "$additional_notes\n";
    }
    
    $email_content .= "\n=== SUBMISSION DETAILS ===\n";
    $email_content .= "Submitted: " . date('Y-m-d H:i:s') . "\n";
    $email_content .= "IP Address: " . $_SERVER['REMOTE_ADDR'] . "\n";

    // Build the email headers
    $email_headers = "From: $full_name <$email>\r\n";
    $email_headers .= "Reply-To: $email\r\n";
    $email_headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    // Send the email
    if (mail($recipient, $email_subject, $email_content, $email_headers)) {
        http_response_code(200);
        echo "OK";
    } else {
        http_response_code(500);
        echo "Sorry, there was an error sending your quote request. Please try again or contact us directly.";
    }
} else {
    http_response_code(405);
    echo "Method not allowed.";
}
?>
