<?php

namespace App\Notification;

use App\Entity\Contact;
use Swift_Mailer;
use Swift_Message;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class ContactNotification {
	/**
	 * @var Swift_Mailer
	 */
	private $mailer;
	/**
	 * @var Environment
	 */
	private $renderer;

	/**
	 * ContactNotification constructor.
	 *
	 * @param Swift_Mailer $mailer
	 * @param Environment $renderer
	 */
	public function __construct( Swift_Mailer $mailer, Environment $renderer ) {
		$this->mailer   = $mailer;
		$this->renderer = $renderer;
	}

	/**
	 * @param Contact $contact
	 *
	 * @throws SyntaxError
	 * @throws LoaderError
	 * @throws RuntimeError
	 */
	public function notifyAction( Contact $contact ) :void {
		$message = ( new Swift_Message( 'objet : ' . $contact->getObjet() ) )
			->setFrom( 'noreply@server.fr' )
			->setTo( 'larasyounes@yahoo.fr' )
			->setReplyTo( $contact->getEmail() )
			->setBody( $this->renderer->render( 'emails/index.html.twig', [
				'contact' => $contact
			] ), 'text/html' );
		$this->mailer->send( $message );
	}
}