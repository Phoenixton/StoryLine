<?php

namespace UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * user
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="UserBundle\Repository\userRepository")
 */
class user implements UserInterface
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
     * @ORM\Column(name="username", type="string", length=255)
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=64)
     */
    private $password;

    /**
     * @var int
     *
     * @ORM\Column(name="stamina", type="smallint")
     */
    private $stamina;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="lastconnect", type="datetime")
     */
    private $lastconnect;

    /**
     * @var int
     *
     * @ORM\Column(name="currentCharacter", type="smallint")
     */
    private $currentCharacter;

    /**
     * @ORM\Column(name="avatar", type="string", nullable=true)
     *
     * @Assert\File(mimeTypes={ "image/png" })
     */
    private $avatar;

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
     * Set username
     *
     * @param string $username
     *
     * @return user
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return user
     */
    public function setPassword($password)
    {
        $this->password = password_hash($password, PASSWORD_BCRYPT);

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set stamina
     *
     * @param integer $stamina
     *
     * @return user
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
     * Set lastconnect
     *
     * @param \Datetime $lastconnect
     *
     * @return user
     */
    public function setLastconnect($lastconnect)
    {
        $this->lastconnect = $lastconnect;

        return $this;
    }

    /**
     * Get lastconnect
     *
     * @return \Datetime
     */
    public function getLastconnect()
    {
        return $this->lastconnect;
    }

    /**
     * Get currentCharacter
     *
     * @return int
     */
    public function getCurrentCharacter()
    {
        return $this->currentCharacter;
    }

    /**
     * Set currentCharacter
     *
     * @param integer $currentCharacter
     *
     * @return user
     */
    public function setCurrentCharacter($currentCharacter)
    {
        $this->currentCharacter = $currentCharacter;

        return $this;
    }


    /**
     * Get avatar
     *
     * @return boolean
     */
    public function getAvatar()
    {
        return $this->avatar;
    }

    /**
     * Set avatar
     *
     * @param boolean $avatar
     *
     * @return user
     */
    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;

        return $this;
    }



    /**
     * Returns the roles granted to the user.
     * All the Users Created are Regular Users, stored in the database
     * The Admin is stored in memory
     *
     * @return (Role|string)[] The user roles
     */
    public function getRoles()
    {
        return array('ROLE_USER');
    }

    /**
     * Returns the salt that was originally used to encode the password.
     *
     * This can return null if the password was not encoded using a salt.
     *
     * @return string|null The salt
     */
    public function getSalt()
    {
        return null;
    }

    /**
     * Removes sensitive data from the user.
     *
     * This is important if, at any given point, sensitive information like
     * the plain-text password is stored on this object.
     */
    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }
}

