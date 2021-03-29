<?php

	//Input from form

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
	$email_from = 'o.rubilar.conductor@outlook.de';

	$email_subject = "A message from your webpage";

	$email_body = "You have received a new message from $name, ($visitor_email).\n To reply, just reply to this message.\n".
                            "Subject: $subject.\n".
                            "Here is the message:\n $message\r\n".

//Sending message

    $to = "marcos.stuardo@post.cz";

    $headers = "From: $email_from \r\n";

    $headers = "Reply-To: \n $visitor_email \r\n";

    $sent = mail($to,$email_subject,$email_body,$headers);

//Sending!!


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

	#Thank user or notify them of a problem
