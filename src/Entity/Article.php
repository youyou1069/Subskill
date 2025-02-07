<?php

namespace App\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Exception;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ArticleRepository")
 */
class Article {
	/**
	 * @ORM\Id()
	 * @ORM\GeneratedValue()
	 * @ORM\Column(type="integer")
	 */
	private $id;

	/**
	 * @ORM\Column(type="string", length=255)
	 */
	private $title;

	/**
	 * @ORM\Column(type="string", length=255)
	 */
	private $image;

	/**
	 * @ORM\Column(type="text")
	 */
	private $description;

	/**
	 * @ORM\Column(type="datetime")
	 */
	private $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Category", inversedBy="Articles", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $category;

	/**
	 * @throws Exception
	 */
	public function __construct() {
         		$this->createdAt = new DateTime( 'now' );
         	}


	public function getId(): ?int {
         		return $this->id;
         	}

	public function getTitle(): ?string {
         		return $this->title;
         	}

	public function setTitle( string $title ): self {
         		$this->title = $title;
         
         		return $this;
         	}

	public function getImage(): ?string {
         		return $this->image;
         	}

	public function setImage( string $image ): self {
         		$this->image = $image;
         
         		return $this;
         	}

	public function getDescription(): ?string {
         		return $this->description;
         	}

	public function setDescription( string $description ): self {
         		$this->description = $description;
         
         		return $this;
         	}

	public function getCreatedAt(): ?\DateTimeInterface {
         		return $this->createdAt;
         	}

	public function setCreatedAt( \DateTimeInterface $createdAt ): self {
         		$this->createdAt = $createdAt;
         
         		return $this;
         	}

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }
	public function __toString(): string
	{
		return $this->category;
	}
}





