<?php
/* fallback page.php — простой шаблон для остальных страниц */
get_header();
if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	<main class="page">
		<section class="page-content">
			<div class="page__container">
				<h1 class="page__title"><?php the_title(); ?></h1>
				<div class="page__content">
					<?php the_content(); ?>
				</div>
			</div>
		</section>
	</main>
<?php endwhile; endif;
get_footer();