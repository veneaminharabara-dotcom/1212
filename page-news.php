<?php
/* Template: Новости (news.html) — slug: news
   Я сделал страницу, которая выводит обычные записи WP (post). Для полного соответствия
   можно использовать стандартную запись WP как "новость". */
get_header();
?>
<main class="page">
	<section class="news">
		<div class="news__container">
			<h1 class="news__title title">новости</h1>

			<div class="news__body">
				<?php
				// Loop: используем WP loop — если нужно, наполняй админкой записи (Posts)
				$args = array(
					'post_type' => 'post',
					'posts_per_page' => 8,
				);
				$news = new WP_Query( $args );
				if ( $news->have_posts() ) :
					while ( $news->have_posts() ) : $news->the_post(); ?>
						<div class="news__item item-news">
							<a href="<?php the_permalink(); ?>" class="item-news__image">
								<?php if ( has_post_thumbnail() ) {
									the_post_thumbnail( 'full' );
								} else { ?>
									<img src="<?php broker_asset( 'img/news/01.jpg' ); ?>" alt="<?php the_title_attribute(); ?>">
								<?php } ?>
							</a>
							<div class="item-news__body">
								<span class="item-news__date"><?php echo get_the_date( 'd.m.Y' ); ?></span>
								<a href="<?php the_permalink(); ?>" class="item-news__title-link">
									<h3 class="item-news__link-title"><?php the_title(); ?></h3>
								</a>
								<p class="item-news__text"><?php echo wp_trim_words( get_the_excerpt(), 20 ); ?></p>
								<a href="<?php the_permalink(); ?>" class="item-news__link btn">Подробнее</a>
							</div>
						</div>
					<?php
					endwhile;
					wp_reset_postdata();
				else :
					?>
					<p>Новостей пока нет.</p>
				<?php endif; ?>
			</div>

			<div class="news__pagination pagination">
				<!-- можно подключить пагинацию WP -->
				<?php
				// простая пагинация
				the_posts_pagination( array(
					'prev_text'          => __('«'),
					'next_text'          => __('»'),
					'screen_reader_text' => ' ',
				) );
				?>
			</div>
		</div>
	</section>
</main>
<?php get_footer(); ?>