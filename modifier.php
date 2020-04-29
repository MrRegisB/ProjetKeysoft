<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<link   href="css/bootstrap.min.css" rel="stylesheet">
		<script src="js/bootstrap.min.js"></script>
	</head>
	<?php
		include 'database.php';
	 
		$idPdt = null;
		if ( !empty($_GET['idPdt'])) {
			$idPdt = $_REQUEST['idPdt'];
		}
		 
		if ( null==$idPdt ) {
			header("Location: index.php?page=accueil");
		}
		 
		if ( !empty($_POST)) {
			$nomPdtError = null;
			$puhtPdtError = null;
			$descPdtError = null;
			 
			// valeur du form
			$nomPdt = $_POST['nomPdt'];
			$puhtPdt = $_POST['puhtPdt'];
			$idCat = $_POST['idCat'];
			$descPdt = $_POST['descPdt'];
			 
			// vérification
			$valid = true;
			if (empty($nomPdt)) {
				$nomPdtError = 'Saisir un nom';
				$valid = false;
			}
			
			if (empty($puhtPdt)) {
				$puhtPdtError = 'Saisir un prix HT';
				$valid = false;
			}
			
			if (empty($descPdt)) {
				$nomPdtError = 'Saisir une description';
				$valid = false;
			}
			
			// modification
			if ($valid) {
				$pdo = Database::connexion();
				$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				
				//sup toutes les catégories pour pas avoir d'anciennes obsolète
				$sql0 = "DELETE FROM caracteriser WHERE idPdt = ?";
				$req0 = $pdo->prepare($sql0);
				$req0-> execute(array($idPdt));
				
				//modifie le nom prix
				$sql = "UPDATE produit  set nomPdt = ?, puhtPdt = ?, descPdt = ? WHERE idPdt = ?";
				$req = $pdo->prepare($sql);
				$req->execute(array($nomPdt,$puhtPdt,$descPdt,$idPdt));
				
				//inserer dans les caégories
				foreach($_POST['idCat'] as $idCat){
					$sql1= "INSERT INTO caracteriser (idPdt, idCat ) values (?,?)";
					$req1= $pdo->prepare($sql1);
					$req1->execute(array($idPdt, $idCat));
				}
				Database::deconnexion();
				header("Location: index.php?page=accueil");
			}
		} else {
			$pdo = Database::connexion();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "SELECT * FROM produit where idPdt = ?";
			$req = $pdo->prepare($sql);
			$req->execute(array($idPdt));
			$data = $req->fetch(PDO::FETCH_ASSOC);
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
					<h3>Modifier le produit</h3>
				</div>
		 
				<form class="form-horizontal" action="modifier.php?idPdt=<?php echo $idPdt?>" method="post">
				  
					<div class="control-group <?php echo !empty($nomPdtError)?'error':'';?>">
						<label class="control-label">Nom : </label>
						<div class="controls">
							<input name="nomPdt" type="text"  placeholder="Nom" value="<?php echo !empty($nomPdt)?$nomPdt:'';?>">
							<?php if (!empty($nomPdtError)): ?>
								<span class="help-inline"><?php echo $nomPdtError;?></span>
							<?php endif; ?>
						</div>
					</div>
					
					<div class="control-group <?php echo !empty($descPdtError)?'error':'';?>">
						<label class="control-label">Description : </label>
						<div class="controls">
							<input name="descPdt" type="text"  placeholder="Description" value="<?php echo !empty($descPdt)?$descPdt:'';?>">
							<?php if (!empty($descPdtError)): ?>
								<span class="help-inline"><?php echo $descPdtError;?></span>
							<?php endif; ?>
						</div>
					</div>
							  
					<div class="control-group <?php echo !empty($puhtPdtError)?'error':'';?>">
						<label class="control-label">Prix unitaire HT : </label>
						<div class="controls">
							<input name="puhtPdt" type="text" placeholder="Prix HT" value="<?php echo !empty($puhtPdt)?$puhtPdt:'';?>">
							<?php if (!empty($puhtPdtError)): ?>
								<span class="help-inline"><?php echo $puhtPdtError;?></span>
							<?php endif;?>
						</div>
					</div>
							  
					<label class="control-label">Catégorie : </label>
					<div>
						<?php
							$pdo = Database::connexion();
							$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);			
							$req = "SELECT idCat, nomCat
									FROM categorie";
							$stmt = $pdo->query($req);
							while ($ligne = $stmt->fetch(PDO::FETCH_ASSOC)) {
								echo"<input type='checkbox' name='idCat[]' value='".$ligne['idCat']."'/>".$ligne['nomCat']."<br/>";
							}
							Database::deconnexion();				
						?>
					</div>
					<div class="form-actions">
						<button type="submit" class="btn btn-success">Modifier</button> &nbsp;
						<a class="btn btn-danger" href="index.php?page=accueil">Accueil</a>
					</div>
				</form>
			</div>
		</div> 
	</body>
</html>