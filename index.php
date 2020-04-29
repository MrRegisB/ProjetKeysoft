<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<link   href="css/bootstrap.css" rel="stylesheet">
		<script src="js/bootstrap.min.js"></script>
	</head>
	<?php
		session_start();
		if (isset ($_SESSION['IdUser']) ) {	
			
		}
		else {
			header("location:login.php");
		}
	?>
	<body>
		<!--entête-->
		<header class='ind'>
			<div class='ind'>
				<img src='img/kysoft.png'/>
			</div>
			<nav class='ind'>
				<p>
					<a class="btn btn-success" href="index.php?page=accueil"> Accueil </a>&nbsp;
					<a class="btn btn-danger" href="deconnexion.php"> Déconnexion </a>&nbsp; 
				</p>
			</nav>
		</header>
		
		<div>
			<section>
				<?php
				if (isset($_GET["page"])){
					switch($_GET["page"]){
						case "accueil";
							include("accueil.php"); 
						break;
						case "consulter";
							include("consulter.php");
						break;
						case "ajouter";
							include("ajouter.php"); 
						break;
						case "modifier";
							include("modifier.php"); 
						break;
						case "supprimer";
							include("supprimer.php"); 
						break;
						case "filtrer";
							include("filtrer.php"); 
						break;
					}
				}
				else{
					include("accueil.php"); 
				}
				?>
			</section>
		</div>
	</body>
</html>