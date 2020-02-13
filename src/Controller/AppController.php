<?php
namespace Controller;

use \Core\Controller;

class AppController extends Controller
{
	public function indexAction()
	{
		header("Location: /PiePHP/src/View/App");
	}

	public function ogreAction(){
		echo " <h1>A table ! </h1>";
	}
}