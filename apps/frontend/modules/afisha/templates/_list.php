<?php $cinema = ""; ?>
<?php foreach($afisha as $show):?>

	<?php if ($cinema != $show->getAfishaTheater()->getTitle()):?>
		<?php if ($cinema != ""):?>
				</tbody>
            	</table>
			</div>
		<?php endif?>
		
		<?php $cinema = $show->getAfishaTheater()->getTitle()?>
		<div class="affiche_data">
        <h1 class="label"><?php echo $cinema;?></h1> <div class="all"><a href="<?php echo url_for('afisha_cinema', $show->getAfishaTheater()) ?>">все сеансы в кинотеатре</a><br />тел. <?php echo $show->getAfishaTheater()->getPhone()?></div>
        <table>
        	<thead>
        	<tr>
        		<th>Фильм</th>
        		<th>Зал</th>
        		<th>Время</th>
        		<th>Цена</th>
        	</tr>
			</thead>
			<tbody>
	<?php endif ?>
		<tr>
			<td><a href="<?php echo url_for('afisha_film', $show->getAfishaFilm()) ?>"><?php echo $show->getAfishaFilm()->getTitle()?></a></td>
			<td><?php echo $show->getAfishaZal()->getTitle()?></td>
			<td><?php echo $show->getTimes()?></td>
			<td><?php echo $show->getPrices()?></td>
		</tr>
<?php endforeach?>
	<?php if ($cinema != ""):?>
			</tbody>
            </table>
		</div>
	<?php endif?>