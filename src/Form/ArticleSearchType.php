<?php


namespace App\Form;

use App\Entity\ArticleSearch;
use App\Entity\Category;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleSearchType extends AbstractType {
	/**
	 * @param FormBuilderInterface $builder
	 * @param array $options
	 */
	public function buildForm( FormBuilderInterface $builder, array $options ) {
		$builder
			->add( 'category', EntityType::class, [
				'class'        => Category::class,
				'required'     => false,
				'label'        => false,
				'choice_label' => 'title',
				'placeholder'  => 'Sélectionner une catégorie'
			] );
	}

	/**
	 * @param OptionsResolver $resolver
	 */
	public function configureOptions( OptionsResolver $resolver ) {
		$resolver->setDefaults( [
			'data_class'      => ArticleSearch::class,
			'method'          => 'get',
			'csrf_protection' => false
		] );
	}


	//Créer une méthode pour alléger le contenu du URL

	/**
	 * @return string|null
	 */
	public function getBlockPrefix() {
		return '';
	}
}