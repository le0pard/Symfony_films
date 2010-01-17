<table>
	<?php $cinema = ""; ?>
	<?php foreach($afisha as $show):?>
	
		<?php if ($cinema != $show->getAfishaTheater()->getTitle()):?>
			<?php $cinema = $show->getAfishaTheater()->getTitle()?>
			<tr>
				<td colspan="5">
					<h2>
						<a href="<?php echo url_for('afisha_cinema', $show->getAfishaTheater()) ?>">
						<?php echo $cinema;?></a>
					</h2>
				</td>
			</tr>
		<?php endif ?>
		<tr>
			<td>
				<a href="<?php echo url_for('afisha_film', $show->getAfishaFilm()) ?>">
				<?php echo $show->getAfishaFilm()->getTitle()?></a>
			</td>
			<td><?php echo $show->getAfishaZal()->getTitle()?></td>
			<td><?php echo $show->getTimes()?></td>
			<td><?php echo $show->getPrices()?></td>
		</tr>
		
	<?php endforeach?>
</table>