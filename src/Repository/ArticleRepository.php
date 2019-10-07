<?php

namespace App\Repository;

use App\Entity\Article;
use App\Entity\ArticleSearch;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Article|null find( $id, $lockMode = null, $lockVersion = null )
 * @method Article|null findOneBy( array $criteria, array $orderBy = null )
 * @method Article[]    findAll()
 * @method Article[]    findBy( array $criteria, array $orderBy = null, $limit = null, $offset = null )
 */
class ArticleRepository extends ServiceEntityRepository {
	public function __construct( ManagerRegistry $registry ) {
		parent::__construct( $registry, Article::class );
	}


	public function findAllSearch( ArticleSearch $search ) {
		return $this->createQueryBuilder( 'a' )
		            ->where( 'a.category = :category' )
		            ->setParameter( 'category', $search->getCategory() )
		            ->orderBy( 'a.createdAt', 'DESC' )
		            ->getQuery()
		            ->getResult();
	}

	public function findAllArticle() {
		return $this->createQueryBuilder( 'a' )
		            ->orderBy( 'a.createdAt', 'DESC' )
		            ->getQuery()
		            ->getResult();

	}
}
