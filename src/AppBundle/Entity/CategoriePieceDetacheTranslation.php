<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model\Sluggable\Sluggable;
use Knp\DoctrineBehaviors\Model\Translatable\Translation;

/**
 * CategoriePieceDetache
 *
 * @ORM\Table(name="categorie_piece_detache_translation")
 * @ORM\Entity()
 */
class CategoriePieceDetacheTranslation {

    use Sluggable,
        Translation;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=150, unique=true)
     */
    private $nom;

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return CategoriePieceDetacheTranslation
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

    public function getSluggableFields() {

        return ['nom'];
    }

}
