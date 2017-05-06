<?php

namespace GameBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * logs
 *
 * @ORM\Table(name="logs")
 * @ORM\Entity(repositoryClass="GameBundle\Repository\logsRepository")
 */
class logs
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
     * @ORM\OneToOne(targetEntity="GameBundle\Entity\characters")
     */
    private $charac;

    /**
     * @var string
     *
     * @ORM\Column(name="log", type="text")
     */
    private $log;


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
     * @return logs
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
     * Set log
     *
     * @param string $log
     *
     * @return logs
     */
    public function setLog($log)
    {
        $this->log = $log;

        return $this;
    }

    /**
     * Get log
     *
     * @return string
     */
    public function getLog()
    {
        return $this->log;
    }
}

