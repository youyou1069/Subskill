<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType {
	/**
	 * @param FormBuilderInterface $builder
	 * @param array $options
	 */
	public function buildForm( FormBuilderInterface $builder, array $options ) {
		$builder
			->add( 'gender', ChoiceType::class, array(
				'choices'    => array( 'Mme' => 'Mme ', 'M' => 'M' ),
				'required'   => true,
				'label'      => 'Civilité',
				'expanded'   => true,
				'label_attr' => [
					'class' => 'radio-inline'
				]
			) )
			->add( 'lastName', TextType::class, [
				'label' => 'Nom',
			] )
			->add( 'firstName', TextType::class, [
				'label' => 'Prénom',
			] )
			->add( 'email', EmailType::class, [
				'label' => 'Email',
			] )
			->add( 'objet', ChoiceType::class, array(
				'choices'  => array(
					'Recrutement' => 'Recrutement ',
					'Support'     => 'Support',
					'Marketing'   => 'Marketing'
				),
				'required' => true,

			) )
			->add( 'message', TextareaType::class, [
				'label' => 'Message',
			] );
	}

	/**
	 * @param OptionsResolver $resolver
	 */
	public function configureOptions( OptionsResolver $resolver ) {
		$resolver->setDefaults( [
			'data_class' => Contact::class

		] );


	}

}
