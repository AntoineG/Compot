<?php
namespace Cmt\CoreBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class GuestType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder->add('lastName', 'text', array(
				'label' => 'Nom:',
		));
		
		$builder->add('firstName', 'text', array(
				'label' => 'Prénom:',
		));
		
		$builder->add('email', 'text', array(
				'label' => 'Email:',
		));
		
		$builder->add('address', 'text', array(
				'label' => 'Adresse:',
		));
		
		$builder->add('postalCode', 'integer', array(
				'label' => 'Code Postal:',
		));
		
		$builder->add('city', 'text', array(
				'label' => 'Ville:',
		));
		
		$builder->add('phoneFix', 'integer', array(
				'label' => 'N° de téléphone fixe:',
		));
		
		$builder->add('phoneMobile', 'integer', array(
				'label' => 'N° de téléphone mobile:',
		));
    }

    public function getName()
    {
        return 'guest';
    }
}