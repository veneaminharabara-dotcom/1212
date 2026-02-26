<?php
/* single.php — шаблон для отдельной новости (использовать контент из post.html) */
get_header();
if ( have_posts() ) : while ( have_posts() ) : the_post();
?>
<main class="page">
	<section class="post">
		<div class="post__container">
			<div class="post__top">
				<div class="post__image-bg">
					<?php if ( has_post_thumbnail() ) {
						the_post_thumbnail( 'full' );
					} else { ?>
						<img src="<?php broker_asset( 'img/news/post.jpg' ); ?>" alt="">
					<?php } ?>
				</div>
				<a href="<?php echo esc_url( home_url( '/news' ) ); ?>" class="post__link-back">Назад к новостям <img src="<?php broker_asset( 'img/icons/arrow-link.svg' ); ?>" alt="Иконка"></a>
				<h1 class="post__title title title--white"><?php the_title(); ?></h1>
			</div>
			<div class="post__body">
				<?php the_content(); ?>
			</div>
		</div>
	</section>
</main>
<?php
endwhile; endif;
get_footer();