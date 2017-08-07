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
}
