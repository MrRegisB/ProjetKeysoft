<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<link   href="css/bootstrap.min.css" rel="stylesheet">
		<script src="js/bootstrap.min.js"></script>
	</head>
	<?php
		include 'database.php';
	 
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
			 
			// création dans la db
			if ($valid) {
				$pdo = Database::connexion();
				$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				
				$sql = "INSERT INTO produit (nomPdt, puhtPdt, descPdt) values(?, ?, ?)";
				$req = $pdo->prepare($sql);
				$req->execute(array($nomPdt,$puhtPdt,$descPdt));
				
				foreach($_POST['idCat'] as $idCat){
					$sql1= "INSERT INTO caracteriser (idCat) values (?)";
					$req1= $pdo->prepare($sql1);
					$req1->execute(array($idCat));
				}
				Database::deconnexion();
				header("Location: index.php?page=accueil");
			}
		}
	?>
	<body>
		<div class="container">
			<div class="span10 offset1">
				<div class="row">
					<h3>Ajouter un produit</h3>
				</div>
				<form class="form-horizontal" action="ajouter.php" method="post">
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
						<button type="submit" class="btn btn-success">Ajouter</button> &nbsp;
						<a class="btn btn-danger" href="index.php?page=accueil">Accueil</a>
					</div>
				</form>
			</div>
		</div>
	</body>
</html>