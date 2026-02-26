<?php
/* Template Name: Black List */
get_header();
?>
<main class="page">
  <section class="search-broker">
    <div class="search-broker__container">
      <div class="search-broker__body">
        <div class="search-broker__content"><h2 class="search-broker__title title title--white">Чёрный список</h2><p class="search-broker__text">Список мошенников</p></div>
        <div class="search-broker__image"><picture><source srcset="<?php echo get_template_directory_uri(); ?>/img/black.webp" type="image/webp"><img src="<?php echo get_template_directory_uri(); ?>/img/black.jpg" alt=""></picture></div>
      </div>
      <div class="search-broker__brokers brokers">
        <?php
        $q = new WP_Query( array(
          'post_type'=>'broker',
          'posts_per_page'=>-1,
          'tax_query'=>array(array('taxonomy'=>'broker_status','field'=>'slug','terms'=>array('мошенник','scammer','fraud','fraudster'), 'operator'=>'IN'))
        ) );
        if ( $q->have_posts() ) {
          while ( $q->have_posts() ) { $q->the_post(); ?>
            <div class="brokers__block">
              <a href="<?php the_permalink(); ?>" class="brokers__left">
                <span class="brokers__logo"><?php if ( has_post_thumbnail() ) the_post_thumbnail('thumbnail'); ?></span>
                <h3 class="brokers__name"><?php the_title(); ?></h3>
              </a>
              <div class="brokers__content">
                <p class="brokers__status">Статус: <span class="scammer">Мошенник</span></p>
                <div class="brokers__date-block"><span class="brokers__date"><?php echo get_post_meta(get_the_ID(),'_bc_date_added',true) ?: get_the_date('d.m.Y'); ?></span></div>
              </div>
              <a class="brokers__link btn" href="<?php the_permalink(); ?>">Подробнее</a>
            </div>
          <?php }
          wp_reset_postdata();
        } else {
          echo '<p>Пока никого нет в черном списке.</p>';
        }
        ?>
      </div>
    </div>
  </section>
</main>
<?php get_footer(); ?>