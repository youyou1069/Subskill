<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Article;
use App\Entity\Category;
use Exception;
use Faker;

class ArticleFixtures extends Fixture {
	/**
	 * @param ObjectManager $manager
	 *
	 * @throws Exception
	 */
	public function load( ObjectManager $manager ): void {
		$faker = Faker\Factory::create();

		//Créer  3 catégories
		for ( $i = 1; $i <= 3; $i ++ ) {
			$category = new Category();
			$category->setTitle( $faker->sentence() );

			$manager->persist( $category );

			// créer entre 2-3 articles

			for ( $j = 1; $j <= mt_rand (2, 3); $j ++ ) {
				$article     = new Article();
				$description = '<p>' . implode( '</p><p>', $faker->paragraphs( 5 ) ) . '</p>';
				$article->setTitle( $faker->sentence() )
				        ->setDescription( $description )
				        ->setImage( $faker->imageUrl( $width = 640, $height = 480 ) )
				        ->setCreatedAt( $faker->dateTimeBetween( '+2 years', '+3 years' ) )
				        ->setCategory( $category );

				$manager->persist( $article );


			}
		}

		$manager->flush();
	}
}
