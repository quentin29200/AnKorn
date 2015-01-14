<?php

namespace PA\UserBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use PA\PanierBundle\Entity\Panier as Panier;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;


    /**
     * @var string
     *
     * @ORM\Column(name="us_civilite", type="string", length=3)
     */
    private $us_civilite;

    /**
     * @var string
     *
     * @ORM\Column(name="us_nom", type="string", length=38)
     */
    private $us_nom;

    /**
     * @var string
     *
     * @ORM\Column(name="us_prenom", type="string", length=38)
     */
    private $us_prenom;

    /**
     * @var string
     *
     * @ORM\Column(name="us_tel", type="string", length=10)
     */
    private $us_tel;


    /**
     * @ORM\OneToOne(targetEntity="PA\PanierBundle\Entity\Panier", cascade={"persist"})
     */
    private $us_panier;


    public function __construct()
    {
        parent::__construct();
        $this->roles = array("ROLE_USER");
        $this->us_panier = new Panier();
        $pauser = $this->us_panier->setPaUser($this);
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
     * Set us_civilite
     *
     * @param boolean $usCivilite
     * @return User
     */
    public function setUsCivilite($usCivilite)
    {
        $this->us_civilite = $usCivilite;

        return $this;
    }

    /**
     * Get us_civilite
     *
     * @return boolean 
     */
    public function getUsCivilite()
    {
        return $this->us_civilite;
    }

    /**
     * Set us_nom
     *
     * @param string $usNom
     * @return User
     */
    public function setUsNom($usNom)
    {
        $this->us_nom = $usNom;

        return $this;
    }

    /**
     * Get us_nom
     *
     * @return string 
     */
    public function getUsNom()
    {
        return $this->us_nom;
    }

    /**
     * Set us_prenom
     *
     * @param string $usPrenom
     * @return User
     */
    public function setUsPrenom($usPrenom)
    {
        $this->us_prenom = $usPrenom;

        return $this;
    }

    /**
     * Get us_prenom
     *
     * @return string 
     */
    public function getUsPrenom()
    {
        return $this->us_prenom;
    }

    /**
     * Set us_tel
     *
     * @param string $usTel
     * @return User
     */
    public function setUsTel($usTel)
    {
        $this->us_tel = $usTel;

        return $this;
    }

    /**
     * Get us_tel
     *
     * @return string 
     */
    public function getUsTel()
    {
        return $this->us_tel;
    }

    /**
     * Set us_panier
     *
     * @param \PA\PanierBundle\Entity\Panier $usPanier
     * @return User
     */
    public function setUsPanier(\PA\PanierBundle\Entity\Panier $usPanier = null)
    {
        $this->us_panier = $usPanier;

        return $this;
    }

    /**
     * Get us_panier
     *
     * @return \PA\PanierBundle\Entity\Panier 
     */
    public function getUsPanier()
    {
        return $this->us_panier;
    }
}
