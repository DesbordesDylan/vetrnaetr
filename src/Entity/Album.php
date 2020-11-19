<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AlbumRepository")
 */
class Album
{
     /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     * @Assert\Length(max=255)
     */
    private $artist;

    /**
     * @ORM\Column(type="string")
     * @Assert\Length(max=255)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\Column(type="string")
     */
    private $listeningTime;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $support;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $price;

    /**
     * @ORM\Column(type="string")
     */
    private $brochure;

    /**
     * https://www.doctrine-project.org/projects/doctrine-orm/en/2.7/reference/working-with-associations.html#transitive-persistence-cascade-operations
     * 
     * @ORM\OneToMany(targetEntity="App\Entity\Song", mappedBy="album", cascade={"persist", "remove"})
     */
    private $songs;

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of title
     */ 
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the value of title
     *
     * @return  self
     */ 
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get the value of listeningTime
     */ 
    public function getListeningTime()
    {
        return $this->listeningTime;
    }

    /**
     * Set the value of listeningTime
     *
     * @return  self
     */ 
    public function setListeningTime($listeningTime)
    {
        $this->listeningTime = $listeningTime;

        return $this;
    }

    public function getBrochure()
    {
        return $this->brochure;
    }

    public function setBrochure($brochure)
    {
        $this->brochure = $brochure;

        return $this;
    }

    /**
     * Get the value of artist
     */ 
    public function getArtist()
    {
        return $this->artist;
    }

    /**
     * Set the value of artist
     *
     * @return  self
     */ 
    public function setArtist($artist)
    {
        $this->artist = $artist;

        return $this;
    }

    /**
     * Get https://www.doctrine-project.org/projects/doctrine-orm/en/2.7/reference/working-with-associations.html#transitive-persistence-cascade-operations
     */ 
    public function getSongs()
    {
        return $this->songs;
    }

    /**
     * Set https://www.doctrine-project.org/projects/doctrine-orm/en/2.7/reference/working-with-associations.html#transitive-persistence-cascade-operations
     *
     * @return  self
     */ 
    public function setSongs($songs)
    {
        $this->songs = $songs;

        return $this;
    }

    /**
     * Get the value of description
     */ 
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of description
     *
     * @return  self
     */ 
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get the value of support
     */ 
    public function getSupport()
    {
        return $this->support;
    }

    /**
     * Set the value of support
     *
     * @return  self
     */ 
    public function setSupport($support)
    {
        $this->support = $support;

        return $this;
    }

    /**
     * Get the value of price
     */ 
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set the value of price
     *
     * @return  self
     */ 
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }
}