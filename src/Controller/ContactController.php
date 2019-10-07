<?php


namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Notification\ContactNotification;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class ContactController extends AbstractController {

	/**
	 * @Route("/contact", name="contact")
	 * @param Request $request
	 * @param ContactNotification $contactNotification
	 *
	 * @return Response
	 * @throws LoaderError
	 * @throws RuntimeError
	 * @throws SyntaxError
	 */
	public function contactAction( Request $request, ContactNotification $contactNotification ): Response {
		$contact = new Contact();
		$form    = $this->createForm( ContactType::class, $contact );
		$form->handleRequest( $request );

		if ( $form->isSubmitted() && $form->isValid() ) {
			$contactNotification->notifyAction( $contact );
			$this->addFlash( 'success', 'Votre email à bien été envoyé' );

			return $this->redirectToRoute( 'contact' );
		}

		return $this->render( '/contact/index.html.twig', [
			'form' => $form->createView()
		] );
	}

}