<?php if ($trailer):?>
	<?php use_helper('Trailer') ?>
	
	<?php if ($trailer->getTrailerType() == 1):?>
	<!-- Youtube video -->
	<object width="445" height="364">
		<param name="movie" value="http://www.youtube-nocookie.com/v/<?php echo $trailer->getTrailerCode() ?>&hl=ru_RU&fs=1&border=1"></param>
		<param name="allowFullScreen" value="true"></param>
		<param name="allowscriptaccess" value="always"></param>
		<embed src="http://www.youtube-nocookie.com/v/<?php echo $trailer->getTrailerCode() ?>&hl=ru_RU&fs=1&border=1" type="application/x-shockwave-flash" 
				allowscriptaccess="always" allowfullscreen="true" width="445" height="364"></embed>
	</object><br />
	<?php elseif($trailer->getTrailerType() == 2):?>
	<!-- Vimeo video -->
	<object width="445" height="364">
		<param name="allowfullscreen" value="true" />
		<param name="allowscriptaccess" value="always" />
		<param name="movie" value="http://vimeo.com/moogaloop.swf?clip_id=<?php echo $trailer->getTrailerCode() ?>&amp;server=vimeo.com&amp;show_title=0&amp;show_byline=0&amp;show_portrait=0&amp;color=ffffff&amp;fullscreen=1" />
		<embed src="http://vimeo.com/moogaloop.swf?clip_id=<?php echo $trailer->getTrailerCode() ?>&amp;server=vimeo.com&amp;show_title=0&amp;show_byline=0&amp;show_portrait=0&amp;color=ffffff&amp;fullscreen=1" 
			type="application/x-shockwave-flash" allowfullscreen="true" allowscriptaccess="always" width="445" height="364"></embed>
	</object><br />
	<?php elseif($trailer->getTrailerType() == 3):?>
	<!-- Rutube video -->
	<OBJECT width="445" height="364">
		<PARAM name="movie" value="http://video.rutube.ru/<?php echo $trailer->getTrailerCode() ?>"></PARAM>
		<PARAM name="wmode" value="window"></PARAM>
		<PARAM name="allowFullScreen" value="true"></PARAM>
		<EMBED src="http://video.rutube.ru/<?php echo $trailer->getTrailerCode() ?>" type="application/x-shockwave-flash" 
			wmode="window" width="445" height="364" allowFullScreen="true" ></EMBED>
	</OBJECT><br />
	<?php endif ?>
	<?php echo preview_trailer_link($trailer) ?><br />
<?php endif ?>