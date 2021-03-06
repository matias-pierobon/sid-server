<?php

namespace SID\Api\UserBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use SID\Api\DrugBundle\Entity\Acceso;
use SID\Api\UnityBundle\Entity\UnidadEjecutora;
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
     * @ORM\Column(name="password_requested_at", type="datetime", nullable=true)
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
     * @ORM\OneToMany(targetEntity="SID\Api\MovementBundle\Entity\MovimientoFisico", mappedBy="usuario")
     */
    private $extracciones;

    /**
     * One Movement has Many Users.
     * @ORM\OneToMany(targetEntity="SID\Api\DrugBundle\Entity\Responsable", mappedBy="user")
     */
    private $droguerosResponsables;

    /**
     * One Movement has Many Users.
     * @ORM\OneToMany(targetEntity="SID\Api\DrugBundle\Entity\Acceso", mappedBy="user")
     */
    private $misDrogueros;

    /**
     * One Product has Many Features.
     * @ORM\OneToMany(targetEntity="SID\Api\UnityBundle\Entity\UsuarioUnidad", mappedBy="usuario", cascade={"persist"})
     */
    private $unidades;


    /*public function __construct(string $username){
        $this->username = $username;
        $this->enabled = true;
        $this->roles = array();
        $this->sysDate = new \DateTime();
    }*/

    /**
     * @param UnidadEjecutora $unidad
     * @return bool
     */
    public function hasUnidad(UnidadEjecutora $unidad){
        return $this->unidades->exists(function ($key, UsuarioUnidad $usuarioUnidad) use ($unidad){
            return ($usuarioUnidad->getUnidad()->getId() == $unidad->getId() and $usuarioUnidad->getHasta() == null);
        });
    }

    public function setImageBlob($file)
    {
        if (!$file){
            $this->setImage(null);
            $this->setImageMime(null);
            return $this;
        }
        if(!$file->isValid()){
            throw new FileException("Invalid File");
        }
        $imageFile    = fopen($file->getRealPath(), 'r');
        $imageContent = fread($imageFile, $file->getClientSize());
        fclose($imageFile);
        $this->setImage($imageContent);
        $this->setImageMime($file->getMimeType());
        return $this;
    }

    public function getActiveUnities(){
        $unidades = new ArrayCollection();
        foreach ($this->getUnidades() as $unidad){
            if($unidad->getHasta() == null){
                $unidades->add($unidad);
            }
        }
        return $unidades;
    }

    public function hasUnity(UnidadEjecutora $unidadEjecutora){
        return $this->getActiveUnities()->exists(function ($key, $trabajo) use($unidadEjecutora){
            return $trabajo->getUnidad()->getId() == $unidadEjecutora->getId();
        });
    }

    public function isAdmin(){
        return in_array('ROLE_ADMIN', $this->roles);
    }

    public function eraseCredentials()
    {
        $this->plainPassword = "";
    }

    public function isAccountNonExpired()
    {
        return true;
    }

    public function isAccountNonLocked()
    {
        return true;
    }

    public function isCredentialsNonExpired()
    {
        return true;
    }

    public function isEnabled()
    {
        return $this->getEnabled();
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    public function getRoles()
    {
        $roles = $this->roles;
        $roles[] = 'ROLE_USER';
        return array_unique($roles);
    }

    public function hasRole($role)
    {
        return in_array(strtoupper($role), $this->getRoles(), true);
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getSalt()
    {
        return $this->salt;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function __toString()
    {
        return $this->getLastname() . ', ' . $this->getName();
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->enabled = true;
        $this->roles = array('ROLE_USER');
        $this->sysDate = new \DateTime();
        $this->movimientos = new ArrayCollection();
        $this->droguerosResponsables = new ArrayCollection();
        $this->unidades = new ArrayCollection();
        $this->extracciones = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set username
     *
     * @param string $username
     *
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Set salt
     *
     * @param string $salt
     *
     * @return User
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;

        return $this;
    }

    /**
     * Set plainPassword
     *
     * @param string $plainPassword
     *
     * @return User
     */
    public function setPlainPassword($plainPassword)
    {
        $this->plainPassword = $plainPassword;

        return $this;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return User
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set lastname
     *
     * @param string $lastname
     *
     * @return User
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get lastname
     *
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set sysDate
     *
     * @param \DateTime $sysDate
     *
     * @return User
     */
    public function setSysDate($sysDate)
    {
        $this->sysDate = $sysDate;

        return $this;
    }

    /**
     * Get sysDate
     *
     * @return \DateTime
     */
    public function getSysDate()
    {
        return $this->sysDate;
    }

    /**
     * Set lastLogin
     *
     * @param \DateTime $lastLogin
     *
     * @return User
     */
    public function setLastLogin($lastLogin)
    {
        $this->lastLogin = $lastLogin;

        return $this;
    }

    /**
     * Get lastLogin
     *
     * @return \DateTime
     */
    public function getLastLogin()
    {
        return $this->lastLogin;
    }

    /**
     * Set enabled
     *
     * @param boolean $enabled
     *
     * @return User
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;

        return $this;
    }

    /**
     * Get enabled
     *
     * @return boolean
     */
    public function getEnabled()
    {
        return $this->enabled;
    }

    /**
     * Set confirmationToken
     *
     * @param string $confirmationToken
     *
     * @return User
     */
    public function setConfirmationToken($confirmationToken)
    {
        $this->confirmationToken = $confirmationToken;

        return $this;
    }

    /**
     * Get confirmationToken
     *
     * @return string
     */
    public function getConfirmationToken()
    {
        return $this->confirmationToken;
    }

    /**
     * Set passwordRequestedAt
     *
     * @param \datetime $passwordRequestedAt
     *
     * @return User
     */
    public function setPasswordRequestedAt(\datetime $passwordRequestedAt)
    {
        $this->passwordRequestedAt = $passwordRequestedAt;

        return $this;
    }

    /**
     * Get passwordRequestedAt
     *
     * @return \datetime
     */
    public function getPasswordRequestedAt()
    {
        return $this->passwordRequestedAt;
    }

    /**
     * Set roles
     *
     * @param array $roles
     *
     * @return User
     */
    public function setRoles($roles)
    {
        $this->roles = array();
        foreach ($roles as $role) {
            $this->addRole($role);
        }
        return $this;
    }

    public function addRole($role)
    {
        $role = strtoupper($role);
        if ($role === 'ROLE_USER') {
            return $this;
        }
        if (!in_array($role, $this->roles, true)) {
            $this->roles[] = $role;
        }
        return $this;
    }

    /**
     * Set image
     *
     * @param string $image
     *
     * @return User
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set imageMime
     *
     * @param string $imageMime
     *
     * @return User
     */
    public function setImageMime($imageMime)
    {
        $this->imageMime = $imageMime;

        return $this;
    }

    /**
     * Get imageMime
     *
     * @return string
     */
    public function getImageMime()
    {
        return $this->imageMime;
    }

    /**
     * Add movimiento
     *
     * @param \SID\Api\MovementBundle\Entity\Movimiento $movimiento
     *
     * @return User
     */
    public function addMovimiento(Movimiento $movimiento)
    {
        $this->movimientos[] = $movimiento;

        return $this;
    }

    /**
     * Remove movimiento
     *
     * @param \SID\Api\MovementBundle\Entity\Movimiento $movimiento
     */
    public function removeMovimiento(Movimiento $movimiento)
    {
        $this->movimientos->removeElement($movimiento);
    }

    /**
     * Get movimientos
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMovimientos()
    {
        return $this->movimientos;
    }

    /**
     * Add droguerosResponsable
     *
     * @param \SID\Api\DrugBundle\Entity\Responsable $droguerosResponsable
     *
     * @return User
     */
    public function addDroguerosResponsable(Responsable $droguerosResponsable)
    {
        $this->droguerosResponsables[] = $droguerosResponsable;

        return $this;
    }

    /**
     * Remove droguerosResponsable
     *
     * @param \SID\Api\DrugBundle\Entity\Responsable $droguerosResponsable
     */
    public function removeDroguerosResponsable(Responsable $droguerosResponsable)
    {
        $this->droguerosResponsables->removeElement($droguerosResponsable);
    }

    /**
     * Get droguerosResponsables
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDroguerosResponsables()
    {
        return $this->droguerosResponsables;
    }

    /**
     * Add misDrogueros
     *
     * @param \SID\Api\DrugBundle\Entity\Acceso $droguero
     *
     * @return User
     */
    public function addAccesoDroguero(Acceso $droguero)
    {
        $this->misDrogueros->add($droguero);

        return $this;
    }

    /**
     * Get misDrogueros
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMisDrogueros()
    {
        return $this->misDrogueros;
    }

    /**
     * Add unidad
     *
     * @param \SID\Api\UnityBundle\Entity\UnidadEjecutora $unidad
     *
     * @return User
     */
    public function addUnidad(UnidadEjecutora $unidad)
    {
        if(! $this->getUnidades()->exists(function ($index, UsuarioUnidad $userUnidad) use ($unidad){
            return $unidad->getId() == $userUnidad->getUnidad()->getId() && $userUnidad->getHasta() == null;
        }))
            $this->unidades->add(new UsuarioUnidad($this, $unidad));

        return $this;
    }

    /**
     * Remove unidad
     *
     * @param \SID\Api\UnityBundle\Entity\UsuarioUnidad $unidade
     */
    public function removeUnidad(UsuarioUnidad $unidad)
    {
        $this->unidades->removeElement($unidad);
    }

    /**
     * Get unidades
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUnidades()
    {
        return $this->unidades;
    }

    /**
     * Add extraccione
     *
     * @param \SID\Api\MovementBundle\Entity\MovimientoFisico $extraccion
     *
     * @return User
     */
    public function addExtraccion(\SID\Api\MovementBundle\Entity\MovimientoFisico $extraccion)
    {
        $this->extracciones[] = $extraccion;

        return $this;
    }

    /**
     * Remove extraccione
     *
     * @param \SID\Api\MovementBundle\Entity\MovimientoFisico $extraccion
     */
    public function removeExtraccione(\SID\Api\MovementBundle\Entity\MovimientoFisico $extraccion)
    {
        $this->extracciones->removeElement($extraccion);
    }

    /**
     * Get extracciones
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getExtracciones()
    {
        return $this->extracciones;
    }

    /**
     * Add misDroguero
     *
     * @param \SID\Api\DrugBundle\Entity\Acceso $misDroguero
     *
     * @return User
     */
    public function addMisDroguero(\SID\Api\DrugBundle\Entity\Acceso $misDroguero)
    {
        $this->misDrogueros[] = $misDroguero;

        return $this;
    }

    /**
     * Remove misDroguero
     *
     * @param \SID\Api\DrugBundle\Entity\Acceso $misDroguero
     */
    public function removeMisDroguero(\SID\Api\DrugBundle\Entity\Acceso $misDroguero)
    {
        $this->misDrogueros->removeElement($misDroguero);
    }
}
