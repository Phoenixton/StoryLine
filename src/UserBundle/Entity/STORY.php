<?php

namespace UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * STORY
 *
 * @ORM\Table(name="s_t_o_r_y")
 * @ORM\Entity(repositoryClass="UserBundle\Repository\STORYRepository")
 */
class STORY
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
     * @ORM\Column(name="charac", type="integer")
     */
    private $charac;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var int
     *
     * @ORM\Column(name="stamina", type="integer")
     */
    private $stamina;

    /**
     * @var int
     *
     * @ORM\Column(name="reward", type="integer")
     */
    private $reward;

    /**
     * @var array
     *
     * @ORM\Column(name="rooms", type="array")
     */
    private $rooms;


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
     * Set charac
     *
     * @param integer $charac
     *
     * @return STORY
     */
    public function setCharac($charac)
    {
        $this->charac = $charac;

        return $this;
    }

    /**
     * Get charac
     *
     * @return int
     */
    public function getCharac()
    {
        return $this->charac;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return STORY
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
     * Set stamina
     *
     * @param integer $stamina
     *
     * @return STORY
     */
    public function setStamina($stamina)
    {
        $this->stamina = $stamina;

        return $this;
    }

    /**
     * Get stamina
     *
     * @return int
     */
    public function getStamina()
    {
        return $this->stamina;
    }

    /**
     * Set reward
     *
     * @param integer $reward
     *
     * @return STORY
     */
    public function setReward($reward)
    {
        $this->reward = $reward;

        return $this;
    }

    /**
     * Get reward
     *
     * @return int
     */
    public function getReward()
    {
        return $this->reward;
    }

    /**
     * Set rooms
     *
     * @param array $rooms
     *
     * @return STORY
     */
    public function setRooms($rooms)
    {
        $this->rooms = $rooms;

        return $this;
    }

    /**
     * Get rooms
     *
     * @return array
     */
    public function getRooms()
    {
        return $this->rooms;
    }
}

