<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model\Sluggable\Sluggable;

/**
 * Marque
 *
 * @ORM\Table(name="marque")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\MarqueRepository")
 */
class Marque {

    use Sluggable;

    public function getSluggableFields() {
        return ['nom'];
    }

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
     * @ORM\Column(name="nom", type="string", length=100, unique=true)
     */
    private $nom;

    /**
     * One Brand has Many Cars.
     * @ORM\OneToMany(targetEntity="Voiture", mappedBy="marque")
     */
    private $voitures;

    /**
     * Get id
     *
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return Marque
     */
    public function setNom($nom) {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom() {
        return $this->nom;
    }

    /**
     * Constructor
     */
    public function __construct() {
        $this->voitures = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add voiture
     *
     * @param \AppBundle\Entity\Voiture $voiture
     *
     * @return Marque
     */
    public function addVoiture(\AppBundle\Entity\Voiture $voiture) {
        $this->voitures[] = $voiture;

        return $this;
    }

    /**
     * Remove voiture
     *
     * @param \AppBundle\Entity\Voiture $voiture
     */
    public function removeVoiture(\AppBundle\Entity\Voiture $voiture) {
        $this->voitures->removeElement($voiture);
    }

    /**
     * Get voitures
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getVoitures() {
        return $this->voitures;
    }

}
