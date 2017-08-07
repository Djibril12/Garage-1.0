<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model\Translatable\Translatable;
/**
 * CategoriePieceDetache
 *
 * @ORM\Table(name="categorie_piece_detache")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CategoriePieceDetacheRepository")
 */
class CategoriePieceDetache
{
    
    use Translatable;
    
    
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var bool
     *
     * @ORM\Column(name="estActive", type="boolean")
     */
    private $estActive;


    
    /**
     * One CategoriePieceDetache has Many PieceDetaches.
     * @ORM\OneToMany(targetEntity="PieceDetache", mappedBy="categoriePieceDetache")
     */
    private $pieceDetaches;
    
    
    
    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set estActive
     *
     * @param boolean $estActive
     *
     * @return CategoriePieceDetache
     */
    public function setEstActive($estActive)
    {
        $this->estActive = $estActive;

        return $this;
    }

    /**
     * Get estActive
     *
     * @return bool
     */
    public function getEstActive()
    {
        return $this->estActive;
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
     * @return CategoriePieceDetache
     */
    public function addPieceDetach(\AppBundle\Entity\PieceDetache $pieceDetach)
    {
        $this->pieceDetaches[] = $pieceDetach;

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
