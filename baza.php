<?php

function pdo()
{
	$server         = '127.7.84.2';
	$port           = 3306;
	$naziv          = 'parfumestyle';
	$korisnicko_ime = 'admin8XrcEWZ';
	$lozinka        = 'WtfYICDsZYYP';
	$konekcija = "mysql:host={$server};port={$port};dbname={$naziv}";

	return new PDO($konekcija, $korisnicko_ime, $lozinka);
}
?>