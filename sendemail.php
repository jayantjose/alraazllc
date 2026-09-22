<?php
	$name = @trim(stripslashes($_POST['name'])); 
	$email = @trim(stripslashes($_POST['email']));
	$subject = @trim(stripslashes($_POST['subject']));
	$website = @trim(stripslashes($_POST['website']));
	$message = @trim(stripslashes($_POST['message'])); 
 

 	$body = 'Name: ' . $name . "\n\n" . 'Email: ' . $email . "\n\n" . 'Subject: ' . $subject . "\n\n" . 'Website: ' . $website . "\n\n" . 'Message: ' . $message;

	$to      = 'info@alraazllc.com';
	$subject = 'New comment for Al Raaz LLC';

	$headers = 'From: Al Raaz LLC - Web Alert <info@alraazllc.com>' . "\r\n" .
		'Reply-To: Al Raaz LLC - Web Alert <info@alraazllc.com>' . "\r\n" .
		'X-Mailer: PHP/' . phpversion();
	
	$success = mail($to, $subject, $body, $headers);
	
	
	if($success==1) {
	    echo "Mail Send Successfully";
	}
	else {
	   echo "Mail Send Failed";	
	}

	// Save to Contact XML File
	$contactFile = "xml/contact.xml";

	$xml = new DOMDocument();

	$nodeID=1;
	if(file_exists($contactFile)) {
		$xml->load($contactFile);
		$nodes = $xml->getElementsByTagName('Name') ;
		$nodeID = $nodes->length;
		$nodeID++;
		$root_node = $xml->documentElement;
	}
	else {
		$root_node = $xml->createElement("contacts");
	}

	$xml_contact = $xml->createElement("contact");
	$xml_id = $xml->createElement("id",$nodeID);
	$xml_name = $xml->createElement("Name",$name);
	$xml_email = $xml->createElement("Email",$email);
	$xml_message = $xml->createElement("Message",$message);

	$xml_contact->appendChild( $xml_id );
	$xml_contact->appendChild( $xml_name );
	$xml_contact->appendChild( $xml_email );
	$xml_contact->appendChild( $xml_message );

	$root_node->appendChild( $xml_contact );

	$xml->appendChild( $root_node );

	$xml->save($contactFile);




    die; 
?>