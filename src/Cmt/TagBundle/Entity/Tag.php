<?php
namespace Cmt\TagBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Cmt\TagBundle\Entity\TagRepository")
 * @ORM\Table(name="tags")
 */
class Tag
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

	/**
	 * @ORM\ManyToOne(targetEntity="Phrase", inversedBy="tags")
     */
	protected $phrase;
	
	/**
     * @ORM\Column(type="string", length="255")
     */
	protected $content;
	
	/**
	 * @ORM\OneToMany(targetEntity="TagRandom", mappedBy="tag", cascade={"persist"})
     */
	protected $randoms;
	
    public function __construct()
    {
        $this->randoms = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @param string $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * Get content
     *
     * @return string 
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set phrase
     *
     * @param Cmt\TagBundle\Entity\Phrase $phrase
     */
    public function setPhrase(\Cmt\TagBundle\Entity\Phrase $phrase)
    {
        $this->phrase = $phrase;
    }

    /**
     * Get phrase
     *
     * @return Cmt\TagBundle\Entity\Phrase 
     */
    public function getPhrase()
    {
        return $this->phrase;
    }

    /**
     * Add randoms
     *
     * @param Cmt\TagBundle\Entity\TagRandom $randoms
     */
    public function addRandoms(\Cmt\TagBundle\Entity\TagRandom $randoms)
    {
        $this->randoms[] = $randoms;
    }

    /**
     * Get randoms
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getRandoms()
    {
        return $this->randoms;
    }

    /**
     * Add randoms
     *
     * @param Cmt\TagBundle\Entity\TagRandom $randoms
     */
    public function addTagRandom(\Cmt\TagBundle\Entity\TagRandom $randoms)
    {
        $this->randoms[] = $randoms;
    }
}