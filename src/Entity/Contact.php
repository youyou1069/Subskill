<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;


class Contact {


	/**
	 * @var string |null
	 * @Assert\NotBlank()
	 * @Assert\Length(min=2, max=100)
	 */
	private $firstName;

	/**
	 * @var string |null
	 * @Assert\NotBlank()
	 * @Assert\Length(min=2, max=100)
	 */
	private $lastName;

	/**
	 * @var string |null
	 * @Assert\NotBlank()
	 * @Assert\Email()
	 */
	private $email;

	/**
	 * @var string |null
	 * @Assert\NotBlank()
	 * @Assert\Length(min=10)
	 */
	private $message;

	private $objet;


	private $gender;

	/**
	 * @return string|null
	 */
	public function getFirstName(): ?string {
		return $this->firstName;
	}

	/**
	 * @param string|null $firstName
	 *
	 * @return Contact
	 */
	public function setFirstName( ?string $firstName ): Contact {
		$this->firstName = $firstName;

		return $this;
	}

	/**
	 * @return string|null
	 */
	public function getLastName(): ?string {
		return $this->lastName;
	}

	/**
	 * @param string|null $lastName
	 *
	 * @return Contact
	 */
	public function setLastName( ?string $lastName ): Contact {
		$this->lastName = $lastName;

		return $this;
	}

	/**
	 * @return string|null
	 */
	public function getEmail(): ?string {
		return $this->email;
	}

	/**
	 * @param string|null $email
	 *
	 * @return Contact
	 */
	public function setEmail( ?string $email ): Contact {
		$this->email = $email;

		return $this;
	}

	/**
	 * @return string|null
	 */
	public function getMessage(): ?string {
		return $this->message;
	}

	/**
	 * @param string|null $message
	 *
	 * @return Contact
	 */
	public function setMessage( ?string $message ): Contact {
		$this->message = $message;

		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getObjet() {
		return $this->objet;
	}

	/**
	 * @param mixed $objet
	 *
	 * @return Contact
	 */
	public function setObjet( $objet ): Contact {
		$this->objet = $objet;

		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getGender() {
		return $this->gender;
	}

	/**
	 * @param mixed $gender
	 *
	 * @return Contact
	 */
	public function setGender( $gender ): Contact {
		$this->gender = $gender;

		return $this;
	}


}
