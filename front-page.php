<?php
// front-page.php — main page with dynamic latest blocks
get_header();
?>
<main class="page">
  <?php
  // Hero + static blocks copied from your index.html (use same classes)
  ?>
  <section class="hero">
		<div class="hero__container">
			<div class="hero__left">
				<h1 class="hero__title">Проверь брокера прямо сейчас</h1>
				<div class="hero__left-body left-body-hero">
					<div class="left-body-hero__white-block"></div>
					<div class="left-body-hero__black-block"></div>
					<div class="left-body-hero__content">
						<h2 class="left-body-hero__title">Введите название компании и узнайте её статус</h2>
						<form action="#" class="left-body-hero__form">
							<input autocomplete="off" type="text" name="form[]" data-error="Ошибка" placeholder="Поиск" class="left-body-hero__input">
							<button type="submit" class="left-body-hero__button"><img src="<?php echo esc_url( get_template_directory_uri() . '/img/icons/search.svg' ); ?>" alt="Иконка поиска"></button>
						</form>
					</div>
					<div class="left-body-hero__images">
						<div class="left-body-hero__image">
							<picture><source srcset="<?php echo esc_url( get_template_directory_uri() . '/img/hero/01.webp' ); ?>" type="image/webp"><img src="<?php echo esc_url( get_template_directory_uri() . '/img/hero/01.jpg' ); ?>" alt="Картинка"></picture>
						</div>
						<div class="left-body-hero__image">
							<picture><source srcset="<?php echo esc_url( get_template_directory_uri() . '/img/hero/02.webp' ); ?>" type="image/webp"><img src="<?php echo esc_url( get_template_directory_uri() . '/img/hero/02.jpg' ); ?>" alt="Картинка"></picture>
						</div>
					</div>
				</div>
				<svg class="hero__decor" width="1220" height="683" viewBox="0 0 1220 683" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M0 21C0 9.40204 9.40202 2.7713e-05 21 2.7713e-05H1034C1045.6 2.7713e-05 1055 9.40205 1055 21V288.396C1055 299.994 1064.4 309.396 1076 309.396H1199C1210.6 309.396 1220 318.798 1220 330.396V662C1220 673.598 1210.6 683 1199 683H21C9.40201 683 0 673.598 0 662V21Z" fill="#222222" />
				</svg>
			</div>
			<div class="hero__right">
				<div class="hero__right-image hero__right-image--1">
					<picture><source srcset="<?php echo esc_url( get_template_directory_uri() . '/img/hero/image-pc.webp' ); ?>" type="image/webp"><img src="<?php echo esc_url( get_template_directory_uri() . '/img/hero/image-pc.png' ); ?>" alt="Картинка"></picture>
				</div>
				<div class="hero__right-image hero__right-image--2">
					<picture><source srcset="<?php echo esc_url( get_template_directory_uri() . '/img/hero/image-mob.webp' ); ?>" type="image/webp"><img src="<?php echo esc_url( get_template_directory_uri() . '/img/hero/image-mob.png' ); ?>" alt="Картинка"></picture>
				</div>
			</div>
		</div>
	</section>... <!-- copy hero HTML from earlier template (omitted here to keep message shorter) --> </section>
