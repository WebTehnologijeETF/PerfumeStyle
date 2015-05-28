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

 
 <div id="glavni">
 
 <div id="vijest"> 
 <?php
	require 'novost.php';
	require 'komentar.php';
	$n = new Novost();
	$novosti = $n->nadji_sve();
	
	for($i = 0; $i < count($novosti); $i++) {
		$stmt = pdo()->prepare('SELECT * FROM korisnici WHERE id = ?');

		$stmt->execute(array($novosti[$i]["korisnik_id"]));


		$ime = $stmt->fetchAll()[0]["korisnicko_ime"];
 ?>

 
	<div class="author" > <?php echo htmlspecialchars($ime) ?>, <?php echo htmlspecialchars($novosti[$i]["datum"]) ?> </div>
 <div class="news"><img src="<?php echo htmlspecialchars($novosti[$i]["slika"]) ?>" alt="slika" /><?php echo htmlspecialchars($novosti[$i]["tekst"]) ?> <?php if (isset($novosti[0]["detaljnije"])) { ?><a  href="detalji.php?nid=<?php echo htmlspecialchars($novosti[$i]["id"]) ?>">Learn more...</a><?php } ?></div>
 
 <?php 
	}
 ?>
 <?php /*<div class="author" >Hamdo Hadzic,29.03.2015 19:00 </div>
 <div class="news"> <img src="images/2.gif" alt="slika" />
 Perfume or parfum is a mixture of fragrant essential
 oils or aroma compounds, fixatives and solvents used to give the
 human body, animals, food, objects, and living spaces "a pleasant scent."[1]
Perfumes have been known to exist in some of the earliest human civilizations,
 either through ancient texts or from archaeological digs. Modern perfumery began
 in the late 19th century with the commercial synthesis of aroma compounds such as 
 vanillin or coumarin, which allowed for the composition of perfumes with smells previously 
 unattainable solely from natural aromatics alone. <a  href="index.php">Learn more...</a></div>*/ ?>
 
 
 </div>
 
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
 <div>
 </div>
	<script src="skripta.js"> </script>



</BODY></HTML>
