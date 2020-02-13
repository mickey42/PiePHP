<?php
namespace Controller;

use \Core\Controller;
use \Core\Request;

session_start();

class GenreController extends Controller
{

	public function indexAction()
	{
		if (!isset($_SESSION['log']) || $_SESSION['log'] === false) {
			header('Location: /PiePHP/user/login');
		}
		$this->render('show');
	}
	public function showAction()
	{
		if (!isset($_SESSION['log']) || $_SESSION['log'] === false) {
			header('Location: /PiePHP/index.php/user/login');
		}
		$request = new Request;
		$params = $request->getQueryParams();
		unset($params['PHPSESSID']);
		$genre = new \Model\GenreModel($params);
		$genres = $genre->find(['ORDER BY' => 'nom ASC']);
		$this->render('show', $scope = array('genres' => $genres));
		if (isset($params['delete'])) {
			$genre->id = $params['delete'];
			$genre->delete();
			$genres = $genre->find('ORDER BY nom ASC');
			$this->render('show', $scope = array('genres' => $genres));
			exit();
		}
		if (isset($params['add'])) {
			$params['nom'] = $params['add'];
			unset($params['add']);
			$genre = new \Model\GenreModel($params);
			$genre->create();
			$genres = $genre->find('ORDER BY nom ASC');
			$this->render('show', $scope = array('genres' => $genres));
			exit();
		}
		if (isset($params['nom'])) {
			$genre->id = $params['id'];
			$genre->update();
			$genres = $genre->find('ORDER BY nom ASC');
			$this->render('show', $scope = array('genres' => $genres));
			exit();
		}

	}
}
