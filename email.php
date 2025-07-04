<?php

$errors = '';
$myemail = 'hasanmdrizvee@gmail.com'; // Updated email address

// Check for required fields
if(empty($_POST['firstname'])  ||
   empty($_POST['email']) ||
   empty($_POST['subject']) || 
   empty($_POST['message']))
{
    $errors .= "\n Error: Name, Email, Subject, and Message are required fields.";
}

$firstname = isset($_POST['firstname']) ? $_POST['firstname'] : '';
$email_address = isset($_POST['email']) ? $_POST['email'] : '';
$subject_form = isset($_POST['subject']) ? $_POST['subject'] : 'Contact Form Submission'; // Default subject
$message_form = isset($_POST['message']) ? $_POST['message'] : '';
$phone = isset($_POST['phone']) ? $_POST['phone'] : 'Not provided';
$service_needed = isset($_POST['service_needed']) ? $_POST['service_needed'] : 'Not specified';

// Validate email
if (!empty($email_address) && !filter_var($email_address, FILTER_VALIDATE_EMAIL))
{
    $errors .= "\n Error: Invalid email address";
}

if( empty($errors))
{
	$to = $myemail;
	$email_subject = "Portfolio Contact: " . strip_tags($subject_form);

	$email_body = "You have received a new message from your portfolio contact form:\n\n";
    $email_body .= "Name: " . strip_tags($firstname) . "\n";
    $email_body .= "Email: " . strip_tags($email_address) . "\n";
    $email_body .= "Phone: " . strip_tags($phone) . "\n";
    $email_body .= "Service Interested In: " . strip_tags($service_needed) . "\n";
    $email_body .= "Subject: " . strip_tags($subject_form) . "\n";
    $email_body .= "Message: \n" . strip_tags($message_form) . "\n";
	
	$headers = "From: noreply@rizvee.github.io\n"; // Generic sender, or use $myemail
	$headers .= "Reply-To: " . strip_tags($email_address) . "\r\n";
	$headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
	
	$send = mail($to, $email_subject, $email_body, $headers);
	if($send)
	{
		echo "success";
	}
	else{
		echo "error";
	}

} 

?>