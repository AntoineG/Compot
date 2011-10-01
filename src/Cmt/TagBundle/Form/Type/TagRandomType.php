<?php
namespace Cmt\TagBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;


class TagRandomType extends AbstractType
{
	public function buildForm(FormBuilder $builder, array $options)
	{
		$builder->add('content', 'text', array(
			'label' => 'Tag:'
		));
	}

	public function getDefaultOptions(array $options)
	{
		return array(
			'data_class' => 'Cmt\TagBundle\Entity\TagRandom',
		);
	}

	public function getName()
	{
		return 'tag_random';
	}
}