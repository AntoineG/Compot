<?php
namespace Cmt\CoreBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class ProspectType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {	
		$builder->add('type', 'choice', array(
		    'choices'   => array('entreprise' => 'Entreprise', 'association' => 'Association'),
		    'required'  => true,
		));
		
		$builder->add('companyName', 'text', array(
				'label' => 'Nom de votre structure:',
		));
		
		$builder->add('siret', 'integer', array(
				'label' => 'N° SIRET:',
		));
		
		$builder->add('contactName', 'text', array(
				'label' => 'Nom de contact:',
		));
		
		$builder->add('address', 'text', array(
				'label' => 'Adresse:',
		));
		
		$builder->add('postalCode', 'integer', array(
				'label' => 'Code postal:',
		));
		
		$builder->add('phoneFix', 'integer', array(
				'label' => 'N° de téléphone fixe:',
		));
		
		$builder->add('phoneMobile', 'integer', array(
				'label' => 'N° de téléphone mobile:',
		));
		
		$builder->add('fax', 'integer', array(
				'label' => 'Fax:',
		));
		
		$builder->add('website', 'text', array(
				'label' => 'Site internet:',
		));
    }
	
	public function getDefaultOptions(array $options)
	{
	        return array(
	            'data_class' => 'Cmt\CoreBundle\Entity\Prospect',
	        );
	}
	
    public function getName()
    {
        return 'prospect';
    }
}