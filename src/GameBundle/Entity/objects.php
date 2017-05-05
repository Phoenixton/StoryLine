<?php

namespace GameBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * objects
 *
 * @ORM\Table(name="objects")
 * @ORM\Entity(repositoryClass="GameBundle\Repository\objectsRepository")
 */
class objects
{
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var int
     *
     * @ORM\Column(name="attackbonus", type="integer")
     */
    private $attackBonus;

    /**
     * @var int
     *
     * @ORM\Column(name="lifebonus", type="integer")
     */
    private $lifeBonus;


    /**
     * @var int
     *
     * @ORM\Column(name="defensebonus", type="integer")
     */
    private $defenseBonus;


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
     * Set name
     *
     * @param string $name
     *
     * @return objects
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return objects
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set attackBonus
     *
     * @param integer $attackBonus
     *
     * @return objects
     */
    public function setAttackBonus($attackBonus)
    {
        $this->attackBonus = $attackBonus;

        return $this;
    }

    /**
     * Get attackBonus
     *
     * @return int
     */
    public function getAttackBonus()
    {
        return $this->attackBonus;
    }

    /**
     * Set lifeBonus
     *
     * @param integer $lifeBonus
     *
     * @return objects
     */
    public function setLifeBonus($lifeBonus)
    {
        $this->lifeBonus = $lifeBonus;

        return $this;
    }

    /**
     * Get lifeBonus
     *
     * @return int
     */
    public function getLifeBonus()
    {
        return $this->lifeBonus;
    }

    /**
     * Set defenseBonus
     *
     * @param integer $defenseBonus
     *
     * @return objects
     */
    public function setDefenseBonus($defenseBonus)
    {
        $this->defenseBonus = $defenseBonus;

        return $this;
    }

    /**
     * Get defenseBonus
     *
     * @return int
     */
    public function getDefenseBonus()
    {
        return $this->defenseBonus;
    }
}

