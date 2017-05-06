<?php

namespace GameBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * belongs
 *
 * @ORM\Table(name="belongs")
 * @ORM\Entity(repositoryClass="GameBundle\Repository\belongsRepository")
 */
class belongs
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
     * @var int
     *
     * @ORM\ManyToOne(targetEntity="GameBundle\Entity\characters")
     */
    private $character;

    /**
     * @var int
     *
     * @ORM\ManyToOne(targetEntity="GameBundle\Entity\objects")
     */
    private $object;


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
     * Set character
     *
     * @param integer $character
     *
     * @return belongs
     */
    public function setCharacter($character)
    {
        $this->character = $character;

        return $this;
    }

    /**
     * Get character
     *
     * @return int
     */
    public function getCharacter()
    {
        return $this->character;
    }

    /**
     * Set object
     *
     * @param integer $object
     *
     * @return belongs
     */
    public function setObject($object)
    {
        $this->object = $object;

        return $this;
    }

    /**
     * Get object
     *
     * @return int
     */
    public function getObject()
    {
        return $this->object;
    }
}

