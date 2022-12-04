<?php

/**
 * Home
 *
 * Standard loop for the blog-page
 */
get_header(); ?>

<main class="page">
	<section class="blog-section blog-section_page">
		<div class="blog-section__container">
			<h1 class="blog-section__title blog-section__title_page title">Blog Page</h1>
			<?php if (have_posts()) : ?>
				<div class="blog-section__items">

					<?php while (have_posts()) : the_post(); ?>

						<?php get_template_part('parts/loop', 'post'); ?>


					<?php endwhile; ?>

				</div>
			<?php endif; ?>
			<?php my_pagenavi(); ?>
		</div>
	</section>
</main>
<?php get_footer(); ?>