<section class="facts">
    <div class="facts__container">
        <h2 class="facts__title title">факты недели</h2>
        <div class="facts__body">
            <div class="facts__left">
                <picture><source srcset="<?php echo get_template_directory_uri(); ?>/img/facts/01.webp" type="image/webp"><img src="<?php echo get_template_directory_uri(); ?>/img/facts/01.jpg" alt="Картинка"></picture>
            </div>
            <div class="facts__right">
                <?php
                // Параметры: считаем за последние 7 дней
                $days = 7;
                $count_reviews = bc_count_recent_comments( $days );
                $count_black = bc_count_blacklisted_brokers();
                $count_complaints = bc_count_recent_complaints( $days );
                $count_news = bc_count_recent_news( $days );
                ?>
                <div class="facts__block block-facts block-facts--1">
                    <div class="block-facts__top">
                        <span class="block-facts__number"><?php echo bc_format_count( $count_reviews ); ?></span>
                        <p class="block-facts__info">новых отзывов </p>
                    </div>
                    <a href="<?php echo esc_url( get_post_type_archive_link('bc_news') ? get_post_type_archive_link('bc_news') : '/news/' ); ?>" class="block-facts__link">
                        <img src="<?php echo get_template_directory_uri(); ?>/img/icons/arrow-white.svg" alt="Иконка">
                    </a>
                </div>

                <div class="facts__block block-facts block-facts--2">
                    <div class="block-facts__top">
                        <span class="block-facts__number"><?php echo bc_format_count( $count_black ); ?></span>
                        <p class="block-facts__info">брокера в чёрный список</p>
                    </div>
                    <a href="<?php echo esc_url( home_url('/black-broker/') ); ?>" class="block-facts__link">
                        <img src="<?php echo get_template_directory_uri(); ?>/img/icons/arrow-white.svg" alt="Иконка">
                    </a>
                </div>

                <div class="facts__block block-facts block-facts--image">
                    <img src="<?php echo get_template_directory_uri(); ?>/img/facts/02.jpg" alt="Картинка">
                </div>

                <div class="facts__block block-facts block-facts--orange">
                    <div class="block-facts__top">
                        <span class="block-facts__number"><?php echo bc_format_count( $count_complaints ); ?></span>
                        <p class="block-facts__info">новых жалоб</p>
                    </div>
                    <a href="<?php echo esc_url( home_url('/complaints/') ); ?>" class="block-facts__link block-facts__link--white">
                        <img src="<?php echo get_template_directory_uri(); ?>/img/icons/arrow-black.svg" alt="Иконка">
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
  <!-- Latest news (dynamic) -->
  <section class="last-news">
    <div class="last-news__container">
      <div class="last-news__body">
        <div class="last-news__left left-last-news">
          <h2 class="left-last-news__title title title--white">Последние новости</h2>
          <a href="<?php echo esc_url( get_post_type_archive_link('bc_news') ? get_post_type_archive_link('bc_news') : '/news/' ); ?>" class="left-last-news__link btn">Все новости</a>
        </div>

        <div class="last-news__slider swiper">
          <div class="last-news__wrapper swiper-wrapper">
            <?php
            // Query latest news (bc_news)
            $news = new WP_Query( array( 'post_type'=>'bc_news', 'posts_per_page'=>4 ) );
            if ( $news->have_posts() ) {
              while ( $news->have_posts() ) { $news->the_post();
                $thumb = get_the_post_thumbnail_url( get_the_ID(), 'medium' ) ?: get_template_directory_uri().'/img/last-news/01.jpg';
                ?>
                <div class="last-news__slide slide-last-news swiper-slide">
                  <div class="slide-last-news__image"><img src="<?php echo esc_url($thumb); ?>" alt=""></div>
                  <div class="slide-last-news__body">
                    <span class="slide-last-news__date"><?php echo get_the_date('d.m.Y'); ?></span>
                    <a href="<?php the_permalink(); ?>" class="slide-last-news__link-title"><h3 class="slide-last-news__title-link"><?php the_title(); ?></h3></a>
                    <p class="slide-last-news__text"><?php echo wp_trim_words( get_the_excerpt(), 20 ); ?></p>
                    <a href="<?php the_permalink(); ?>" class="slide-last-news__link">Подробнее</a>
                  </div>
                </div>
                <?php
              }
              wp_reset_postdata();
            } else {
              // fallback static slides if no news
            }
            ?>
          </div>
          <div class="last-news__swiper-pagination"></div>
        </div>
        <button type="button" class="last-news__swiper-button-next"></button>
      </div>
    </div>
  </section>

  <!-- Latest brokers (dynamic) -->
  <section class="search-broker">
    <div class="search-broker__container">
      <h2 class="search-broker__title title">Последние обзоры</h2>
      <div class="search-broker__brokers brokers">
        <?php
        $brokers = new WP_Query( array( 'post_type'=>'broker', 'posts_per_page'=>6 ) );
        if ( $brokers->have_posts() ) {
          while ( $brokers->have_posts() ) { $brokers->the_post();
            $rating = get_post_meta( get_the_ID(), '_bc_rating', true ) ?: 0;
            ?>
            <div class="brokers__block">
              <a href="<?php the_permalink(); ?>" class="brokers__left">
                <span class="brokers__logo"><?php if ( has_post_thumbnail() ) the_post_thumbnail('thumbnail'); ?></span>
                <h3 class="brokers__name"><?php the_title(); ?></h3>
              </a>
              <div class="brokers__content">
                <p class="brokers__status">Статус: <?php
                  $terms = wp_get_post_terms( get_the_ID(), 'broker_status' );
                  echo $terms ? esc_html($terms[0]->name) : '-';
                ?></p>
                <div class="brokers__date-block">
                  <span class="brokers__date"><?php echo esc_html( get_post_meta( get_the_ID(), '_bc_date_added', true ) ?: get_the_date('d.m.Y') ); ?></span>
                </div>
              </div>
              <a href="<?php the_permalink(); ?>" class="brokers__link btn">Подробнее</a>
            </div>
            <?php
          }
          wp_reset_postdata();
        }
        ?>
      </div>
    </div>
  </section>

  <!-- Latest reviews (uses comments on broker posts) -->
  <section class="reviews">
    <div class="reviews__container">
      <h2 class="reviews__title title">Последние отзывы</h2>
      <div class="reviews__wrap">
        <div class="reviews__slider swiper">
          <div class="reviews__wrapper swiper-wrapper">
            <?php
            $recent_comments = get_comments( array( 'number' => 6, 'status' => 'approve' ) );
            foreach ( $recent_comments as $c ) {
              $avatar = get_avatar_url( $c );
              $excerpt = wp_trim_words( $c->comment_content, 20 );
              ?>
              <div class="reviews__slide slide-reviews swiper-slide">
                <div class="slide-reviews__image"><img src="<?php echo esc_url( $avatar ); ?>" alt=""><span class="slide-reviews__check"><img src="<?php echo get_template_directory_uri(); ?>/img/icons/check.png" alt=""></span></div>
                <h3 class="slide-reviews__name"><?php echo esc_html( $c->comment_author ); ?></h3>
                <div class="slide-reviews__block"><span class="slide-reviews__date"><?php echo date('d.m.Y', strtotime($c->comment_date)); ?></span></div>
                <p class="slide-reviews__text"><?php echo esc_html( $excerpt ); ?></p>
                <a href="<?php echo esc_url( get_comment_link($c) ); ?>" class="slide-reviews__link">Читать далее</a>
              </div>
              <?php
            }
            ?>
          </div>
          <div class="reviews__swiper-pagination"></div>
        </div>
      </div>
    </div>
 <section class="report">
				<div class="report__container">
					<div class="report__content">
						<h2 class="report__title title title--white">Сообщить о брокере</h2>
						<p class="report__text">Введите название компании и узнайте её статус</p>
						<a href="<?php echo esc_url( home_url('/complaints/') ); ?>" class="block-report__link">Пожаловаться <img src="wp-content/themes/pravda3/img/icons/arrow-link-black.svg" alt="Картинка"></a>
					</div>
					<div class="report__image">
						<picture><source srcset="wp-content/themes/pravda3/img/report-image.webp" type="image/webp"><img src="wp-content/themes/pravda3/img/report-image.jpg" alt="Картинка"></picture>
						<div class="report__decor">
							<span></span>
							<span></span>
							<span></span>
							<span></span>
							<span></span>
							<span></span>
						</div>
					</div>
				</div>
			</section>

	<section class="about">
				<div class="about__container">
					<div class="about__body">
						<div class="about__content">
							<h1 class="about__title title">О проекте</h1>
							<div class="about__text">
								<p>Мы – это новая платформа, которая меняет правила игры на рынке недвижимости. Наша главная цель – дать вам возможность взаимодействовать напрямую с продавцами или покупателями, минуя традиционных посредников. </p>
								<p>Мы помогаем вам найти идеальный вариант или покупателя, предоставляя удобные инструменты для поиска, общения и оформления сделок.</p>
							</div>
							<a href="#" class="about__link btn">Связаться с нами <img src="wp-content/themes/pravda3/img/icons/arrow-btn.svg" alt="иконка"></a>
						</div>
						<div class="about__images">
							<div class="about__image-small">
								<picture><source srcset="wp-content/themes/pravda3/img/about/01.webp" type="image/webp"><img src="wp-content/themes/pravda3/img/about/01.jpg" alt="Картинка"></picture>
							</div>
							<div class="about__image-big">
								<picture><source srcset="wp-content/themes/pravda3/img/about/02.webp" type="image/webp"><img src="wp-content/themes/pravda3/img/about/02.jpg" alt="Картинка"></picture>
							</div>
						</div>
					</div>
				</div>
			</section>

</main>
<?php get_footer(); ?>