<?php
namespace Cmt\AdminBundle\Admin;

interface InitializableControllerInterface {
	
	/*
	* Function called before every request
	*/
	function initialize();
}