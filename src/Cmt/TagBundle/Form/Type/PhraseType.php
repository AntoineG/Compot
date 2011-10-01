<?php
namespace Cmt\TagBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

use Cmt\TagBundle\Form\Type\TagType;

class PhraseType extends AbstractType
{
	public function buildForm(FormBuilder $builder, array $options)
	{
		$builder->add('content', 'textarea', array(
			'label' => 'Phrase:'
		));
		
		$builder->add('tag', new TagType());
		
	}

	public function getDefaultOptions(array $options)
	{
		return array(
			'data_class' => 'Cmt\TagBundle\Entity\Phrase',
		);
	}

	public function getName()
	{
		return 'phrase';
	}
}