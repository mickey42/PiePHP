<div id="body-content">
	<h2>~ Tous les genres ~</h2>
	<form method="POST">
		<input type="text" name="add">
		<button type="submit" class="btn delete-btn">Ajouter un genre</button>
	</form>
	<ul class="genre-li">
	<?php foreach ($genres as $genre) { ?>
			<li class="genre-list">
				<?php echo ucfirst($genre['nom']); ?>
			
				
				<form method="POST">
					<input type="hidden" name="id" value=<?php echo "\"" . $genre['id_genre'] . "\""; ?>>
					<input type="text" name="nom" value=<?php echo "\"" . $genre['nom'] . "\""; ?>>
					<button type="submit" class="btn delete-btn">Modifier</button>
				</form>
				<form method="POST">
					<input type="hidden" name="delete" value=<?php echo "\"" . $genre['id_genre'] . "\""; ?>>
					<button type="submit" class="btn delete-btn">Supprimer</button>
				</form>
			</li>
	<?php } ?>
	</ul>
</div>