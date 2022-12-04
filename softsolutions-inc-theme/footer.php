<footer class="footer">
	<div class="footer__container">
		<div class="footer__info-counter info-counter">
			<div class="info-counter__info">
				<a href="" class="info-counter__logo">
					<picture>
						<img src="<?php echo get_template_directory_uri() ?>/assets/img/logo-footer.png" alt="logo" />
					</picture>
				</a>
				<div class="info-counter__text">
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean eget sollicitudin odio, ut egestas dolor. Cras pretium enim diam. Duis ligula tortor, tincidunt vel eleifend ut.</p>
				</div>
			</div>
			<div class="info-counter__counter counter">
				<div class="counter__header">
					<h5 class="counter__title">
						Visitor Counter
						<a href="" class="counter__bonus-btn">bonus</a>
					</h5>
					<div class="counter__image">
						<picture>
							<img src="<?php echo get_template_directory_uri() ?>/assets/img/counter.jpg" alt="Counter" />
						</picture>
					</div>
				</div>
				<ul class="counter__icon-list icon-list">
					<li class="icon-list__item _icon-visit_today">Visit Today: 1</li>
					<li class="icon-list__item _icon-total_visit">Total Visit: 1</li>
					<li class="icon-list__item _icon-hits_today">Hits Today: 1</li>
					<li class="icon-list__item _icon-total_hits">Total Hits: 1</li>
					<li class="icon-list__item _icon-whos_online">Who’s Online: 1</li>
				</ul>
			</div>
		</div>
		<div class="footer__menu-copyright menu-copyright">
			<nav class="menu-copyright__menu">
				<?php
				wp_nav_menu([
					'theme_location' => 'footer_menu',
					'container'  => false,
					'items_wrap' => '<ul class="%2$s">%3$s</ul>',
					'menu_class' => 'menu-copyright__list'

				]);
				?>
			</nav>
			<div class="menu-copyright__copyright">
				<p>Copyright © 2021. All Rights Reserved</p>
			</div>
		</div>
	</div>
</footer>

</div>
<div id="popup" aria-hidden="true" class="popup">
	<div class="popup__wrapper">
		<div class="popup__content">
			<button data-close type="button" class="popup__close">X</button>
			<div data-popup-youtube-place class="popup__video"></div>
		</div>
	</div>
</div>

<?php wp_footer(); ?>
</body>

</html>
