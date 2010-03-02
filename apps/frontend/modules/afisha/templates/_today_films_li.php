<?php if (isset($afisha_films)):?>
	<?php foreach($afisha_films as $key=>$row): ?>
	<li>
		<a href="<?php echo url_for('afisha_film', $row) ?>">
			<?php echo $row->getTitle() ?>
		</a>
	</li>
	<?php endforeach ?>
<?php endif ?>