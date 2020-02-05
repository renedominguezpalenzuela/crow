<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
//use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @UniqueEntity(fields={"email","username"})
 */
class User implements UserInterface, \Serializable
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
	 * @Assert\NotBlank()
     */
    private $password;
	
	/**
     * @ORM\Column(type="string", length=150, nullable=true, unique=true)
     * @Assert\NotBlank()
     * @var type
     */
    private $username;
	
	 /**
     *
     * @var type 
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $security;

    /**
     *
     * @var type 
     * @ORM\Column(type="boolean")
     */
    private $active;




     /**
     * @ORM\Column(name="gold", type="integer")
     * @Assert\NotBlank()
     */
    private $gold = 500000;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Kingdom", inversedBy="users")
     * @ORM\JoinColumn(nullable=true)
     */
    private $kingdom;

    /**
     * @ORM\Column(type="integer")
     */
    private $userpoints=0;

	
	

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }
	
	
    public function getGold(): ?int
    {
        return $this->gold;
    }

    public function setGold(int $gold): self
    {
        $this->gold = $gold;

        return $this;
    }

    public function getKingdom(): ?Kingdom
    {
        return $this->kingdom;
    }

    public function setKingdom(?Kingdom $kingdom): self
    {
        $this->kingdom = $kingdom;

        return $this;
    }

    public function getUserpoints(): ?int
    {
        return $this->userpoints;
    }

    public function setUserpoints(int $userpoints): self
    {
        $this->userpoints = $userpoints;

        return $this;
    }



}
