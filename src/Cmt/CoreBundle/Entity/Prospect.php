<?php
namespace Cmt\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="Cmt\CoreBundle\Entity\ProspectRepository")
 * @ORM\Table(name="prospects")
 */
class Prospect
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
	
	/**
	* @ORM\Column(type="string", length="255")
	* @Assert\Choice(choices = {"entreprise", "association"})
	* @Assert\NotBlank()
	*/
	protected $type;
	
	/**
	* @ORM\Column(type="string", length="255")
	* @Assert\NotBlank()
	*/
	protected $companyName;
	
	/**
	* @ORM\Column(type="integer")
	* @Assert\Type(type="integer")
	* @Assert\NotBlank()
	*/
	protected $siret;
	
	/**
	* @ORM\Column(type="string", length="255")
	* @Assert\NotBlank()
	*/
	protected $contactName;
	
	/**
	* @ORM\Column(type="string", length="255")
	* @Assert\NotBlank()
	*/
	protected $address;
	
	/**
	* @ORM\Column(type="integer")
	* @Assert\Type(type="integer")
	* @Assert\NotBlank()
	*/
	protected $postalCode;
	
	/**
	* @ORM\Column(type="integer")
	* @Assert\Type(type="integer")
	* @Assert\NotBlank()
	*/
	protected $phoneFix;
	
	/**
	* @ORM\Column(type="integer")
	* @Assert\Type(type="integer")
	* @Assert\NotBlank()
	*/
	protected $phoneMobile;
	
	/**
	* @ORM\Column(type="integer")
	* @Assert\Type(type="integer")
	* @Assert\NotBlank()
	*/
	protected $fax;
	
	/**
	* @ORM\Column(type="string", length="255")
	* @Assert\NotBlank()
	*/
	protected $website;
	
	/**
     * @ORM\Column(type="datetime")
	 * @Assert\DateTime()
     */
	protected $requestDate;

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
     * Set type
     *
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * Get type
     *
     * @return string 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set companyName
     *
     * @param string $companyName
     */
    public function setCompanyName($companyName)
    {
        $this->companyName = $companyName;
    }

    /**
     * Get companyName
     *
     * @return string 
     */
    public function getCompanyName()
    {
        return $this->companyName;
    }

    /**
     * Set siret
     *
     * @param integer $siret
     */
    public function setSiret($siret)
    {
        $this->siret = $siret;
    }

    /**
     * Get siret
     *
     * @return integer 
     */
    public function getSiret()
    {
        return $this->siret;
    }

    /**
     * Set contactName
     *
     * @param string $contactName
     */
    public function setContactName($contactName)
    {
        $this->contactName = $contactName;
    }

    /**
     * Get contactName
     *
     * @return string 
     */
    public function getContactName()
    {
        return $this->contactName;
    }

    /**
     * Set address
     *
     * @param string $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }

    /**
     * Get address
     *
     * @return string 
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set postalCode
     *
     * @param integer $postalCode
     */
    public function setPostalCode($postalCode)
    {
        $this->postalCode = $postalCode;
    }

    /**
     * Get postalCode
     *
     * @return integer 
     */
    public function getPostalCode()
    {
        return $this->postalCode;
    }

    /**
     * Set phoneFix
     *
     * @param integer $phoneFix
     */
    public function setPhoneFix($phoneFix)
    {
        $this->phoneFix = $phoneFix;
    }

    /**
     * Get phoneFix
     *
     * @return integer 
     */
    public function getPhoneFix()
    {
        return $this->phoneFix;
    }

    /**
     * Set phoneMobile
     *
     * @param integer $phoneMobile
     */
    public function setPhoneMobile($phoneMobile)
    {
        $this->phoneMobile = $phoneMobile;
    }

    /**
     * Get phoneMobile
     *
     * @return integer 
     */
    public function getPhoneMobile()
    {
        return $this->phoneMobile;
    }

    /**
     * Set fax
     *
     * @param integer $fax
     */
    public function setFax($fax)
    {
        $this->fax = $fax;
    }

    /**
     * Get fax
     *
     * @return integer 
     */
    public function getFax()
    {
        return $this->fax;
    }

    /**
     * Set website
     *
     * @param string $website
     */
    public function setWebsite($website)
    {
        $this->website = $website;
    }

    /**
     * Get website
     *
     * @return string 
     */
    public function getWebsite()
    {
        return $this->website;
    }

    /**
     * Set requestDate
     *
     * @param datetime $requestDate
     */
    public function setRequestDate($requestDate)
    {
        $this->requestDate = $requestDate;
    }

    /**
     * Get requestDate
     *
     * @return datetime 
     */
    public function getRequestDate()
    {
        return $this->requestDate;
    }
}