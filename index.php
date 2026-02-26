<?php
// fallback
get_header();
if ( have_posts() ) {
  while ( have_posts() ) { the_post();
    the_title('<h1>','</h1>');
    the_content();
  }
} else {
  echo '<p>Ничего не найдено.</p>';
}
get_footer();