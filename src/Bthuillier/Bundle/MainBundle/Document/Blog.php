<?php

namespace Bthuillier\Bundle\MainBundle\Document;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @MongoDB\Document(repositoryClass="Bthuillier\Bundle\MainBundle\Repository\BlogRepository")
 */
class Blog {
    
    /**
     * @MongoDB\Id(strategy="auto")
     */
    protected $id;
    
    /**
     * @MongoDB\String
     * @gedmo\Sluggable
     * @Assert\MinLength(limit=3)
     * @Assert\NotBlank
     */
    protected $title;

    /**
     * @gedmo\Slug
     * @MongoDB\String
     */
    protected $slug;

    /**
     * @MongoDB\String
     * @Assert\NotBlank
     */
    protected $body;
    
    /**
     * @MongoDB\String
     * @Assert\NotBlank
     */
    protected $description;
    
    /**
     * @gedmo\Timestampable(on="create")
     * @MongoDB\Date
     */
    protected $publishedAt;
    
    /**
     * @gedmo\Timestampable(on="update")
     * @MongoDB\Date
     * 
     */
    protected $updatedAt;
    
    /**
     * @MongoDB\Boolean
     */
    protected $isActive;

    /**
     * @MongoDB\ReferenceOne(targetDocument="User")
     */
    private $author;    

    
    /**
     * Get id
     *
     * @return id $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * Get title
     *
     * @return string $title
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set slug
     *
     * @param string $slug
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    }

    /**
     * Get slug
     *
     * @return string $slug
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set body
     *
     * @param string $body
     */
    public function setBody($body)
    {
        $this->body = $body;
    }

    /**
     * Get body
     *
     * @return string $body
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * Set publishedAt
     *
     * @param date $publishedAt
     */
    public function setPublishedAt($publishedAt)
    {
        $this->publishedAt = $publishedAt;
    }

    /**
     * Get publishedAt
     *
     * @return date $publishedAt
     */
    public function getPublishedAt()
    {
        return $this->publishedAt;
    }

    /**
     * Set isActive
     *
     * @param boolean $isActive
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;
    }

    /**
     * Get isActive
     *
     * @return boolean $isActive
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * Set author
     *
     * @param Bthuillier\Bundle\MainBundle\Document\User $author
     */
    public function setAuthor(\Bthuillier\Bundle\MainBundle\Document\User $author)
    {
        $this->author = $author;
    }

    /**
     * Get author
     *
     * @return Bthuillier\Bundle\MainBundle\Document\User $author
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set updatedAt
     *
     * @param date $updatedAt
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }

    /**
     * Get updatedAt
     *
     * @return date $updatedAt
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set description
     *
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * Get description
     *
     * @return string $description
     */
    public function getDescription()
    {
        return $this->description;
    }

}
