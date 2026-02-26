<?php
get_header();
?>
<main class="page">
  <section class="search-broker">
    <div class="search-broker__container">
      <div class="search-broker__body">
        <div class="search-broker__content">
          <h2 class="search-broker__title title title--white">Поиск брокера</h2>
          <form action="<?php echo esc_url( get_post_type_archive_link('broker') ); ?>" method="get" class="search-broker__form">
            <input autocomplete="off" type="text" name="s" placeholder="Поиск" class="search-broker__input" value="<?php echo get_search_query(); ?>">
            <button type="submit" class="search-broker__button"><img src="<?php echo get_template_directory_uri(); ?>/img/icons/search.svg" alt=""></button>
          </form>
        </div>
        <div class="search-broker__image"><picture><source srcset="<?php echo get_template_directory_uri(); ?>/img/broker.webp" type="image/webp"><img src="<?php echo get_template_directory_uri(); ?>/img/broker.jpg" alt=""></picture></div>
      </div>

      <div class="search-broker__brokers brokers">
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
          <div class="brokers__block">
            <a href="<?php the_permalink(); ?>" class="brokers__left">
              <span class="brokers__logo"><?php if ( has_post_thumbnail() ) the_post_thumbnail('medium'); ?></span>
              <h3 class="brokers__name"><?php the_title(); ?></h3>
            </a>
            <div class="brokers__content">
              <p class="brokers__status">Статус: <?php $t = wp_get_post_terms(get_the_ID(),'broker_status'); echo $t ? esc_html($t[0]->name) : '-'; ?></p>
              <div class="brokers__date-block"><span class="brokers__date"><?php echo get_post_meta(get_the_ID(), '_bc_date_added', true) ?: get_the_date('d.m.Y'); ?></span></div>
            </div>
            <a href="<?php the_permalink(); ?>" class="brokers__link btn">Подробнее</a>
          </div>
        <?php endwhile; else: ?>
          <p>Брокеры не найдены.</p>
        <?php endif; ?>
      </div>

      <div class="pagination"><?php the_posts_pagination(); ?></div>
    </div>
  </section>
</main>
<?php get_footer(); ?>