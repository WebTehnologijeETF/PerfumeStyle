<?php


require 'baza.php';


class Novost {


	public static function nadji($id)
	{

		$stmt = pdo()->prepare('SELECT * FROM novosti WHERE id = ? LIMIT 1');

		$stmt->execute(array($id));


		$novost = $stmt->fetch();


		$novost['broj_komentara'] = Komentar::nadji_sve($novost['id']);


		return $novost;

	}


	public static function nadji_sve()
	{

		$novosti = array();


		$stmt = pdo()->query('SELECT * FROM novosti ORDER BY datum DESC');


		return $stmt->fetchAll();

	}

	
	public static function dodaj()
	{

		$zahtjev = 'INSERT INTO novosti (naslov, autor, slika, tekst, detaljnije) VALUES (?, ?, ?, ?, ?)';


		$stmt = pdo()->prepare($zahtjev);

		$stmt->execute(array($naslov, $autor, $slika, $tekst, $detaljnije));


		return pdo()->lastInsertId();

	}


	public static function izmijeni()
	{

		$zahtjev = 'UPDATE novosti SET naslov = ?, autor = ?, slika = ?, tekst = ?, detaljnije = ? WHERE id = ? LIMIT 1';


		$stmt = pdo()->prepare($zahtjev);

		$stmt->execute(array($naslov, $autor, $slika, $tekst, $detaljnije, $id));

	}


	public static function obrisi($id)
	{

		$stmt = pdo()->prepare('DELETE FROM novosti WHERE id = ? LIMIT 1');

    return $stmt->execute(array($id));

	}


}
