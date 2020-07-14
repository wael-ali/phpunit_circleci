<?php


namespace AppBundle\Entity;


use AppBundle\Exception\DinosaursAreRunningRampantException;
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
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Dinosaur", mappedBy="enclosure", cascade={"persist"})
     */
    private $dinosaurs;
    /**
     * @var ArrayCollection|Security[]
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Security", mappedBy="enclosure", cascade={"persist"})
     */
    private $securities;

    public function __construct(bool $basicSecurity = false)
    {
        $this->dinosaurs = new ArrayCollection();
        $this->securities = new ArrayCollection();
        if ($basicSecurity){
            $this->addSecurity(new Security('Fence', true, $this));
        }
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
        if (!$this->isSecutrityActive()){
            throw new DinosaursAreRunningRampantException('Are you craaaazy?!?');
        }
        $this->dinosaurs[] = $dinosaur;
        $dinosaur->setEnclosure($this);
    }

    public function isSecutrityActive(): bool
    {
        foreach ($this->securities as $security){
            if ($security->getIsActive()){
                return true;
            }
        }

        return false;
    }

    public function addSecurity(Security $security)
    {
        $this->securities[] = $security;
    }

    private function canAddDinosaur(Dinosaur $dinosaur): bool
    {
        return
            count($this->dinosaurs) == 0
            ||
            $this->dinosaurs->first()->isCarnivorous() == $dinosaur->isCarnivorous()
        ;
    }

    public function getSecurities(): ArrayCollection
    {
        return $this->securities;
    }

}