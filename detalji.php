<!DOCTYPE HTML SYSTEM>
<HTML>
<HEAD>
<meta http-equiv="content-Type" content="text/html; charset=utf-8">

<TITLE>Perfumes</TITLE>
<link rel="stylesheet" type="text/css" href="stil.css">
</HEAD>
<BODY>

	<div id="zaglavlje">
	<a  href="index.php"> <img src="images/logo.gif" alt="Logo" ></a>
	
	<p>PERFUME STYLE </p>
	<h1></h1>


 </div>
 
 
 <div id="meni">
<ul>
	<li> <a href="index.php"> Home</a></li>
	<li> <a href="aboutus.html"> About us</a></li>
	<li> <a href="products.html"> Products</a></li>
	<li onmouseover="pokaziMeni()" onmouseout="sakrijMeni()"><a id="FriendsLink" href="friends.html" >Our friends</a>
			<ul id="podMenu" onmouseover="pokaziMeni()" >
				<li><a href="#">Armani</a></li>
				<li><a href="#">Bvlgari</a></li>
			</ul>
			</li>
	
	<li> <a href="ContactUs.html"> Contact us</a></li>	
</ul>
 </div>

 
 <div>
 
<?php
	require 'baza.php';
	if(isset($_GET["nid"])) {
		$id = $_GET["nid"];
		
		if(isset($_POST["komentar"]) && isset($_POST["ime"]) && isset($_POST["email"])) {
			$comment = $_POST["komentar"];
			$name = $_POST["ime"];
			$mail = $_POST["email"];
			$stmt4 = pdo()->prepare('INSERT INTO komentari (novost_id, autor, email, tekst) VALUES (?, ?, ?, ?)');
			$stmt4->execute(array($id, $name, $mail, $comment));
		}
		
		$stmt = pdo()->prepare('SELECT * FROM novosti WHERE id = ?');
		$stmt->execute(array($id));
		$novosti = $stmt->fetchAll();
		if(count($novosti) > 0) { 
			$stmt2 = pdo()->prepare('SELECT * FROM korisnici WHERE id = ?');
			$stmt2->execute(array($novosti[0]["korisnik_id"]));
			$ime = $stmt2->fetchAll()[0]["korisnicko_ime"];
?>

			<div class="author white"> <?php echo htmlspecialchars($ime) ?>, <?php echo htmlspecialchars($novosti[0]["datum"]) ?> </div>
			<div class="news white"><?php if (isset($novosti[0]["slika"])) { ?><img src="<?php echo htmlspecialchars($novosti[0]["slika"]) ?>" alt="slika" /><?php } ?><?php echo htmlspecialchars($novosti[0]["tekst"]) ?></div>
			<div class="detalji white"><?php echo htmlspecialchars($novosti[0]["detaljnije"]) ?></div>
			<hr />
			
<?php
			$stmt3 = pdo()->prepare('SELECT * FROM komentari WHERE novost_id = ? ORDER BY datum DESC');
			$stmt3->execute(array($novosti[0]["id"]));
			$komentari = $stmt3->fetchAll();
			
			for($i = 0; $i < count($komentari); $i++) {
?>

				<div class="author white"> <?php echo htmlspecialchars($komentari[$i]["autor"]) ?>, <?php echo htmlspecialchars($komentari[$i]["datum"]) ?> </div>
				<div class="email white"><?php echo htmlspecialchars($komentari[$i]["email"]) ?></div>
				<div class="komentar white"><?php echo htmlspecialchars($komentari[$i]["tekst"]) ?></div>
				<hr />

<?php			
			}
?>

			<div class="white">Ostavi komentar:</div>
			<form method="post" action="detalji.php?nid=<?php echo htmlspecialchars($id) ?>">
				<label class="white" for="ime">Ime: </label><input type="text" id="ime" name="ime" /><br />
				<label class="white" for="email">E-mail: </label><input type="text" id="email" name="email" /><br />
				<label class="white" for="komentar">Komentar: </label><input type="text" id="komentar" name="komentar" /><br />
				<input type="submit" value="Posalji">
			</form>

<?php
		}
	}
?>


</div>

 <div id="dno">
<ul>
	<li> <a href="index.php"> Home</a></li>
	<li> <a href="aboutus.html"> About us</a></li>
	<li> <a href="products.html"> Products</a></li>
	<li> <a href="why.html"> Why should you buy our parfumes?</a></li>
	<li> <a href="friends.html"> Our friends</a></li>
	<li> <a href="ContactUs.html"> Contact us</a></li>	
</ul>
 </div>
	<script src="skripta.js"> </script>



</BODY></HTML>