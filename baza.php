<?php

function pdo()
{
	$server         = 'localhost';
	$port           = 3306;
	$naziv          = 'WTtest';
	$korisnicko_ime = 'root';
	$lozinka        = '';
	$konekcija = "mysql:host={$server};port={$port};dbname={$naziv}";

	return new PDO($konekcija, $korisnicko_ime, $lozinka);
}
?>