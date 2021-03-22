<?php

namespace App\Notification;

use Twig\Environment;
use App\Entity\Contact;
use Swift_Mailer;

class ContactNotification {


    public function __construct(\Swift_Mailer $mailer, Environment $renderer)
    {
        $this->mailer = $mailer;
        $this->renderer = $renderer;
    }

    public function notify(Contact $contact) {

        $subject = "Message de M -  " . $contact->getLastname() . ' ' . $contact->getFirstname() . " depuis le site pour le salon de toilettage ";

        $message = (new \Swift_Message($subject))
                    ->setFrom($contact->getEmail())
                    ->setTo('salonplaydogs@gmail.com')
                    ->setReplyTo($contact->getEmail())
                    ->setBody($this->renderer->render('emails/contact.html.twig', [
                        'contact' => $contact
                    ]), 'text/html');
        $this->mailer->send($message);

        
    }

}

?>