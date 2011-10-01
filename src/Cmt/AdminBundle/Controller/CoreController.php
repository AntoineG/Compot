<?php

namespace Cmt\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\DependencyInjection\ContainerAware;

use Symfony\Component\HttpFoundation\Response; 

use Cmt\AdminBundle\Admin\InitializableControllerInterface;
use Cmt\AdminBundle\Admin\UninitializableControllerInterface;

/**
 * 
 * @author Tobias Hourst <tobias@strawberrydigital.com.au>
 *
 */
class CoreController extends Controller implements InitializableControllerInterface
{
	/**
	* Base template extended in views.
	* Populated from params.
	* Changes depending on request type.	
	*/
	protected $baseTemplate;
	
	/**
	* Called before request.
	* 
	*@see Cmt\AdminBundle\EventListener\AdminActionListener.php
	*/
	public function initialize()
	{
		//Set base template
		$this->baseTemplate = $this->getBaseTemplate();
	}
	
	/**
	* Overrides Controller::render() function  
	*
	*@param $view  string
	*@param $parameters  array  optional
	*@param $response  Response  optional
	*/
	public function render($view, array $parameters = array(), Response $response = null)
	{	
		/*
		* Add default parameters
		*/
		$defaultParameters = array(
			
			//Set base template
			'base_template' => $this->baseTemplate,
		);
		
		//Merge arrays
		$parameters = array_merge($defaultParameters, $parameters);
		
		//Call parent function
		return parent::render($view, $parameters, $response);
	}
	
	/**
	* Checks whether the request is AJAX or not
	* and returns the appropriate template.
	*
	*@return template param string
	*/
	public function getBaseTemplate()
	{
		if ($this->container->get('request')->isXmlHttpRequest())
			return $this->container->getParameter('cmt.admin.templates.ajax');
		else
			return $this->container->getParameter('cmt.admin.templates.layout');
		
	}

}
