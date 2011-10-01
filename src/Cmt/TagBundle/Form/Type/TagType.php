<?php
namespace Cmt\TagBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

use Cmt\TagBundle\Form\Type\TagRandomType;

class TagType extends AbstractType
{
	public function buildForm(FormBuilder $builder, array $options)
	{
		$builder->add('content', 'text', array(
			'label' => 'Tag:'
		));
		
		$builder->add('tag', new TagRandomType());

	}

	public function getDefaultOptions(array $options)
	{
		return array(
			'data_class' => 'Cmt\TagBundle\Entity\Tag',
		);
	}

	public function getName()
	{
		return 'tag';
	}
}