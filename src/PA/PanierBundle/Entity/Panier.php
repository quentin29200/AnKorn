<?php

namespace PA\PanierBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Panier
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="PA\PanierBundle\Entity\PanierRepository")
 *
 */

class Panier
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $pa_id;

    /**
     * @var \stdClass
     *
     * @ORM\OneToOne(targetEntity="PA\UserBundle\Entity\User", cascade={"persist"})
     */
    private $pauser;

    /**
     * @var \stdClass
     *
     * @ORM\ManyToMany(targetEntity="PA\AnnonceBundle\Entity\Annonce", cascade={"persist"})
     */
    private $paannonces;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getPaId()
    {
        return $this->pa_id;
    }

    /**
     * Set paUser
     *
     * @param \stdClass $paUser
     * @return Panier
     */
    public function setPaUser($paUser)
    {
        $this->pauser = $paUser;

        return $this;
    }

    /**
     * Get paUser
     *
     * @return \stdClass 
     */
    public function getPaUser()
    {
        return $this->paUser;
    }

    /**
     * Set paAnnonces
     *
     * @param \stdClass $paAnnonces
     * @return Panier
     */
    public function setPaAnnonces($paAnnonces)
    {
        $this->paannonces = $paAnnonces;

        return $this;
    }

    /**
     * Get paAnnonces
     *
     * @return \stdClass 
     */
    public function getPaAnnonces()
    {
        return $this->paannonces;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->paannonces = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add paannonces
     *
     * @param \PA\AnnonceBundle\Entity\Annonce $paAnnonce
     * @return Panier
     */
    public function addPaAnnonce(\PA\AnnonceBundle\Entity\Annonce $paAnnonce)
    {
        $this->paannonces[] = $paAnnonce;

        return $this;
    }

    /**
     * Remove paannonces
     *
     * @param \PA\AnnonceBundle\Entity\Annonce $paAnnonce
     */
    public function removePaAnnonce(\PA\AnnonceBundle\Entity\Annonce $paAnnonce)
    {
        $this->paannonces->removeElement($paAnnonce);
    }
}
