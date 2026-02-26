<?php
get_header();
if ( have_posts() ) : while ( have_posts() ) : the_post();
?>
<main class="page">
  <section class="post">
    <div class="post__container">
      <div class="post__top">
        <div class="post__image-bg"><?php if ( has_post_thumbnail() ) the_post_thumbnail('full'); ?></div>
        <a href="<?php echo esc_url(get_post_type_archive_link('bc_news')); ?>" class="post__link-back">Назад к новостям <img src="<?php echo get_template_directory_uri(); ?>/img/icons/arrow-link.svg" alt=""></a>
        <h1 class="post__title title title--white"><?php the_title(); ?></h1>
      </div>
      <div class="post__body"><?php the_content(); ?></div>
    </div>
  </section>
</main>
<?php endwhile; endif; get_footer(); ?>