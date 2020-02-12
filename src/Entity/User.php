<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User implements UserInterface
{


    public function __construct() 
    {
        $this->active = true;
       // $this->security = sha1(md5(uniqid()));
       // $this->role = 'ROLE_USER';
    }


    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    
    /**
     * @ORM\Column(type="string", length=180)
     * @Assert\NotBlank()
     */
    private $name;

    
    /**
     * @ORM\Column(type="string", length=180, unique=true)
     * @Assert\NotBlank()
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     * @Assert\NotBlank()
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    
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

    public function setUsername($username) {
        $this->username = $username;

        return $this;
    }

    public function getUsername() {
        return $this->username;
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

    /**
     * Get the value of active
     *
     * @return  type
     */ 
   /* public function getActive()
    {
        return $this->active;
    }*/

    /**
     * Set the value of active
     *
     * @param  type  $active
     *
     * @return  self
     */ 
    /*public function setActive(type $active)
    {
        $this->active = $active;

        return $this;
    }*/


    public function setActive(bool $active): ?self
    {
        $this->active = $active;
        
        return $this;
    }
    
    public function getActive(): ?bool 
    {
        return $this->active;
    }

    /**
     * Get the value of gold
     */ 
    public function getGold()
    {
        return $this->gold;
    }

    /**
     * Set the value of gold
     *
     * @return  self
     */ 
    public function setGold($gold)
    {
        $this->gold = $gold;

        return $this;
    }

    /**
     * Get the value of kingdom
     */ 
    public function getKingdom()
    {
        return $this->kingdom;
    }

    /**
     * Set the value of kingdom
     *
     * @return  self
     */ 
    public function setKingdom($kingdom)
    {
        $this->kingdom = $kingdom;

        return $this;
    }

    /**
     * Get the value of userpoints
     */ 
    public function getUserpoints()
    {
        return $this->userpoints;
    }

    /**
     * Set the value of userpoints
     *
     * @return  self
     */ 
    public function setUserpoints($userpoints)
    {
        $this->userpoints = $userpoints;

        return $this;
    }

    /**
     * Get the value of name
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }
}
