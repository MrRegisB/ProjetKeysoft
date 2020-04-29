<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<link   href="css/bootstrap.min.css" rel="stylesheet">
		<script src="js/bootstrap.min.js"></script>
	</head>
	<?php
		include 'database.php';
		$idPdt = 0;
		 
		if ( !empty($_GET['idPdt'])) {
			$idPdt = $_REQUEST['idPdt'];
		}
		 
		if ( !empty($_POST)) {
			$idPdt = $_POST['idPdt'];
			 
			// supprimler
			$pdo = Database::connexion();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "DELETE FROM produit  WHERE idPdt = ?";
			$req = $pdo->prepare($sql);
			$req->execute(array($idPdt));
			$sql1 = "DELETE FROM caracteriser  WHERE idPdt = ?";
			$req1 = $pdo->prepare($sql1);
			$req1->execute(array($idPdt));
			Database::deconnexion();
			header("Location: index.php?page=accueil");
			 
		}
	?>
	<body>
		<div class="container">
			<div class="span10 offset1">
				<div class="row">
					<h3>Supprimer un produit</h3>
				</div> 
				<form class="form-horizontal" action="supprimer.php" method="post">
					<input type="hidden" name="idPdt" value="<?php echo $idPdt;?>"/>
					<p class="alert alert-error">Supprimer le produit ?</p>
					<div class="form-actions">
						<button type="submit" class="btn btn-danger">Oui</button>&nbsp;
						<a class="btn" href="index.php?page=accueil">Annuler</a>
					</div>
				</form>
			</div>
		</div>
	</body>
</html>