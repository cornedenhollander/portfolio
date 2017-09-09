<?php
function Validate()
{
    if(     empty($_POST['name'])            ||
            empty($_POST['email'])      ||
            empty($_POST['message'])    ||
            !filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)) {

            return false;
       }
    else
        return true;
}

function SendEmail($to = 'hello@cornedenhollander.nl')
{
    if(Validate() == true) {
            $name           =   $_POST['name'];
            $email_address  =   $_POST['email'];
            $message        =   $_POST['message'];

            $email_subject  =   "Contactformulier cornedenhollander.nl:  $name";
            $email_body     =   "Bedankt voor het invullen van het contact formulier op cornedenhollander.nl! Ik zal uw vraag/opmerking zo spoedig mogelijk behandelen...\n\nNaam:\n$name\n\nE-mail:\n$email_address\n\nBericht:\n$message";
            $headers        =   "From: noreply@cornedenhollander.nl\n";
            $headers        .= "Reply-To: $email_address";
            
            return (mail($to,$email_subject,$email_body,$headers))? true: false;
        }
    else
        return 'err';
}

$send   =   SendEmail();

if($send == 'err')
    echo 'Invalid Fields.';
elseif($send == false)
    echo 'An Error Occurred.';
else
    echo 'Email Sent Successfully.';       
?>