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

 
 <?php #<div id="glavni"> ?>

<?php 
	require 'baza.php';
	session_start();
	if(isset($_POST['username']) && isset($_POST['password'])) {
		$username = $_POST['username'];
		$password = $_POST['password'];
		$stmt = pdo()->prepare('SELECT * FROM korisnici WHERE korisnicko_ime = ? AND lozinka = ?');
		$stmt->execute(array($username, $password));
		$users = $stmt->fetchAll();
		if(count($users) > 0) {
			$_SESSION['korisnik'] = $users[0]['korisnicko_ime'];
			$_SESSION['korisnik_id'] = $users[0]['id'];
		}
	}
	elseif(isset($_GET['logout'])) { session_destroy(); }
	elseif(isset($_GET['uid']) && isset($_GET['action'])) {
		$uid = $_GET['uid'];
		$action = $_GET['action'];
		if($action == "delete" && $uid != $_SESSION['korisnik_id']) {
			$stmt = pdo()->prepare('DELETE FROM korisnici WHERE id = ? LIMIT 1');
			$stmt->execute(array($uid));
		}
	}
	elseif(isset($_POST['uname']) && isset($_POST['uemail']) && isset($_POST['pwd'])) {
		$stmt = pdo()->prepare('INSERT INTO korisnici (korisnicko_ime, email, lozinka) VALUES (?, ?, ?)');
		$stmt->execute(array($_POST['uname'], $_POST['uemail'], $_POST['pwd']));
	}
	elseif(isset($_GET['kid']) && isset($_GET['action'])) {
		$kid = $_GET['kid'];
		$action = $_GET['action'];
		if($action == "delete") {
			$stmt = pdo()->prepare('DELETE FROM komentari WHERE id = ? LIMIT 1');
			$stmt->execute(array($kid));
		}
	}
	if(!isset($_SESSION['korisnik'])) {
?>
<form action="admin.php" method="post">
<label for="username" class="white">Username: </label><input id="username" name="username" type="text"></input><br />
<label for="password" class="white">Password: </label><input id="password" name="password" type="password"></input><br />
<input type="submit" value="login">
</form>
<?php
	}
	else {
?>
<span class="white">Prijavljeni ste kao <?php echo $_SESSION['korisnik'] ?>. </span><a href="admin.php?logout=true">Logout</a><br />

<h2 class="white">Korisnici:</h2>
<table id="table">
	<thead>
		<tr class="white">
			<td>Username</td><td>Password</td><td>E-mail</td><td>Edit</td><td>Delete</td>
		</tr>
	</thead>
	<tbody>
<?php 
		$stmt = pdo()->query('SELECT * FROM korisnici ORDER BY korisnicko_ime DESC');
		$users = $stmt->fetchAll();
		for($i = 0; $i < count($users); $i++) { 
?>
		<tr class="white">
			<td><?php echo $users[$i]['korisnicko_ime'] ?></td><td><?php echo $users[$i]['lozinka'] ?></td><td><?php echo $users[$i]['email'] ?></td><td><a href="admin.php?uid=<?php echo $users[$i]['id'] ?>&action=edit">Edit</a></td><td><a href="admin.php?uid=<?php echo $users[$i]['id'] ?>&action=delete">Delete</a></td>
		</tr>
<?php
		}
?>
	</tbody>
</table>
		<div class="white">Novi korisnik:</div>
		<form method="post" action="admin.php">
			<label class="white" for="uname">Ime: </label><input type="text" id="uname" name="uname" /><br />
			<label class="white" for="uemail">E-mail: </label><input type="text" id="uemail" name="uemail" /><br />
			<label class="white" for="pwd">Lozinka: </label><input type="password" id="pwd" name="pwd" /><br />
			<input type="submit" value="Dodaj">
		</form>
<?php
	#}
?>

<hr />
<br />
<h3 class="white">Novosti</h3>
<?php
	$stmt = pdo()->query('SELECT * FROM novosti ORDER BY datum DESC');
	$novosti = $stmt->fetchAll();
	for($i = 0; $i < count($novosti); $i++) {
		$stmt2 = pdo()->prepare('SELECT * FROM korisnici WHERE id = ?');
		$stmt2->execute(array($novosti[$i]["korisnik_id"]));
		$ime = $stmt2->fetchAll()[0]["korisnicko_ime"];
			
		$stmt1 = pdo()->prepare('SELECT * FROM komentari WHERE novost_id = ? ORDER BY datum DESC');
		$stmt1->execute(array($novosti[$i]["id"]));
		$komentari = $stmt1->fetchAll();
?>
		<div class="author white"> <?php echo htmlspecialchars($ime) ?>, <?php echo htmlspecialchars($novosti[0]["datum"]) ?> </div>
		<div class="news white"><?php if (isset($novosti[0]["slika"])) { ?><img src="<?php echo htmlspecialchars($novosti[0]["slika"]) ?>" alt="slika" /><?php } ?><?php echo htmlspecialchars($novosti[0]["tekst"]) ?></div>
		<div class="detalji white"><?php echo htmlspecialchars($novosti[0]["detaljnije"]) ?></div>
		<hr />
		<h4 class="white">Komentari:</h4>
<?php
		for($j = 0; $j < count($komentari); $j++) {
?>	
			<div class="author white"> <?php echo htmlspecialchars($komentari[$j]["autor"]) ?>, <?php echo htmlspecialchars($komentari[$j]["datum"]) ?> </div>
			<div class="email white"><?php echo htmlspecialchars($komentari[$j]["email"]) ?></div>
			<div class="komentar white"><?php echo htmlspecialchars($komentari[$j]["tekst"]) ?></div>
			<a href="admin.php?kid=<?php echo htmlspecialchars($komentari[$j]["id"]) ?>&action=delete">Obriši komentar</a>
			<hr />
<?php		
		}
		?> <br /><hr /> <?php
	}
	}
?>
<?php #</div> ?>

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