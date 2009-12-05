<entry>
    <title><?php echo $film->getTitle(); ?></title>
    <link href="<?php echo url_for('film_show', $film, true) ?>" />
    <id><?php echo sha1($film->getId()) ?></id>
    <updated><?php echo strftime('%Y-%m-%dT%H:%M:%SZ', $film->getUpdatedAt('U')) ?></updated>
    <summary><![CDATA[<?php echo $film->getAbout() ?>]]></summary>
    <author>
    	<name>
    		<?php if ($film->getUsersRelatedByUserId()): ?>
				<a href="<?php echo url_for('user_show', $film->getUsersRelatedByUserId()) ?>">
					<?php echo $film->getUsersRelatedByUserId()->getLogin() ?>
				</a>
			<?php else: ?>
				Неизвестен	
			<?php endif ?>
		</name>
	</author>
</entry>