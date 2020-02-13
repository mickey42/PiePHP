<?php
namespace Model;

use \Core\Entity;
use \Core\ORM;
use \Core\Database;

class FilmModel extends Entity
{
	public $table = 'film';

	public function filtre_movies($id_genre = NULL,$id_distrib = NULL,$titre=""){
        $db = new \Core\Database;
        if(!empty($id_genre) && !empty($id_distrib)){
        $db->query("SELECT film.id_film id_film, film.titre AS titre, genre.nom AS genre, distrib.nom AS distrib 
            FROM film
            LEFT JOIN genre ON genre.id_genre = film.id_genre 
            LEFT JOIN distrib ON distrib.id_distrib = film.id_distrib
            WHERE film.id_genre = $id_genre 
			AND film.id_distrib = $id_distrib
			AND film.titre LIKE '%$titre%'");
        }
        elseif(!empty($id_genre)){
            $db->query("SELECT film.id_film id_film, film.titre AS titre, genre.nom AS genre, distrib.nom AS distrib 
            FROM film
            LEFT JOIN genre ON genre.id_genre = film.id_genre 
            LEFT JOIN distrib ON distrib.id_distrib = film.id_distrib
			WHERE film.id_genre = $id_genre
			AND film.titre LIKE '%$titre%'");
        }
        elseif(!empty($id_distrib)){
            $db->query("SELECT film.id_film id_film, film.titre AS titre, genre.nom AS genre, distrib.nom AS distrib 
            FROM film
            LEFT JOIN genre ON genre.id_genre = film.id_genre 
            LEFT JOIN distrib ON distrib.id_distrib = film.id_distrib
			WHERE film.id_distrib = $id_distrib 
			AND film.titre LIKE '%$titre%'");
		}
		else{
			$db->query("SELECT film.id_film id_film, film.titre AS titre, genre.nom AS genre, distrib.nom AS distrib 
            FROM film
            LEFT JOIN genre ON genre.id_genre = film.id_genre 
            LEFT JOIN distrib ON distrib.id_distrib = film.id_distrib
            WHERE film.titre LIKE '%$titre%'");
		}
        return $db->fetch_all();
    }

	public function find_movies()
	{
		$db = new \Core\Database;
		$db->query("SELECT film.id_film id_film, film.titre AS titre, genre.nom AS genre, distrib.nom AS distrib 
			FROM film
			LEFT JOIN genre ON genre.id_genre = film.id_genre 
			LEFT JOIN distrib ON distrib.id_distrib = film.id_distrib");
		return $db->fetch_all();
	}
	public function find_movie($id)
	{
		$db = new \Core\Database;
		$db->query("SELECT film.id_film as id_film, film.titre AS titre, 
			genre.nom AS genre, distrib.nom AS distrib, 
			film.resum AS resum,film.duree_min AS duree,
			film.annee_prod AS annee
			FROM film
			LEFT JOIN genre ON genre.id_genre = film.id_genre 
			LEFT JOIN distrib ON distrib.id_distrib = film.id_distrib
			WHERE film.id_film = $id");
		return $db->fetch();
	}
	public function find_genres(){
		$db = new \Core\Database;
		$db->query("SELECT * FROM genre");
		return $db->fetch_all();
	}
	public function find_distribs(){
		$db = new \Core\Database;
		$db->query("SELECT * FROM distrib");
		return $db->fetch_all();
	}
}