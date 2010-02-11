<?php use_helper('sfCryptoCaptcha') ?>
<div id="entrance">
	<h1>Регистрация</h1>
	<form id="registration_form" action="<?php echo url_for('@user_registration') ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data"' ?>>
	<div class="form_body">
		<div><?php echo $form['email']->renderLabel(); ?></div>
		<div>
			<?php echo $form['email']->renderError(); ?>
        	<?php echo $form['email']->render(); ?>
			<div class="tip"><?php echo $form['email']->renderHelp(); ?></div>
		</div>
		<div><?php echo $form['login']->renderLabel(); ?></div>
		<div>
			<?php echo $form['login']->renderError(); ?>
        	<?php echo $form['login']->render(); ?>
			<div class="tip"><?php echo $form['login']->renderHelp(); ?></div>
		</div>
		<div><?php echo $form['password']->renderLabel(); ?></div>
		<div>
			<?php echo $form['password']->renderError(); ?>
        	<?php echo $form['password']->render(); ?>
			<div class="tip"><?php echo $form['password']->renderHelp(); ?></div>
		</div>
		<div><?php echo $form['password_confirmation']->renderLabel(); ?></div>
		<div>
			<?php echo $form['password_confirmation']->renderError(); ?>
        	<?php echo $form['password_confirmation']->render(); ?>
			<div class="tip"><?php echo $form['password_confirmation']->renderHelp(); ?></div>
		</div>
		
		<div><?php echo $form['captcha']->renderLabel(); ?></div>
		<div>
		<?php echo $form['captcha']->renderError(); ?>
		<?php echo captcha_image(); echo captcha_reload_button(); ?>
		<?php echo $form['captcha']->render(); ?>
		<div class="tip"><?php echo $form['captcha']->renderHelp(); ?></div>
		</div>
		<div>&nbsp;</div>
		<div>
			<?php echo $form['rights']->renderError(); ?>
			<?php echo $form['rights']->render(); ?> <?php echo $form['rights']->renderLabel(); ?>
		</div>
		<div class="submit">
			<?php if ($form->isCSRFProtected()) : ?> 
		  	  <?php echo $form[$form->getCSRFFieldName()]->render(); ?>
		    <?php endif ?>
			<input  class="big" type="submit" value="Регистрация" />
		</div>
	</div>
	<div class="form_info">
		<h3>Что Вам дает регистрация?</h3>
		<p>
			Регистрация Вам позволит:
			<ul>
				<li>Добавлять собственные фильмы на сайт</li>
				<li>Коментировать фильмы и сериалы, общаться с другими пользователями</li>
				<li>Автоматически Вы получите доступ на Coocoorooza хаб и Jabber</li>
			</ul>
		</p>
		<h3>Email должен быть обязательно рабочим?</h3>
		<p>
			Да. На email после регистрации Вам будет выслано письмо с ссылкой для активации акаунта пользователя. 
			Без этой ссылки Вы не сможете залогинется на сайт под созданым пользователем.
			Так же этот email будет использоватся, если вы вдруг забудете пароль. 
			Email на сайте нигде не публикуется и на него не ведется рассылка спама с нашего ресурса. 
		</p>
	</div>
	</form>
</div>