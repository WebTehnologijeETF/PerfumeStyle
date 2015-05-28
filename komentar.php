<?php


#require 'baza.php';


class Komentar {


	public static function prebroji($novost_id)
	{

		$stmt = $this->pdo->prepare('SELECT COUNT(*) as broj FROM komentari WHERE novost_id = ?');

		$stmt->execute(array($novost_id));


		return $stmt->fetch(PDO::FETCH_OBJ)->broj;

	}


	public static function nadji_sve($novost_id)
	{

		$stmt = $this->pdo->prepare('SELECT * FROM komentari WHERE novost_id = ? ORDER BY datum ASC');

		$stmt->execute(array($novost_id));


		return $stmt->fetchAll();

	}


	public static function dodaj($novost_id, $autor, $email, $tekst)
	{

		$zahtjev = 'INSERT INTO komentari (novost_id, autor, email, tekst) VALUES (?, ?, ?, ?)';


		$stmt = pdo()->prepare($zahtjev);

		$stmt->execute(array($novost_id, $autor, $email, $tekst));


		return pdo()->lastInsertId();

	}


	public static function obrisi($id)
	{

		$stmt = pdo()->prepare('DELETE FROM komentari WHERE id = ? LIMIT 1');

    return $stmt->execute(array($id));

	}


}
