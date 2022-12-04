<section class="recent-posts">
	<div class="recent-posts__container _container">
		<div class="recent-posts__header">
			<div class="recent-posts__title title-posts">
				<?php the_field('rec_title'); ?>
			</div>
			<?php
			$link = get_field('rec_button');
			if ($link) :
				$link_url = $link['url'];
				$link_title = $link['title'];
				$link_target = $link['target'] ? $link['target'] : '_self';
			?>
				<a class="recent-posts__view-all" href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>">

					<?php echo esc_html($link_title); ?>
				</a>
			<?php endif; ?>
		</div>
		<div class="recent-posts__items">

			<?php
			$recentArgs = array(
				'post_type' => 'post',
				'posts_per_page' => 2,
				'grderby' => '',
				'order' => '',

			);
			$recent = new WP_Query($recentArgs); ?>
			<?php if ($recent->have_posts()) : ?>
				<?php while ($recent->have_posts()) : $recent->the_post(); ?>

					<div class="recent-posts__column">
						<article class="recent-posts__item recent-post">
							<a href="<?php the_permalink() ?>" class="recent-post__title">
								<?php the_title(); ?>
							</a>
							<div class="recent-post__info">
								<time atetime="<?php echo get_the_date('Y-m-d') ?>">
									<?php echo get_the_date() ?>
								</time>
								<span>|</span>
								<?php the_category(', '); ?>
							</div>
							<div class=" recent-post__text text">
								<?php do_excerpt(get_the_content(), 25); ?>
							</div>
						</article>
					</div>

				<?php endwhile; ?>
				<?php wp_reset_postdata(); ?>
			<?php endif; ?>



		</div>
	</div>
</section>
