<?php
namespace Cmt\TagBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Cmt\TagBundle\Entity\PhraseRepository")
 * @ORM\Table(name="phrases")
 */
class Phrase
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

	/**
     * @ORM\Column(type="text")
     */
	protected $content;
	
	/**
	 * @ORM\OneToMany(targetEntity="Tag", mappedBy="phrase", cascade={"persist"})
     */
	protected $tags;
	
	
    public function __construct()
    {
        $this->tags = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set content
     *
     * @param text $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * Get content
     *
     * @return text 
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Add tags
     *
     * @param Cmt\TagBundle\Entity\Tag $tags
     */
    public function addTags(\Cmt\TagBundle\Entity\Tag $tags)
    {
        $this->tags[] = $tags;
    }

    /**
     * Get tags
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * Add tags
     *
     * @param Cmt\TagBundle\Entity\Tag $tags
     */
    public function addTag(\Cmt\TagBundle\Entity\Tag $tags)
    {
        $this->tags[] = $tags;
    }
}