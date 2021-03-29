<?php

if(!isset($_POST['submit']))
{
	//This page should not be accessed directly. Need to submit the form.
	echo "error; you need to submit the form!";
}
  $name = $_POST['name'];
  $visitor_email = $_POST['email'];
  $subject = $_POST['subject'];
  $message = $_POST['message'];

  //Validation
  if(empty($name)||empty($visitor_email))
  {
      echo "Please, provide your name and email address";
      exit;
  }

  if(IsInjected($visitor_email))
  {
      echo "Somenthing went wrong";
      exit;
  }

  //Composing message
	$email_from = 'yourname@yourwebsite.com';

	$email_subject = "A message from your webpage";

	$email_body = "You have received a new message from the user $name.\n".
                            "Subject: $subject.\n".
                            "Here is the message:\n $message".

//Sending message
  $to = "oscar.rubilar7@gmail.com";

  $headers = "From: $email_from \r\n";

  $headers .= "Reply-To: $visitor_email \r\n";

//Sending!!

  mail($to,$email_subject,$email_body,$headers);

  //Don't you dare to spam me!

  function IsInjected($str)
  {
    $injections = array('(\n+)',
                '(\r+)',
                '(\t+)',
                '(%0A+)',
                '(%0D+)',
                '(%08+)',
                '(%09+)'
                );
    $inject = join('|', $injections);
    $inject = "/$inject/i";
    if(preg_match($inject,$str))
      {
      return true;
    }
    else
      {
      return false;
    }
  }
  ?>
