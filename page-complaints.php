<?php
/* Template Name: Complaints Form Page */
get_header();
?>
<main class="page">
  <section class="complaints">
    <div class="complaints__container">
      <div class="complaints__body">
        <div class="complaints__content">
          <h1 class="complaints__title title title--white">Жалобы</h1>
          <form action="<?php echo esc_url( admin_url('admin-post.php') ); ?>" method="post" class="complaints__form-block">
            <?php wp_nonce_field('bc_complaint','bc_complaint_nonce'); ?>
            <input type="hidden" name="action" value="bc_submit_complaint">
            <select name="broker_id" class="complaints__form form">
              <option value="">Выбрать брокера</option>
              <?php $items = get_posts(array('post_type'=>'broker','numberposts'=>-1));
              foreach($items as $it) echo '<option value="'.intval($it->ID).'">'.esc_html($it->post_title).'</option>'; ?>
            </select>
            <textarea name="description" placeholder="Описание" class="complaints__input"></textarea>
            <button type="submit" class="complaints__button btn">Отправить</button>
          </form>
        </div>
        <div class="complaints__image"><picture><source srcset="<?php echo get_template_directory_uri(); ?>/img/complaints.webp" type="image/webp"><img src="<?php echo get_template_directory_uri(); ?>/img/complaints.jpg" alt=""></picture></div>
      </div>
    </div>
  </section>
</main>
<?php get_footer(); ?>