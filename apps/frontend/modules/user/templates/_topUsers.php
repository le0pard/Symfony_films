<div>
<table>
	<tr>
		<th>Ник</th>
		<th>Опубликовал</th>
	</tr>
	<?php foreach($users as $key=>$row): ?>
		<tr>
			<td><?php echo $row->getLogin(); ?></td>
			<td><?php echo $row->getCountOfFilms(); ?></td>
		</tr>
	<?php endforeach ?>
</table>
</div>
<div class="clear"></div>