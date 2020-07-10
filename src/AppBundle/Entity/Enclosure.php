<?php


namespace AppBundle\Entity;


use AppBundle\Exception\NotAbuffetException;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="enclosure")
 */
class Enclosure
{
    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Dinosaur", mappedBy="enclosure", cascade={"presist"})
     */
    private $dinosaurs;

    public function __construct()
    {
        $this->dinosaurs = new ArrayCollection();
    }

    /**
     * @return ArrayCollection
     */
    public function getDinosaurs(): ArrayCollection
    {
        return $this->dinosaurs;
    }

    public function addDinosaur(Dinosaur $dinosaur)
    {
        if (!$this->canAddDinosaur($dinosaur)){
            throw new NotAbuffetException();
        }
        $this->dinosaurs[] = $dinosaur;
    }

    private function canAddDinosaur(Dinosaur $dinosaur): bool
    {
        return
            count($this->dinosaurs) == 0
            ||
            $this->dinosaurs->first()->isCarnivorous() == $dinosaur->isCarnivorous()
        ;
    }

}