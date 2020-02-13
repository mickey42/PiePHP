<?php
namespace Controller;

use \Core\Controller;
use \Core\Request;

session_start();

class FilmController extends Controller
{

	public function indexAction()
	{
		if (!isset($_SESSION['log']) || $_SESSION['log'] === false) {
			header('Location: /PiePHP/index.php/user/login');
		}
		$this->render('show');
	}
	public function showAction()
	{
		if (!isset($_SESSION['log']) || $_SESSION['log'] === false) {
			header('Location: /PiePHP/index.php/user/login');
		}
		$url_parts = explode(DIRECTORY_SEPARATOR, $_SERVER['REQUEST_URI']);
		$last_part = $url_parts[count($url_parts)-1];
		$id = (preg_match('/[0-9]+/', $last_part)) ? $last_part : null;
		$request = new Request;
		$params = $request->getQueryParams();
		unset($params['PHPSESSID']);
		$film = new \Model\FilmModel($params);

		if ($id !== null) {
			$movie = $film->find_movie($id);
			$genres = $film->find_genres();
			$distribs = $film->find_distribs();
			$this->render('page_film', $scope = array('movie' => $movie, 'genres' => $genres, 'distribs' => $distribs));
		} else {
            $genres = $film->find_genres();
            $distribs = $film->find_distribs();
            if(!empty($_POST['select_genre']) || !empty($_POST['select_distrib'])||!empty($_POST['input_Titre'])){
                $movies = $film->filtre_movies($_POST['select_genre'], $_POST['select_distrib'],$_POST['input_Titre']);
            }
            else {
                $movies = $film->find_movies();
            }
            $this->render('films', $scope = array('movies' => $movies, 'genres' => $genres, 'distribs' => $distribs));
        }
		if (isset($_POST['titre'])) {
			$film->id = $id;
			$film->update();
			$movie = $film->find_movie($id);
			$genres = $film->find_genres();
			$distribs = $film->find_distribs();
			$this->render('page_film', $scope = array('movie' => $movie, 'genres' => $genres, 'distribs' => $distribs));
		}
		if (isset($_POST['delete'])) {
			$film->id = $id;
			$film->delete();
			header('Location: /PiePHP/index.php/film/show/');
		}
	}

	public function addAction(){
		if (!isset($_SESSION['log']) || $_SESSION['log'] === false) {
			header('Location: /PiePHP/index.php/user/login');
		}
		$request = new Request;
		$params = $request->getQueryParams();
		unset($params['PHPSESSID']);
		$film = new \Model\FilmModel($params);
		$genres = $film->find_genres();
		$distribs = $film->find_distribs();
		$this->render('add_film', $scope = array('genres' => $genres, 'distribs' => $distribs));

		if (isset($params['titre'])) {
			if (empty($params['titre'])) {
				$error = 'Veuillez rentrer au moins un titre';
				exit();
			}
			$id_film = $film->create();
			header('Location: /PiePHP/index.php/film/show/' . $id_film);
		}
	}

	public function addhsitoriqueAction(){
		if (!isset($_SESSION['log']) || $_SESSION['log'] === false) {
			header('Location: /PiePHP/index.php/user/login');
		}
		$request = new Request;
		$params = $request->getQueryParams();
		unset($params['PHPSESSID']);
		$histo = new \Model\HistoriqueModel($params);

		$url_parts = explode(DIRECTORY_SEPARATOR, $_SERVER['REQUEST_URI']);
		$last_part = $url_parts[count($url_parts)-1];
		$id_film = (preg_match('/[0-9]+/', $last_part)) ? $last_part : null;

		$id_user = $_SESSION['id_fiche_personne'];

		$read = $histo->read_histo($id_film, $id_user);
		if(count($read)== 0){
			
			$histo->create_histo($id_film, $id_user);
		}
		header('Location: /PiePHP/index.php/film/historique');
	}

	public function delhsitoriqueAction(){
		if (!isset($_SESSION['log']) || $_SESSION['log'] === false) {
			header('Location: /PiePHP/index.php/user/login');
		}
		$request = new Request;
		$params = $request->getQueryParams();
		unset($params['PHPSESSID']);
		$histo = new \Model\HistoriqueModel($params);

		$url_parts = explode(DIRECTORY_SEPARATOR, $_SERVER['REQUEST_URI']);
		$last_part = $url_parts[count($url_parts)-1];
		$id_film = (preg_match('/[0-9]+/', $last_part)) ? $last_part : null;

		$id_user = $_SESSION['id_fiche_personne'];

		$read = $histo->read_histo($id_film, $id_user);
		if(count($read)!= 0){
			
			$histo->delete_histo($id_film, $id_user);
		}
		header('Location: /PiePHP/index.php/film/historique');

	}

	public function readhistoriqueAction(){
		if (!isset($_SESSION['log']) || $_SESSION['log'] === false) {
			header('Location: /PiePHP/index.php/user/login');
		}
		$request = new Request;
		$params = $request->getQueryParams();
		unset($params['PHPSESSID']);

		$histo = new \Model\HistoriqueModel($params);
		$id_user = $_SESSION['id_fiche_personne'];
		$movies = $histo->find_histo($id_user);
		
		$film = new \Model\FilmModel($params);
		$genres = $film->find_genres();
		$distribs = $film->find_distribs();

		$this->render('historique_film', $scope = array('movies' => $movies, 'genres' => $genres, 'distribs' => $distribs));
	}
	
	public function tomAction(){
		
		echo '<img src="../../webroot/assets/" alt="chips">';

		$this->render('historique_film', $scope = array('movies' => $movies, 'genres' => $genres, 'distribs' => $distribs));
	}
}
?>

