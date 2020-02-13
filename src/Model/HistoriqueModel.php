<?php
namespace Model;

use \Core\Entity;
use \Core\ORM;
use \Core\Database;

class HistoriqueModel extends Entity
{
    public $table = 'historique';
    
    public function read_histo($id_film, $id_user){
        $db = new \Core\Database;
        $db->query("SELECT * FROM $this->table
        WHERE id_film = $id_film 
        AND id_fiche_personne = $id_user");

    return $db->fetch_all();
    }

    public function create_histo($id_film, $id_user){
        $db = new \Core\Database;
        $db->query("INSERT INTO $this->table(`id_film`,`id_fiche_personne`)
        VALUES ($id_film,$id_user)");

    return $db->execute();
    }

    public function delete_histo($id_film, $id_user){
        $db = new \Core\Database;
        $db->query("DELETE FROM $this->table
        WHERE id_film = $id_film 
        AND id_fiche_personne = $id_user");

    return $db->execute();
    }

    public function find_histo($id_user)
	{
		$db = new \Core\Database;
		$db->query("SELECT film.id_film as id_film, film.titre AS titre, 
			genre.nom AS genre, distrib.nom AS distrib, 
			film.resum AS resum,film.duree_min AS duree,
			film.annee_prod AS annee,historique.date_vue AS date_vue
			FROM film
			LEFT JOIN genre ON genre.id_genre = film.id_genre 
			LEFT JOIN distrib ON distrib.id_distrib = film.id_distrib
            LEFT JOIN historique ON film.id_film = historique.id_film
			WHERE historique.id_fiche_personne = $id_user");
        return $db->fetch_all();
    }
}
