<?php
// (file repeated above in functions output but include actual header content)
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<meta name="format-detection" content="telephone=no">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<div class="wrapper">
<header class="header">
  <div class="header__container">
    <div class="header__body">
     <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo">
  <img src="<?php echo get_template_directory_uri(); ?>/img/logo.png" 
       alt="<?php bloginfo('name'); ?>" 
       class="logo">
</a>
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
        <div class="menu__social">
          <h4 class="menu__social-title">Наши соц сети:</h4>
          <ul class="menu__social-list">
            <li class="menu__social-item"><a class="menu__social-link" href="#"><img src="<?php echo get_template_directory_uri(); ?>/img/icons/ytb.svg" alt=""></a></li>
            <li class="menu__social-item"><a class="menu__social-link" href="#"><img src="<?php echo get_template_directory_uri(); ?>/img/icons/fb.svg" alt=""></a></li>
            <li class="menu__social-item"><a class="menu__social-link" href="#"><img src="<?php echo get_template_directory_uri(); ?>/img/icons/inst.svg" alt=""></a></li>
          </ul>
        </div>
      <div class="header__right">
        <form data-da=".menu,479.98" action="<?php echo esc_url(home_url('/')); ?>" method="get" class="header__form">
          <input autocomplete="off" type="text" name="s" placeholder="Поиск" class="header__input" value="<?php echo get_search_query(); ?>">
          <button type="submit" class="header__button"><img src="<?php echo get_template_directory_uri(); ?>/img/icons/search.svg" alt=""></button>
        </form>
        <button type="button" class="header__icon icon-menu"><span></span></button>
      </div>
    </div>
  </div>
</header>