<?php
namespace Cmt\AdminBundle\EventListener;
 
use Symfony\Bundle\TwigBundle\TwigEngine;
use Symfony\Bundle\TwigBundle\Controller\ExceptionController;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
 
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;

use Cmt\AdminBundle\Admin\InitializableControllerInterface;
use Cmt\AdminBundle\Admin\UninitializableControllerInterface;

use Symfony\Component\HttpFoundation\Response;

/**
 * 
 * @author Tobias Hourst <tobias@strawberrydigital.com.au>
 *
 */
class AdminActionListener
{
	/**
	* @var ContainerInterface
	*/
	protected $container;

 
	/**
	* @param ContainerInterface $container
	*/
	public function __construct(ContainerInterface $container ){
		// assign value(s)
		$this->container = $container;
	}
 
	/**
	* @param FilterControllerEvent $event
	*/
	public function onKernelController(FilterControllerEvent $event)
	{
		// get controller
		$controller = $event->getController();
 
		if(!is_array($controller)) return;
 		
		if($controller[0] instanceof ExceptionController)  return;
 		
		// make sure InitializableControllerInterface is implemented
		$controllerObject = $controller[0];
		if ($controllerObject instanceof InitializableControllerInterface) {
			$controllerObject->initialize($event->getRequest());
		}
	}
	
	
	/**
	* 
	* @param FilterResponseEvent $event
	*/
	public function onKernelResponse(FilterResponseEvent $event)
	{
		// get response
		$response = $event->getResponse();

		// handle AJAX
		if ($this->container->get('request')->isXmlHttpRequest()){
			
			$data = array(
				'title' => 'CMS: Comme Au Potager',
				'content' => $response->getContent(),
			);
			
			// convert data into JSON
			$data = json_encode($data);
			
			// create new response
			new Response($data);
		}
	}
	
	/**
	 * 
	 * @param GetResponseForExceptionEvent $event
	 */
	public function onKernelException(GetResponseForExceptionEvent $event)
	{
		// get exception
		$exception = $event->getException();
		
		// get path
		$path = $event->getRequest()->getPathInfo();
		
		/*
		 * Redirect response to new 404 error view only
		 * on path prefix /admin/ 
		 */
		if ($exception->getStatusCode() == 404 && strpos($path, '/admin') === 0){
	    	
	    	// get templating
		    $templating = $this->container->get('templating');		   
		    
		    // load appropriate template depending on request type (AJAX or not)
		    if($this->container->get('request')->isXmlHttpRequest()){
		    	
		    	// set template
		    	$baseTemplate = $this->container->getParameter('cmt.admin.templates.ajax');
		    	
		    	// prepare data
		    	$content = $templating->render('CmtAdminBundle:Exception:error404.html.twig', array(
			    	'exception' => $exception,
			    	'path' => $path,
			    	'base_template' => $baseTemplate,
		    	));
		    	
		    	// init data var
		    	$data = array(
		    		'content' => $content
		    	);
		    	
		    	// prepare response and encode $data array into JSON obect 
		    	$response = json_encode($data);
		    	
		    } else {
		    	
		    	// set template
		    	$baseTemplate = $this->container->getParameter('cmt.admin.templates.layout');
		    	
		    	// prepare new response
		    	$response = $templating->render('CmtAdminBundle:Exception:error404.html.twig', array(
			    	'exception' => $exception,
			    	'path' => $path,
			    	'base_template' => $baseTemplate,
		    	));
		    }
		    
		    // set new response
		    $event->setResponse(new Response($response));
		}
	}
}// end class
