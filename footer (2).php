<?php
// footer.php (keeps markup)
?>
<footer class="footer">
  <div class="footer__container">
    <div class="footer__left">
     <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo">
  <img src="<?php echo get_template_directory_uri(); ?>/img/logo.png" 
       alt="<?php bloginfo('name'); ?>" 
       class="logo">
</a>
      <div class="footer__menu menu-footer">
        <nav class="menu__body">
          <?php
          if ( has_nav_menu('primary') ) {
            wp_nav_menu( array('theme_location'=>'primary','container'=>false,'menu_class'=>'menu__list') );
          } else {
            echo '<ul class="menu__list">
              <li class="menu__item"><a class="menu__link" href="'.esc_url(home_url('/')).'">Главная</a></li>
              <li class="menu__item"><a class="menu__link" href="'.esc_url(home_url('/search-broker/')).'">Поиск брокера</a></li>
              <li class="menu__item"><a class="menu__link" href="'.esc_url(home_url('/black-broker/')).'">Чёрный список</a></li>
              <li class="menu__item"><a class="menu__link" href="'.esc_url(home_url('/news/')).'">Новости</a></li>
              <li class="menu__item"><a class="menu__link" href="'.esc_url(home_url('/contacts/')).'">Контакты</a></li>
              <li class="menu__item"><a class="menu__link" href="'.esc_url(home_url('/complaints/')).'">Жалобы</a></li>
            </ul>';
          }
          ?>
        </nav>
      </div>
    </div>
    <div class="footer__right">
      <form action="<?php echo esc_url(home_url('/')); ?>" method="get" class="footer__form">
        <input autocomplete="off" type="text" name="s" placeholder="Поиск" class="footer__input">
        <button type="submit" class="footer__button"><img src="<?php echo get_template_directory_uri(); ?>/img/icons/search.svg" alt=""></button>
      </form>
      <div class="footer__social">
        <h4 class="footer__social-title">Наши соц сети:</h4>
        <ul class="footer__social-list">
          <li class="footer__social-item"><a href="#"><img src="<?php echo get_template_directory_uri(); ?>/img/icons/ytb.svg" alt=""></a></li>
          <li class="footer__social-item"><a href="#"><img src="<?php echo get_template_directory_uri(); ?>/img/icons/fb.svg" alt=""></a></li>
          <li class="footer__social-item"><a href="#"><img src="<?php echo get_template_directory_uri(); ?>/img/icons/inst.svg" alt=""></a></li>
        </ul>
      </div>
    </div>
  </div>
</footer>
</div><!-- .wrapper -->
<?php wp_footer(); ?>
</body>
</html>