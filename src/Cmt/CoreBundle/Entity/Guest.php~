<?php
namespace Cmt\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="Cmt\CoreBundle\Entity\GuestRepository")
 * @ORM\Table(name="guests")
 */
class Guest
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
	
	/**
     * @ORM\Column(type="string", length="255")
	 * @Assert\NotBlank()
	 * @Assert\Email()
     */
	protected $email;
	
	/**
     * @ORM\Column(type="string", length="255")
	 * @Assert\NotBlank()
	 * @Assert\MinLength(3)
     */
	protected $firstName;
	
	/**
     * @ORM\Column(type="string", length="255")
	 * @Assert\NotBlank()
	 * @Assert\MinLength(3)
     */
	protected $lastName;
	
	/**
     * @ORM\Column(type="integer")
	 * @Assert\NotBlank()
     */
	protected $postalCode;
	
	/**
     * @ORM\Column(type="string", length="255")
	 * @Assert\NotBlank()
     */
	protected $city;
	
	/**
     * @ORM\Column(type="string", length="255")
	 * @Assert\NotBlank()
     */
	protected $address;
	
	/**
     * @ORM\Column(type="integer")
	 * @Assert\NotBlank()
     */
	protected $phoneFix;
	
	/**
     * @ORM\Column(type="integer")
	 * @Assert\NotBlank()
     */
	protected $phoneMobile;
	
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
     * Set email
     *
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set firstName
     *
     * @param string $firstName
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * Get firstName
     *
     * @return string 
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * Get lastName
     *
     * @return string 
     */
    public function getLastName()
    {
        return $this->lastName;
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
     * Set city
     *
     * @param string $city
     */
    public function setCity($city)
    {
        $this->city = $city;
    }

    /**
     * Get city
     *
     * @return string 
     */
    public function getCity()
    {
        return $this->city;
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