<section class="hello">
	<div class="hello__container _container">
		<div class="hello__content">
			<h1 class="hello__title title _anim-items _anim-no-hide">
				<?php the_field('about_title'); ?> <p><?php the_field('about_title_span'); ?></p>
			</h1>
			<div class="hello__text text _anim-items _anim-no-hide">
				<?php the_field('about_text'); ?>
			</div>
            <div class="hello__info info _anim-items _anim-no-hide">
                <a href="" class="info__tel _icon-phone">12345678</a>
                <a href="" class="info__telegram _icon-telegram">12345678</a>
            </div>
			<?php
			$link = get_field('about_button');
			if ($link) :
				$link_url = $link['url'];
				$link_title = $link['title'];
				$link_target = $link['target'] ? $link['target'] : '_self';
			?>
				<a class="hello_btn btn" href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>">

					<?php echo esc_html($link_title); ?>
				</a>
			<?php endif; ?>
		</div>
		<div class="hello__avatar _anim-items">
			<?php $img_id = get_field('about_image');
			echo wp_get_attachment_image($img_id, 'avatar')
			?>
		</div>
	</div>
</section>
