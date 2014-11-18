<?php

namespace PA\AnnonceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Annonce
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="PA\AnnonceBundle\Entity\AnnonceRepository")
 */
class Annonce
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $an_id;

    /**
     * @var string
     *
     * @ORM\Column(name="an_titre", type="string", length=80)
     */
    private $an_titre;

    /**
     * @var string
     *
     * @ORM\Column(name="an_description", type="text")
     */
    private $an_description;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="an_date_publication", type="datetime")
     */
    private $an_datePublication;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="an_date_supression", type="datetime")
     */
    private $an_dateSupression;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="an_date_acquisition", type="datetime")
     */
    private $an_dateAcquisition;

    /**
     * @var boolean
     *
     * @ORM\Column(name="an_publie", type="boolean")
     */
    private $an_publie;

    /**
     * @var string
     *
     * @ORM\Column(name="an_image", type="string", length=255)
     */
    private $an_image;

    /**
     * @var \stdClass
     *
     * @ORM\Column(name="an_categorie", type="object")
     */
    private $an_categorie;

    /**
     * @var \stdClass
     *
     * @ORM\Column(name="an_user", type="object")
     */
    private $an_user;

    /**
     * @var integer
     *
     * @ORM\Column(name="an_prix", type="integer")
     */
    private $an_prix;

    /**
     * @var boolean
     *
     * @ORM\Column(name="an_type", type="boolean")
     */
    private $an_type;

    /**
     * @var array
     *
     * @ORM\Column(name="an_departement", type="array")
     */
    private $an_departement;

    /**
     * @var array
     *
     * @ORM\Column(name="an_secteur", type="array")
     */
    private $an_secteur;

    /**
     * @var string
     *
     * @ORM\Column(name="an_cp", type="string", length=5)
     */
    

    /**
     * Get an_id
     *
     * @return integer 
     */
    public function getAnId()
    {
        return $this->an_id;
    }

    /**
     * Set an_titre
     *
     * @param string $anTitre
     * @return Annonce
     */
    public function setAnTitre($anTitre)
    {
        $this->an_titre = $anTitre;

        return $this;
    }

    /**
     * Get an_titre
     *
     * @return string 
     */
    public function getAnTitre()
    {
        return $this->an_titre;
    }

    /**
     * Set an_description
     *
     * @param string $anDescription
     * @return Annonce
     */
    public function setAnDescription($anDescription)
    {
        $this->an_description = $anDescription;

        return $this;
    }

    /**
     * Get an_description
     *
     * @return string 
     */
    public function getAnDescription()
    {
        return $this->an_description;
    }

    /**
     * Set an_datePublication
     *
     * @param \DateTime $anDatePublication
     * @return Annonce
     */
    public function setAnDatePublication($anDatePublication)
    {
        $this->an_datePublication = $anDatePublication;

        return $this;
    }

    /**
     * Get an_datePublication
     *
     * @return \DateTime 
     */
    public function getAnDatePublication()
    {
        return $this->an_datePublication;
    }

    /**
     * Set an_dateSupression
     *
     * @param \DateTime $anDateSupression
     * @return Annonce
     */
    public function setAnDateSupression($anDateSupression)
    {
        $this->an_dateSupression = $anDateSupression;

        return $this;
    }

    /**
     * Get an_dateSupression
     *
     * @return \DateTime 
     */
    public function getAnDateSupression()
    {
        return $this->an_dateSupression;
    }

    /**
     * Set an_dateAcquisition
     *
     * @param \DateTime $anDateAcquisition
     * @return Annonce
     */
    public function setAnDateAcquisition($anDateAcquisition)
    {
        $this->an_dateAcquisition = $anDateAcquisition;

        return $this;
    }

    /**
     * Get an_dateAcquisition
     *
     * @return \DateTime 
     */
    public function getAnDateAcquisition()
    {
        return $this->an_dateAcquisition;
    }

    /**
     * Set an_publie
     *
     * @param boolean $anPublie
     * @return Annonce
     */
    public function setAnPublie($anPublie)
    {
        $this->an_publie = $anPublie;

        return $this;
    }

    /**
     * Get an_publie
     *
     * @return boolean 
     */
    public function getAnPublie()
    {
        return $this->an_publie;
    }

    /**
     * Set an_image
     *
     * @param string $anImage
     * @return Annonce
     */
    public function setAnImage($anImage)
    {
        $this->an_image = $anImage;

        return $this;
    }

    /**
     * Get an_image
     *
     * @return string 
     */
    public function getAnImage()
    {
        return $this->an_image;
    }

    /**
     * Set an_categorie
     *
     * @param \stdClass $anCategorie
     * @return Annonce
     */
    public function setAnCategorie($anCategorie)
    {
        $this->an_categorie = $anCategorie;

        return $this;
    }

    /**
     * Get an_categorie
     *
     * @return \stdClass 
     */
    public function getAnCategorie()
    {
        return $this->an_categorie;
    }

    /**
     * Set an_user
     *
     * @param \stdClass $anUser
     * @return Annonce
     */
    public function setAnUser($anUser)
    {
        $this->an_user = $anUser;

        return $this;
    }

    /**
     * Get an_user
     *
     * @return \stdClass 
     */
    public function getAnUser()
    {
        return $this->an_user;
    }

    /**
     * Set an_prix
     *
     * @param integer $anPrix
     * @return Annonce
     */
    public function setAnPrix($anPrix)
    {
        $this->an_prix = $anPrix;

        return $this;
    }

    /**
     * Get an_prix
     *
     * @return integer 
     */
    public function getAnPrix()
    {
        return $this->an_prix;
    }

    /**
     * Set an_type
     *
     * @param boolean $anType
     * @return Annonce
     */
    public function setAnType($anType)
    {
        $this->an_type = $anType;

        return $this;
    }

    /**
     * Get an_type
     *
     * @return boolean 
     */
    public function getAnType()
    {
        return $this->an_type;
    }

    /**
     * Set an_departement
     *
     * @param array $anDepartement
     * @return Annonce
     */
    public function setAnDepartement($anDepartement)
    {
        $this->an_departement = $anDepartement;

        return $this;
    }

    /**
     * Get an_departement
     *
     * @return array 
     */
    public function getAnDepartement()
    {
        return $this->an_departement;
    }

    /**
     * Set an_secteur
     *
     * @param string $anSecteur
     * @return Annonce
     */
    public function setAnSecteur($anSecteur)
    {
        $this->an_secteur = $anSecteur;

        return $this;
    }

    /**
     * Get an_secteur
     *
     * @return string 
     */
    public function getAnSecteur()
    {
        return $this->an_secteur;
    }
}
