<?php
// archive-bc_news.php — archive for bc_news CPT
get_header();
?>
<main class="page">
  <section class="news">
    <div class="news__container">
      <h1 class="news__title title">новости</h1>
      <div class="news__body">
        <?php
        $q = new WP_Query( array('post_type'=>'bc_news','posts_per_page'=>12,'paged'=>get_query_var('paged',1)) );
        if ( $q->have_posts() ) {
          while ( $q->have_posts() ) { $q->the_post(); ?>
            <div class="news__item item-news">
              <a href="<?php the_permalink(); ?>" class="item-news__image"><?php if ( has_post_thumbnail() ) the_post_thumbnail('medium'); ?></a>
              <div class="item-news__body">
                <span class="item-news__date"><?php echo get_the_date('d.m.Y'); ?></span>
                <a href="<?php the_permalink(); ?>" class="item-news__title-link"><h3 class="item-news__link-title"><?php the_title(); ?></h3></a>
                <p class="item-news__text"><?php echo wp_trim_words( get_the_excerpt(),20 ); ?></p>
                <a href="<?php the_permalink(); ?>" class="item-news__link btn">Подробнее</a>
              </div>
            </div>
          <?php }
          the_posts_pagination();
          wp_reset_postdata();
        } else {
          echo '<p>Новостей нет.</p>';
        }
        ?>
      </div>
    </div>
  </section>
</main>
<?php get_footer(); ?>