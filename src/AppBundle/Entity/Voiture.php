<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model\Sluggable\Sluggable;

/**
 * Voiture
 *
 * @ORM\Table(name="voiture")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\VoitureRepository")
 */
class Voiture {

    use Sluggable;

    public function getSluggableFields() {
        return ['name'];
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
     * @ORM\Column(name="name", type="string", length=100, unique=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=150, unique=true)
     */
    private $image;

    /**
     * 
     * @ORM\ManyToOne(targetEntity="Marque")
     * @ORM\JoinColumn(name="marque_id", referencedColumnName="id")
     */
    private $marque;

    
    
    /**
     * Many Voitures have Many PieceDetaches.
     * @ORM\ManyToMany(targetEntity="PieceDetache", inversedBy="voitures")
     * @ORM\JoinTable(name="voitures_piece_detaches")
     */
    private $pieceDetaches;
    
    
    /**
     * Get id
     *
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Voiture
     */
    public function setName($name) {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName() {
        return $this->name;
    }

    /**
     * Set image
     *
     * @param string $image
     *
     * @return Voiture
     */
    public function setImage($image) {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImage() {
        return $this->image;
    }

    /**
     * Set marque
     *
     * @param \AppBundle\Entity\Marque $marque
     *
     * @return Voiture
     */
    public function setMarque(\AppBundle\Entity\Marque $marque = null) {
        $this->marque = $marque;

        return $this;
    }

    /**
     * Get marque
     *
     * @return \AppBundle\Entity\Marque
     */
    public function getMarque() {
        return $this->marque;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->pieceDetaches = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add pieceDetach
     *
     * @param \AppBundle\Entity\PieceDetache $pieceDetach
     *
     * @return Voiture
     */
    public function addPieceDetach(\AppBundle\Entity\PieceDetache $pieceDetach)
    {
        $this->pieceDetaches[] = $pieceDetach;

        dump($this->pieceDetaches); die();

        return $this;
    }

    /**
     * Remove pieceDetach
     *
     * @param \AppBundle\Entity\PieceDetache $pieceDetach
     */
    public function removePieceDetach(\AppBundle\Entity\PieceDetache $pieceDetach)
    {
        $this->pieceDetaches->removeElement($pieceDetach);
    }

    /**
     * Get pieceDetaches
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPieceDetaches()
    {
        return $this->pieceDetaches;
    }
}
