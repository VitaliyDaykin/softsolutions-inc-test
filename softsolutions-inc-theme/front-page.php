<?php

/**
 * Template Name: Home Page
 */

get_header(); ?>

<main class="page">
	<section class="page__main main-section">
		<div class="main-section__container">
			<div  class="main-section__content content-main _anim-items _anim-no-hide">
				<div class="content-main__sup-title">This is the title that is in the header</div>
				<h1 class="content-main__title">Most important thought</h1>
				<div class="content-main__text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris sit amet velit vel erat aliquet porttitor. Mauris a enim non elit cursus tristique quis ut urna.</div>
				<ul class="content-main__list list-main">
					<li class="list-main__item">Here begins some kind of list</li>
					<li class="list-main__item">Several important things</li>
					<li class="list-main__item">But not the most important</li>
				</ul>
				<div class="content-main__links links-main">
					<a href="#" data-popup="#popup" data-popup-youtube="C5zsmPadltw" class="links-main__popup button">Take A Quick Tour</a>
					<?php $page_id = 42 ?>
					<a href="<?php echo get_page_link($page_id); ?>" class="links-main__try button button-shamrock">Try It for Free !</a>
				</div>
			</div>
			<div  class="main-section__images images-main _anim-items _anim-no-hide">
				<div class="images-main__image">
					<picture>
						<img src="<?php echo get_template_directory_uri() ?>/assets/img/011.png" alt="Image" />
					</picture>
				</div>
			</div>
			<div class="content-main__links links-main-mob">
				<a href="#" data-popup="#popup" data-popup-youtube="C5zsmPadltw" class="links-main-mob__popup button">Take A Quick Tour</a>
				<a href="<?php echo get_page_link($page_id); ?>" class="links-main-mob__try button button-shamrock">Try It for Free !</a>
			</div>
		</div>
	</section>
	<section class="page__new-block new-block-section">
		<div class="new-block-section__container">
			<div  class="new-block-section__images images-new-block _anim-items">
				<div class="images-new-block__image">
					<picture>
						<img src="<?php echo get_template_directory_uri() ?>/assets/img/02.png" alt="Image" />
					</picture>
				</div>
			</div>
			<div  class="new-block-section__content content-new-block _anim-items">
				<div class="content-new-block__sup-title">Second awesome section with image and text</div>
				<h2 class="content-new-block__title">We also have a big headline!</h2>
				<div class="content-new-block__text">
					<p>Descriptive copy explaining that we’re here to help answer any questions, and are available to help guide you through the setup, every step of the way.</p>
					<p>Placerat in egestas erat imperdiet. Interdum varius sit amet mattis vulputate enim nulla. Turpis egestas integer eget aliquet nibh. Semper eget duis at tellus at urna condimentum mattis pellentesque. Auctor augue mauris augue neque.</p>
					<p>Tincidunt eget nullam non nisi est sit amet facilisis. Egestas sed sed risus pretium quam.</p>
				</div>

				<div class="content-new-block__links links-new-block">
					<?php $page_id = 42 ?>
					<a href="<?php echo get_page_link($page_id); ?>" class="links-new-block__try button button-shamrock">Start Today!</a>
				</div>
			</div>
		</div>
	</section>
	<section class="page__blog blog-section">
		<div class="blog-section__container">
			<div class="blog-section__header">
				<h2 class="blog-section__title title">Blog</h2>
				<div class="blog-section__button-wrapp">
					<?php $page_id = 42 ?>
					<a href="<?php echo get_page_link($page_id); ?>" class="blog-section__button button">View all</a>
				</div>
			</div>


			<?php
			$mediasArgs = array(
				'post_type' => 'post',
				'posts_per_page' => 6,

			);
			$medias = new WP_Query($mediasArgs); ?>
			<?php if ($medias->have_posts()) : ?>
				<div class="blog-section__items">
					<?php while ($medias->have_posts()) : $medias->the_post(); ?>
						<?php get_template_part('parts/loop-post') ?>
					<?php endwhile; ?>
				</div>
				<?php wp_reset_postdata(); ?>
			<?php endif; ?>



		</div>
	</section>
	<section class="page__contacts contacts-section">
		<div class="contacts-section__container">
			<h2 class="contacts-section__title">Contact Section</h2>
			<div class="contacts-section__sab-title">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris sit amet velit vel erat aliquet porttitor. Mauris a enim non elit cursus tristique quis ut urna.</div>

			<div class="contacts-section__wrapper">
				<div class="contacts-section__map">
					<div id="map" class="contacts-section__map-item">
						<script>
							function initMap() {
								const coordinates = {
									lat: 50.45940444006312,
									lng: 30.39633488415785
								};
								const map = new google.maps.Map(document.getElementById("map"), {
									center: coordinates,
									zoom: 15,
								});
								const marker = new google.maps.Marker({
									position: coordinates,
									map: map,
									icon: {
										url: "<?php echo get_template_directory_uri() ?>/assets/img/maps.png",
									},
								});
							}
						</script>
						<script async src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB2FR0aKU1q-z57fpYVfFPeHq2Ujpl5HPU&callback=initMap"></script>
					</div>
				</div>
				<div class="contacts-section__form form">
					<?php echo do_shortcode('[contact-form-7 id="15" title="Softsolutions"]'); ?>
				</div>
			</div>
		</div>
	</section>
</main>

<?php get_footer(); ?>
