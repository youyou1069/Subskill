<?php

namespace App\Controller;

use App\Entity\Category;
use App\Form\CategoryType;
use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/category")
 */
class CategoryController extends AbstractController {
	/**
	 * @Route("/", name="category_index", methods={"GET"})
	 * @param CategoryRepository $categoryRepository
	 *
	 * @return Response
	 */
	public function indexAction( CategoryRepository $categoryRepository ): Response {
		return $this->render( 'category/index.html.twig', [
			'categories' => $categoryRepository->findAll(),
		] );
	}

	/**
	 * @Route("/new", name="category_new", methods={"GET","POST"})
	 * @param Request $request
	 *
	 * @return Response
	 */
	public function newAction( Request $request ): Response {
		$category = new Category();
		$form     = $this->createForm( CategoryType::class, $category );
		$form->handleRequest( $request );

		if ( $form->isSubmitted() && $form->isValid() ) {
			$entityManager = $this->getDoctrine()->getManager();
			$entityManager->persist( $category );
			$entityManager->flush();

			return $this->redirectToRoute( 'category_index' );
		}

		return $this->render( 'category/new.html.twig', [
			'category' => $category,
			'form'     => $form->createView(),
		] );
	}

	/**
	 * @Route("/{id}", name="category_show", methods={"GET"})
	 * @param Category $category
	 *
	 * @return Response
	 */
	public function showAction( Category $category ): Response {
		return $this->render( 'category/show.html.twig', [
			'category' => $category,
		] );
	}

	/**
	 * @Route("/{id}/edit", name="category_edit", methods={"GET","POST"})
	 * @param Request $request
	 * @param Category $category
	 *
	 * @return Response
	 */
	public function edit( Request $request, Category $category ): Response {
		$form = $this->createForm( CategoryType::class, $category );
		$form->handleRequest( $request );

		if ( $form->isSubmitted() && $form->isValid() ) {
			$this->getDoctrine()->getManager()->flush();

			return $this->redirectToRoute( 'category_index' );
		}

		return $this->render( 'category/edit.html.twig', [
			'category' => $category,
			'form'     => $form->createView(),
		] );
	}

	/**
	 * @Route("/{id}", name="category_delete", methods={"DELETE"})
	 * @param Request $request
	 * @param Category $category
	 *
	 * @return Response
	 */
	public function deleteAction( Request $request, Category $category ): Response {
		if ( $this->isCsrfTokenValid( 'delete' . $category->getId(), $request->request->get( '_token' ) ) ) {
			$entityManager = $this->getDoctrine()->getManager();
			$entityManager->remove( $category );
			$entityManager->flush();
		}

		return $this->redirectToRoute( 'category_index' );
	}
}
