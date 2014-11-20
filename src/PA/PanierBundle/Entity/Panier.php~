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
    private $pa_user;

    /**
     * @var \stdClass
     *
     * @ORM\ManyToMany(targetEntity="PA\AnnonceBundle\Entity\Annonce", cascade={"persist"})
     */
    private $pa_annonces;


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
        $this->pa_user = $paUser;

        return $this;
    }

    /**
     * Get paUser
     *
     * @return \stdClass 
     */
    public function getPaUser()
    {
        return $this->pa_user;
    }

    /**
     * Set paAnnonces
     *
     * @param \stdClass $paAnnonces
     * @return Panier
     */
    public function setPaAnnonces($paAnnonces)
    {
        $this->pa_annonces = $paAnnonces;

        return $this;
    }

    /**
     * Get paAnnonces
     *
     * @return \stdClass 
     */
    public function getPaAnnonces()
    {
        return $this->pa_annonces;
    }
}
