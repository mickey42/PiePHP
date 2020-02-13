<div id="body-content">
	<h2>~ Mes films vue ~</h2>

	
	<table class="table table-responsive">
		<thead>
			<tr>
				<th>TITRE</th>
				<th>GENRE</th>
				<th>DISTRIBUTEUR</th>
                <th>DATE DE VISONAGE</th>
				<th>HISTORIQUE</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($movies as $movie) { ?>
				<tr>
		    		<td><?php echo '<a href="show/' . $movie['id_film'] . '">' . $movie['titre']; ?></a></td>
			    	<td><?php echo $movie['genre']; ?></td>
					<td><?php echo $movie['distrib']; ?></td>
                    <td><?php echo $movie['date_vue']; ?></td>
					<td><a class = 'col-md-6' href="/PiePHP/index.php/film/delhsitorique/<?php echo $movie['id_film']; ?>"><span class = "glyphicon glyphicon-minus"></span></a></td>   
		   		</tr>
				<?php } ?>
		</tbody>
	</table>
</div>
<div class="lapage"></div>