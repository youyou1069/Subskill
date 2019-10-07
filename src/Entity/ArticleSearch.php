<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;


class ArticleSearch {

	/**
	 * @var ArrayCollection
	 */
	private $category;

	/**
	 * @return mixed
	 */
	public function getCategory() {
		return $this->category;
	}


	public function __construct() {
		$this->category = new ArrayCollection();
	}

	/**
	 * @param mixed $category
	 *
	 * @return ArticleSearch
	 */
	public function setCategory( $category ): ArticleSearch {
		$this->category = $category;

		return $this;
	}


}
