<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<link   href="css/bootstrap.min.css" rel="stylesheet">
		<script src="js/bootstrap.min.js"></script>
	</head>
	<?php
		include 'database.php';
	    $idPdt == null;
		if ( !empty($_GET['idPdt'])){
			$idPdt = $_REQUEST['idPdt'];
		}
		 
		if ( null==$idPdt ) {
			header("Location: index.php?page=accueil");
		}
		else {
	        $pdo = Database::connexion();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	        $sql = "SELECT * FROM produit where idPdt = ?";
	        $req = $pdo->prepare($sql);
	        $req->execute(array($idPdt));
	        $data = $req->fetch(PDO::FETCH_ASSOC);
			$idPdt = $data['idPdt'];
			$nomPdt = $data['nomPdt'];
			$puhtPdt = $data['puhtPdt'];
			$descPdt = $data['descPdt'];
	        Database::deconnexion();
	    }
	?>
	<body>
		<div class="container">
			<div class="span10 offset1">
				<div class="row">
					<h3>Consulter</h3>
				</div>
				<div class="form-horizontal" >
					<div class="control-group">
						<label class="control-label">Nom : </label>
						<div class="controls">
							<label class="checkbox">
								<?php echo $data['nomPdt'];?>
							</label>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label">Prix HT : </label>
						<div class="controls">
							<label class="checkbox">
								<?php echo $data['puhtPdt'];?>
							</label>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label">Description : </label>
						<div class="controls">
							<label class="checkbox">
								<?php echo $data['descPdt'];?>
							</label>
						</div>
					</div>                      
				</div>
			</div>
		</div>
	</body>
</html>