<?php get_header(); ?>

<main class="page">
	<div class="page__container">

		<?php if (have_posts()) : ?>
			<?php while (have_posts()) : the_post(); ?>

			<?php endwhile; ?>
		<?php endif; ?>

	</div>
</main>

<?php get_footer(); ?>
