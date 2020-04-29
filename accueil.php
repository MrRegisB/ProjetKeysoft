<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<link   href="css/bootstrap.min.css" rel="stylesheet">
		<script src="js/bootstrap.min.js"></script>
	</head>
	 
	<body>
		<div class="container">
			<div class="row">
				<h3>Accueil</h3>
			</div>
			<div class="row">
				<h5>Filtrer: </h5>
				<p>
					<?php
						include 'database.php';
						$pdo = Database::connexion();
						$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);			
						$req = "SELECT idCat, nomCat
							FROM categorie";
						$stmt = $pdo->query($req);
						while ($ligne = $stmt->fetch(PDO::FETCH_ASSOC)) {
							echo'<a class="btn btn-link" href="index.php?page=filtrer&amp;idCat='.$ligne['idCat'].'">'.$ligne['nomCat'].'</a>&nbsp';
						}
						Database::deconnexion();
					?>
				</p>
			</div>
			<div class="row">
				<p>
					<?php
						if (($_SESSION['IdUser']) == 'admin'){
							echo '<a href="index.php?page=ajouter" class="btn btn-success">Ajouter un produit</a>&nbsp'; 
						}
					?>
				</p>
				
				<table class="table table-striped table-bordered">
					<thead>
						<tr>
							<th>N°</th>
							<th>Nom</th>
							<th>Description</th>
							<th>Prix HT</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
					<?php
						
						$pdo = Database::connexion();
						$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
						$sql = 'SELECT * FROM produit';
						foreach ($pdo->query($sql) as $row) {
							echo '<tr>';
								echo '<td>'. $row['idPdt'] . '</td>';
								echo '<td>'. $row['nomPdt'] . '</td>';
								echo '<td>'. $row['descPdt'] . '</td>';
								echo '<td>'. $row['puhtPdt'] . '$</td>';
								echo '<td width=315>';
									echo '<a class="btn btn-success" href="index.php?page=consulter&amp;idPdt='.$row['idPdt'].'">Consulter</a>';
									echo ' ';
									if (($_SESSION['IdUser']) == 'admin'){
										echo '<a class="btn btn-success" href="index.php?page=modifier&amp;idPdt='.$row['idPdt'].'">Modifier</a>';
										echo ' ';
										echo '<a class="btn btn-danger" href="index.php?page=supprimer&amp;idPdt='.$row['idPdt'].'">Supprimer</a>';
									}
								echo '</td>';
							echo '</tr>';
						}
						$pdo = Database::deconnexion();
					?>
					</tbody>
				</table>
			</div>
		</div>
	</body>
</html>