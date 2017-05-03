<?php

namespace UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ROOM
 *
 * @ORM\Table(name="r_o_o_m")
 * @ORM\Entity(repositoryClass="UserBundle\Repository\ROOMRepository")
 */
class ROOM
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
     * @ORM\Column(name="enemy", type="integer")
     */
    private $enemy;


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
     * Set enemy
     *
     * @param integer $enemy
     *
     * @return ROOM
     */
    public function setEnemy($enemy)
    {
        $this->enemy = $enemy;

        return $this;
    }

    /**
     * Get enemy
     *
     * @return int
     */
    public function getEnemy()
    {
        return $this->enemy;
    }
}

