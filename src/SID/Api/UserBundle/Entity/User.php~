<?php

namespace SID\Api\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use SID\Api\UserBundle\Model\UserInterface;
use SID\Api\MovementBundle\Entity\Movimiento;
use SID\Api\DrugBundle\Entity\Responsable;
use SID\Api\UnityBundle\Entity\UsuarioUnidad;

/**
 * User
 *
 * @ORM\Table(name="users")
 * @ORM\Entity(repositoryClass="SID\Api\UserBundle\Repository\UserRepository")
 */
class User implements UserInterface{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=255, unique=true)
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, unique=true, nullable=true)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="salt", type="string", length=255)
     */
    private $salt;

    /**
     * @var string
     *
     * @ORM\Column(name="plain_password", type="string", length=255)
     */
    private $plainPassword;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="lastname", type="string", length=255)
     */
    private $lastname;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="sys_date", type="datetime")
     */
    private $sysDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="last_login", type="datetime", nullable=true)
     */
    private $lastLogin;

    /**
     * @var bool
     *
     * @ORM\Column(name="enabled", type="boolean", nullable=true)
     */
    private $enabled;

    /**
     * @var string
     *
     * @ORM\Column(name="confirmation_token", type="string", length=255, nullable=true)
     */
    private $confirmationToken;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="password_requested_at", type="datetimet", nullable=true)
     */
    private $passwordRequestedAt;

    /**
     * @var array
     *
     * @ORM\Column(name="roles", type="array", nullable=true)
     */
    private $roles;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="blob", nullable=true)
     */
    private $image;

    /**
     * @var string
     *
     * @ORM\Column(name="image_mime", type="string", length=255, nullable=true)
     */
    private $imageMime;

    /**
     * One Movement has Many Users.
     * @ORM\OneToMany(targetEntity="SID\Api\MovementBundle\Entity\Movimiento", mappedBy="usuario")
     */
    private $movimientos;

    /**
     * One Movement has Many Users.
     * @ORM\OneToMany(targetEntity="SID\Api\DrugBundle\Entity\Responsable", mappedBy="usuario")
     */
    private $droguerosResponsables;

    /**
     * One Product has Many Features.
     * @ORM\OneToMany(targetEntity="SID\Api\UnityBundle\Entity\UsuarioUnidad", mappedBy="usuario")
     */
    private $unidades;


    /*public function __construct(string $username){
        $this->username = $username;
        $this->enabled = true;
        $this->roles = array();
        $this->sysDate = new \DateTime();
    }*/

    public function eraseCredentials()
    {
        $this->plainPassword = "";
    }

    public function isAccountNonExpired()
    {
        // TODO: Implement isAccountNonExpired() method.
    }

    public function isAccountNonLocked()
    {
        // TODO: Implement isAccountNonLocked() method.
    }

    public function isCredentialsNonExpired()
    {
        // TODO: Implement isCredentialsNonExpired() method.
    }

    public function isEnabled()
    {
        // TODO: Implement isEnabled() method.
    }

    public function getEmail(): string
    {
        // TODO: Implement getEmail() method.
    }

    public function getPlainPassword(): string
    {
        // TODO: Implement getPlainPassword() method.
    }

    public function getRoles()
    {
        // TODO: Implement getRoles() method.
    }

    public function getPassword()
    {
        // TODO: Implement getPassword() method.
    }

    public function getSalt()
    {
        // TODO: Implement getSalt() method.
    }

    public function getUsername()
    {
        // TODO: Implement getUsername() method.
    }

    
}
