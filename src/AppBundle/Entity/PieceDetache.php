<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model\Translatable\Translatable;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * PieceDetache
 *
 * @ORM\Table(name="piece_detache")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PieceDetacheRepository")
 */
class PieceDetache {

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
     * @var string
     *
     * @ORM\Column(name="prix", type="decimal", precision=6, scale=2)
     */
    private $prix;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=150, unique=true)
     */
    private $image;
    
    
    
    /**
     * Many PieceDetaches have Many Voitures.
     * @ORM\ManyToMany(targetEntity="Voiture", mappedBy="pieceDetaches")
     */
    private $voitures;
    
    /**
     * Constructor
     */
    
    
     /**
     * 
     * @ORM\ManyToOne(targetEntity="CategoriePieceDetache")
     * @ORM\JoinColumn(name="categoriePieceDetache_id", referencedColumnName="id")
     */
    private $categoriePieceDetache;
    
    
    
    public function __construct()
    {
        $this->voitures = new ArrayCollection();
    }
  
    /**
     * Get id
     *
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set prix
     *
     * @param string $prix
     *
     * @return PieceDetache
     */
    public function setPrix($prix) {
        $this->prix = $prix;

        return $this;
    }

    /**
     * Get prix
     *
     * @return string
     */
    public function getPrix() {
        return $this->prix;
    }

    /**
     * Set image
     *
     * @param string $image
     *
     * @return PieceDetache
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
     * Add voiture
     *
     * @param \AppBundle\Entity\Voiture $voiture
     *
     * @return PieceDetache
     */
    public function addVoiture(\AppBundle\Entity\Voiture $voiture)
    {
        $this->voitures[] = $voiture;

        return $this;
    }

    /**
     * Remove voiture
     *
     * @param \AppBundle\Entity\Voiture $voiture
     */
    public function removeVoiture(\AppBundle\Entity\Voiture $voiture)
    {
        $this->voitures->removeElement($voiture);
    }

    /**
     * Get voitures
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getVoitures()
    {
        return $this->voitures;
    }


    

    /**
     * Set categoriePieceDetache
     *
     * @param \AppBundle\Entity\CategoriePieceDetache $categoriePieceDetache
     *
     * @return PieceDetache
     */
    public function setCategoriePieceDetache(\AppBundle\Entity\CategoriePieceDetache $categoriePieceDetache = null)
    {
        $this->categoriePieceDetache = $categoriePieceDetache;

        return $this;
    }

    /**
     * Get categoriePieceDetache
     *
     * @return \AppBundle\Entity\CategoriePieceDetache
     */
    public function getCategoriePieceDetache()
    {
        return $this->categoriePieceDetache;
    }
}
