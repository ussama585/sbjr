<?php
$email = $_POST["email"];
$form_type = $_POST["form_type"];
$email_from = $email;

// Email subject based on form type
if ($form_type == 'invitation') {
   $subject = "Secure Invitation";
} else {
   $full_name = $_POST["full_name"];
   $subject = "Contact Us Email";
}

session_start();
$email_subject =  $subject;
$email_txt = '';

// Email recipient
$email_to = 'usama7xami@gmail.com';

// Headers setup for the email
$headers = "From: " . strip_tags($email_from) . "\r\n";
$headers .= "Reply-To: " . strip_tags($email_from) . "\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=UTF-8\r\n";

// Base message body
$msg_txt = "\n\n You have received a new invitation message from <strong>" . $email_from . "</strong><br>";
$email_txt .= $msg_txt;

// Handle Invitation Form (with multiple rows of data)
if ($form_type == 'invitation') {
   // Get row count (assuming rows are submitted as arrays)
   if (isset($_POST["suffix"]) && is_array($_POST["suffix"])) {
      $row_count = count($_POST["suffix"]);

      // Loop through each row
      for ($i = 0; $i < $row_count; $i++) {
         $suffix = $_POST["suffix"][$i];
         $first_name = $_POST["firstname"][$i];
         $last_name = $_POST["lastname"][$i];
         $company = $_POST["company"][$i];
         $position = $_POST["position"][$i];
         $email = $_POST["email"][$i];
         $country_code = $_POST["countrycode"][$i];
         $phone_number = $_POST["cellular"][$i];

         // Full name of the participant
         $full_name = $first_name . ' ' . $last_name;

         // Add each participant's details to the email body
         $email_txt .= '<br><strong>Participant ' . ($i + 1) . ':</strong><br>';
         $email_txt .= '<strong>Full Name: </strong>' . $full_name . '<br>';
         $email_txt .= '<strong>Suffix: </strong>' . $suffix . '<br>';
         $email_txt .= '<strong>Company: </strong>' . $company . '<br>';
         $email_txt .= '<strong>Position: </strong>' . $position . '<br>';
         $email_txt .= '<strong>Email: </strong>' . $email . '<br>';
         $email_txt .= '<strong>Country Code: </strong>' . $country_code . '<br>';
         $email_txt .= '<strong>Phone Number: </strong>' . $phone_number . '<br>';
      }
   } else {
      echo "No invitation data provided.";
      exit;
   }
} else {
   $full_name = $_POST["full_name"];
   $subject = "Contact Us Email";
}
session_start();
$email_subject =  $subject;
$email_txt = '';
//   $email_to = 'ajaved.859@gmail.com';
$email_to = 'usama7xami@gmail.com';
//   $email_to = 'invitation@saudibanksjointreception.com';
$headers = "From: " . $email_from;
$headers  = "From: " . strip_tags($email_from) . "\r\n";
$headers .= "Reply-To: " . strip_tags($email_from) . "\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=UTF-8\r\n";
$msg_txt = "\n\n You have recieved a new attachment message from <strong>" . $email_from . "</strong><br>";
$email_txt .= $msg_txt;
$email_txt .= '<strong>Full Name: </strong> ' . $full_name . '<br>';
if ($form_type == 'invitation') {
   $email_txt .= '<strong>Suffix: </strong> ' . $suffix . '<br>';
   $email_txt .= '<strong>Company: </strong> ' . $company . '<br>';
   $email_txt .= '<strong>Position: </strong> ' . $position . '<br>';
   $email_txt .= '<strong>Country Code: </strong> ' . $country_code . '<br>';
   $email_txt .= '<strong>Phone Number: </strong> ' . $phone_number . '<br>';
}
// $email_txt .= '<strong>Body: </strong>'.$message_body;
$email_message = $email_txt;
$ok = mail($email_to, $email_subject, $headers);
// $ok = mail($email_to, $email_subject, $email_message, $headers);

// Redirect based on success or failure
if ($ok) {
   $_SESSION["form_submit"] = "success";
   header("Location: https://saudibanksjointreception.com");
} else {
   $_SESSION["form_submit"] = "error";
   header("Location: https://saudibanksjointreception.com");
}
