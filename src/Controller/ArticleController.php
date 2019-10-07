<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\ArticleSearch;
use App\Form\ArticleSearchType;
use App\Form\ArticleType;
use App\Repository\ArticleRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/")
 */
class ArticleController extends AbstractController {

	private $repo;

	private $em;


	/**
	 * ArticleController constructor.
	 *
	 * @param ArticleRepository $repo
	 * @param ObjectManager $sm
	 */
	public function __construct( ArticleRepository $repo, ObjectManager $sm ) {
		$this->repo = $repo;
		$this->em = $sm;
	}
	/**
	 * @Route("", name="home")
	 */
	public function homeAction(): Response
	{
		return $this->redirectToRoute( 'article_index' );
	}

	/**
	 * @Route("article", name="article_index")
	 * @param ArticleRepository $repo
	 * @param Request $request
	 * @return Response
	 */
	public function indexAction( ArticleRepository $repo, Request $request ): Response {
		$search = new ArticleSearch();
		$form   = $this->createForm( ArticleSearchType::class, $search );
		$form->handleRequest( $request );
		if ( $form->isSubmitted() && $form->isValid() ) {
			$articles = $repo->findAllSearch( $search );

			return $this->render( 'article/index.html.twig', [
				'articles' => $articles,
				'form'     => $form->createView()
			] );
		}
		$articles = $repo->findAllArticle();

		return $this->render( 'article/index.html.twig', [
			'articles' => $articles,
			'form'     => $form->createView()

		] );
	}


	/**
	 * @Route("article/new", name="article_new", methods={"GET","POST"})
	 * @param Request $request
	 * @return Response
	 * @throws Exception
	 */
	public function newAction( Request $request ): Response {
		$article = new Article();
		$form    = $this->createForm( ArticleType::class, $article );
		$form->handleRequest( $request );

		if ( $form->isSubmitted() && $form->isValid() ) {
			$entityManager = $this->getDoctrine()->getManager();
			$entityManager->persist( $article );
			$entityManager->flush();

			return $this->redirectToRoute( 'article_index' );
		}

		return $this->render( 'article/new.html.twig', [
			'article' => $article,
			'form'    => $form->createView(),
		] );
	}

	/**
	 * @Route("article/{id}", name="article_show", methods={"GET"})
	 * @param Article $article
	 * @return Response
	 */
	public function showAction( Article $article ): Response {
		return $this->render( 'article/show.html.twig', [
			'article' => $article,
		] );
	}

	/**
	 * @Route("article/{id}/edit", name="article_edit", methods={"GET","POST"})
	 * @param Request $request
	 * @param Article $article
	 * @return Response
	 */
	public function editAction( Request $request, Article $article ): Response {
		$form = $this->createForm( ArticleType::class, $article );
		$form->handleRequest( $request );

		if ( $form->isSubmitted() && $form->isValid() ) {
			$this->getDoctrine()->getManager()->flush();

			return $this->redirectToRoute( 'article_index' );
		}

		return $this->render( 'article/edit.html.twig', [
			'article' => $article,
			'form'    => $form->createView(),
		] );
	}

	/**
	 * @Route("article/{id}", name="article_delete", methods={"DELETE"})
	 * @param Request $request
	 * @param Article $article
	 * @return Response
	 */
	public function deleteAction( Request $request, Article $article ): Response {
		if ( $this->isCsrfTokenValid( 'delete' . $article->getId(), $request->request->get( '_token' ) ) ) {
			$entityManager = $this->getDoctrine()->getManager();
			$entityManager->remove( $article );
			$entityManager->flush();
		}

		return $this->redirectToRoute( 'article_index' );
	}
}
