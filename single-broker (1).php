<?php
get_header();
if ( have_posts() ) : while ( have_posts() ) : the_post();
  $rating = get_post_meta( get_the_ID(), '_bc_rating', true ) ?: 0;
  $status = wp_get_post_terms(get_the_ID(),'broker_status');
  $status_name = $status ? $status[0]->name : '';
?>
<main class="page">
  <section class="top-broker">
    <div class="top-broker__container">
      <div class="top-broker__body">
        <div class="top-broker__content">
          <div class="top-broker__image"><?php if ( has_post_thumbnail() ) the_post_thumbnail('large'); ?></div>
          <div class="top-broker__info">
            <div class="top-broker__status"><div class="top-broker__icon"><img src="<?php echo get_template_directory_uri(); ?>/img/icons/check2.svg" alt=""></div><p class="top-broker__info-status">Статус: <?php echo esc_html($status_name); ?></p></div>
            <h1 class="top-broker__name"><?php the_title(); ?></h1>
            <div class="top-broker__rating">
              <div class="top-broker__rating-block">
                <span class="top-broker__number"><?php echo esc_html( $rating ); ?></span>
                <ul class="top-broker__rating-list"><?php for($i=0;$i<5;$i++): ?><li class="top-broker__rating-item"><img src="<?php echo get_template_directory_uri(); ?>/img/icons/star-white.svg" alt=""></li><?php endfor; ?></ul>
              </div>
              <a href="#reviews" class="top-broker__reviews-link">Отзывов: <?php echo get_comments_number(); ?></a>
            </div>
            <ul class="top-broker__links">
              <li><a href="#overview" class="top-broker__link-bottom btn">Обзор</a></li>
              <li><a href="#reviews" class="top-broker__link-bottom btn">Отзывы</a></li>
              <li><a href="#facts" class="top-broker__link-bottom btn">Факты</a></li>
            </ul>
          </div>
        </div>
</div>
        <div id="overview" class="top-broker__block block-top-broker">
          <h2 class="block-top-broker__title"><?php the_title(); ?> — обзор</h2>
          <div class="block-top-broker__text"><?php the_content(); ?></div>
<a href="#wait-review" class="block-top-broker__link btn">Оставить отзыв <img src="/wp-content/themes/pravda3/img/icons/reviews-white.svg" alt="иконка"></a>
        </div>

        <section id="reviews" class="reviews-block">
          <div class="reviews-block__container">
            <h2 class="reviews-block__title">Отзывы</h2>
            <div class="reviews-block__body">
              <?php
              $comments = get_comments( array('post_id'=>get_the_ID(),'status'=>'approve') );
              if ( $comments ) {
                foreach ( $comments as $c ) {
                  ?>
                  <div class="reviews-block__item item-reviews-block">
                    <div class="item-reviews-block__image"><img src="<?php echo get_template_directory_uri(); ?>/img/review-image2.png" alt=""></div>
                    <div class="item-reviews-block__content">
                      <h3 class="item-reviews-block__name"><?php echo esc_html($c->comment_author); ?></h3>
                      <span class="item-reviews-block__date"><?php echo date('d.m.Y', strtotime($c->comment_date)); ?></span>
                      <ul class="item-reviews-block__stars"><?php for($i=0;$i<5;$i++): ?><li class="item-reviews-block__star"><img src="<?php echo get_template_directory_uri(); ?>/img/icons/star-white.svg" alt=""></li><?php endfor; ?></ul>
                      <p class="item-reviews-block__text"><?php echo wp_trim_words( $c->comment_content, 30 ); ?></p>
                    </div>
                  </div>
                  <?php
                }
              } else {
                echo '<p>Нет отзывов.</p>';
              }
              ?>
            </div>
            <div class="reviews-block__pagination"><?php paginate_comments_links(); ?></div>
          </div>
        </section>

        <section id="wait-review"class="wait-review">
          <div class="wait-review__container">
            <div class="wait-review__body">
              <form action="<?php echo site_url('/wp-comments-post.php'); ?>" method="post" class="wait-review__form">
                <h2 class="wait-review__title">Оставьте свой отзыв</h2>
                <input type="hidden" name="comment_post_ID" value="<?php echo get_the_ID(); ?>">
                <input autocomplete="off" type="text" name="author" placeholder="Имя" class="wait-review__input">
                <textarea name="comment" placeholder="Текст" class="wait-review__input wait-review__input--txt"></textarea>
                <button type="submit" class="wait-review__button btn">Отправить</button>
              </form>
            </div>
          </div>
        </section>

      </div>
    </div>
  </section>
</main>
<?php endwhile; endif; get_footer(); ?>