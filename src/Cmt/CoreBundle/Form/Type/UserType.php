<?php
namespace Cmt\CoreBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

use Cmt\CoreBundle\Form\Type\ProspectType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder->add('username', 'text', array(
			'label' => 'Nom d\'Utilisateur:',
		));

	    $builder->add('email', 'email', array(
			'label' => 'Email:',
		));

		$builder->add('plainPassword', 'repeated', array(
			'first_name' => 'Mot de passe:',
			'second_name' => 'Repetez-le:',
			'type' => 'password',
		));
		
		$builder->add('prospect', new ProspectType());
    }

	public function getDefaultOptions(array $options)
	{
	        return array(
	            'data_class' => 'Cmt\CoreBundle\Entity\User',
	        );
	}
	
    public function getName()
    {
        return 'user';
    }
}