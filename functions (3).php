<?php
// functions.php — регистрация CPT, таксономий, метабоксов, enqueue assets, шорткоды
if ( ! defined( 'ABSPATH' ) ) exit;

add_action( 'after_setup_theme', 'bc_theme_setup' );
function bc_theme_setup() {
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    register_nav_menus( array( 'primary' => 'Primary Menu' ) );
}

add_action( 'wp_enqueue_scripts', 'bc_enqueue_assets' );
function bc_enqueue_assets() {
    $v = '20251209163556';
    $t = get_template_directory_uri();
    wp_enqueue_style( 'bc-style', $t . '/css/style.min.css', array(), $v );
    wp_enqueue_script( 'bc-app', $t . '/js/app.min.js', array('jquery'), $v, true );
}

// Register CPT: broker, news, complaint
add_action( 'init', 'bc_register_cpts' );
function bc_register_cpts() {
    // Broker
    $labels = array(
        'name' => 'Брокеры',
        'singular_name' => 'Брокер',
        'add_new_item' => 'Добавить брокера',
        'edit_item' => 'Редактировать брокера',
        'all_items' => 'Все брокеры',
    );
    register_post_type( 'broker', array(
        'labels' => $labels,
        'public' => true,
        'has_archive' => true,
        'rewrite' => array( 'slug' => 'brokers' ),
        'supports' => array( 'title','editor','thumbnail','excerpt' ),
        'show_in_rest' => true,
        'menu_icon' => 'dashicons-building',
    ) );

    // News (can also use posts, but keep separate to match html)
    register_post_type( 'bc_news', array(
        'labels' => array('name'=>'Новости','singular_name'=>'Новость','add_new_item'=>'Добавить новость'),
        'public' => true,
        'has_archive' => true,
        'rewrite' => array( 'slug' => 'news' ),
        'supports' => array( 'title','editor','thumbnail','excerpt' ),
        'show_in_rest' => true,
        'menu_icon' => 'dashicons-admin-post',
    ) );

    // Complaint - stored as private posts for admin review
    register_post_type( 'complaint', array(
        'labels' => array('name'=>'Жалобы','singular_name'=>'Жалоба'),
        'public' => false,
        'show_ui' => true,
        'supports' => array('title','editor'),
        'menu_icon' => 'dashicons-warning',
    ) );

    // Taxonomy: broker_status
    register_taxonomy( 'broker_status', 'broker', array(
        'labels' => array('name'=>'Статус брокера','singular_name'=>'Статус'),
        'public' => true,
        'hierarchical' => false,
        'rewrite' => array('slug'=>'broker-status'),
        'show_in_rest' => true,
    ) );
}

// Metaboxes for broker: rating, date_added (simple)
add_action( 'add_meta_boxes', 'bc_add_broker_meta_boxes' );
function bc_add_broker_meta_boxes() {
    add_meta_box( 'bc_broker_meta', 'Данные брокера', 'bc_broker_meta_callback', 'broker', 'side', 'high' );
}
function bc_broker_meta_callback( $post ) {
    wp_nonce_field( 'bc_save_broker_meta', 'bc_broker_meta_nonce' );
    $rating = get_post_meta( $post->ID, '_bc_rating', true );
    $date_added = get_post_meta( $post->ID, '_bc_date_added', true );
    echo '<p><label>Рейтинг (0-5)</label><br><input type="number" step="0.1" min="0" max="5" name="bc_rating" value="'.esc_attr($rating).'" style="width:100%;"></p>';
    echo '<p><label>Дата добавления</label><br><input type="date" name="bc_date_added" value="'.esc_attr($date_added).'" style="width:100%;"></p>';
    echo '<p>Логотип: установить как "Миниатюра записи" (Featured Image)</p>';
    echo '<p>Статус: используйте таксономию "Статус брокера" справа.</p>';
}
add_action( 'save_post', 'bc_save_broker_meta' );
function bc_save_broker_meta( $post_id ) {
    if ( ! isset( $_POST['bc_broker_meta_nonce'] ) ) return;
    if ( ! wp_verify_nonce( $_POST['bc_broker_meta_nonce'], 'bc_save_broker_meta' ) ) return;
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    if ( isset( $_POST['bc_rating'] ) ) update_post_meta( $post_id, '_bc_rating', floatval( $_POST['bc_rating'] ) );
    if ( isset( $_POST['bc_date_added'] ) ) update_post_meta( $post_id, '_bc_date_added', sanitize_text_field( $_POST['bc_date_added'] ) );
}

// When news, broker or comment saved — WordPress loops will automatically show "latest" blocks because templates query latest posts.
// Provide helper shortcodes for lists used in templates
add_shortcode( 'bc_latest_news', 'bc_shortcode_latest_news' );
function bc_shortcode_latest_news( $atts ) {
    $atts = shortcode_atts( array('count'=>4), $atts );
    $q = new WP_Query( array( 'post_type'=>'bc_news', 'posts_per_page'=>intval($atts['count']) ) );
    ob_start();
    if ( $q->have_posts() ) {
        echo '<div class="bc-latest-news">';
        while ( $q->have_posts() ) {
            $q->the_post();
            $thumb = get_the_post_thumbnail_url( get_the_ID(), 'medium' ) ?: get_template_directory_uri().'/img/news/01.jpg';
            ?>
            <article class="last-news__slide">
                <div class="slide-last-news__image"><img src="<?php echo esc_url($thumb); ?>" alt=""></div>
                <div class="slide-last-news__body">
                    <span class="slide-last-news__date"><?php echo get_the_date('d.m.Y'); ?></span>
                    <a href="<?php the_permalink(); ?>" class="slide-last-news__link-title"><h3 class="slide-last-news__title-link"><?php the_title(); ?></h3></a>
                    <p class="slide-last-news__text"><?php echo wp_trim_words( get_the_excerpt(), 20 ); ?></p>
                    <a href="<?php the_permalink(); ?>" class="slide-last-news__link">Подробнее</a>
                </div>
            </article>
            <?php
        }
        echo '</div>';
        wp_reset_postdata();
    }
    return ob_get_clean();
}

add_shortcode( 'bc_latest_brokers', 'bc_shortcode_latest_brokers' );
function bc_shortcode_latest_brokers( $atts ) {
    $atts = shortcode_atts( array('count'=>6), $atts );
    $q = new WP_Query( array( 'post_type'=>'broker', 'posts_per_page'=>intval($atts['count']) ) );
    ob_start();
    if ( $q->have_posts() ) {
        echo '<div class="brokers-list">';
        while ( $q->have_posts() ) {
            $q->the_post();
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
                        if ( $terms && ! is_wp_error($terms) ) echo '<span>'.esc_html($terms[0]->name).'</span>'; else echo '<span>-</span>';
                    ?></p>
                    <div class="brokers__date-block">
                        <span class="brokers__date"><?php echo esc_html( get_post_meta( get_the_ID(), '_bc_date_added', true ) ?: get_the_date('d.m.Y') ); ?></span>
                        <ul class="brokers__rating-list">
                            <?php for ($i=0;$i<5;$i++): ?>
                                <li class="brokers__rating-item"><img src="<?php echo get_template_directory_uri(); ?>/img/icons/star-white.svg" alt=""></li>
                            <?php endfor; ?>
                        </ul>
                    </div>
                </div>
                <a href="<?php the_permalink(); ?>" class="brokers__link btn">Подробнее</a>
            </div>
            <?php
        }
        echo '</div>';
        wp_reset_postdata();
    }
    return ob_get_clean();
}

// Complaint submission handler (admin-post) — saves as CPT 'complaint'
add_action( 'admin_post_nopriv_bc_submit_complaint', 'bc_handle_complaint' );
add_action( 'admin_post_bc_submit_complaint', 'bc_handle_complaint' );
function bc_handle_complaint() {
    if ( ! isset($_POST['bc_complaint_nonce']) || ! wp_verify_nonce( $_POST['bc_complaint_nonce'], 'bc_complaint' ) ) {
        wp_die('Nonce error');
    }
    $broker_id = isset($_POST['broker_id']) ? intval($_POST['broker_id']) : 0;
    $desc = isset($_POST['description']) ? sanitize_textarea_field( $_POST['description'] ) : '';
    $title = $broker_id ? 'Жалоба: '. get_the_title($broker_id) : 'Жалоба';
    $post_id = wp_insert_post( array(
        'post_type' => 'complaint',
        'post_title' => $title,
        'post_content' => $desc,
        'post_status' => 'publish',
    ) );
    if ( $post_id && $broker_id ) update_post_meta( $post_id, '_bc_complaint_broker', $broker_id );
    wp_safe_redirect( wp_get_referer() );
    exit;
}

// Helper: flush rewrite on theme activation
add_action( 'after_switch_theme', function(){ flush_rewrite_rules(); } );
// --- Динамические счётчики для главной (Facts) ---
/**
 * Возвращает число одобренных комментариев за последние N дней.
 * @param int $days
 * @return int
 */
function bc_count_recent_comments( $days = 7 ) {
    global $wpdb;
    $since = date( 'Y-m-d H:i:s', strtotime( "-{$days} days" ) );
    $count = (int) $wpdb->get_var( $wpdb->prepare(
        "SELECT COUNT(*) FROM {$wpdb->comments} WHERE comment_approved = '1' AND comment_date >= %s",
        $since
    ) );
    return $count;
}

/**
 * Возвращает число брокеров с термином мошенник (проверяет разные варианты slug/name).
 * @return int
 */
function bc_count_blacklisted_brokers() {
    $possible = array( 'мошенник', 'moшeнник', 'scammer', 'fraud', 'fraudster', 'moshennik' );
    // Попробуем найти термин по slug или названию (case-insensitive)
    $term_ids = array();
    foreach ( $possible as $t ) {
        $term = get_term_by( 'slug', sanitize_title($t), 'broker_status' );
        if ( $term && ! is_wp_error( $term ) ) $term_ids[] = $term->term_id;
    }
    // также проверим по name
    $all = get_terms( array( 'taxonomy' => 'broker_status', 'hide_empty' => false ) );
    if ( ! is_wp_error( $all ) ) {
        foreach ( $all as $term ) {
            if ( mb_stripos( $term->name, 'мошен' ) !== false || mb_stripos( $term->name, 'scamm' ) !== false || mb_stripos($term->name, 'fraud') !== false ) {
                $term_ids[] = $term->term_id;
            }
        }
    }
    $term_ids = array_unique( $term_ids );
    if ( empty( $term_ids ) ) {
        // если терминов нет — попробуем считать брокеров, у которых в title/контент есть слово "мошенник" (крайняя мера)
        $q = new WP_Query( array(
            'post_type' => 'broker',
            'posts_per_page' => -1,
            's' => 'мошенник',
            'fields' => 'ids',
        ) );
        return $q->found_posts;
    }
    $q = new WP_Query( array(
        'post_type' => 'broker',
        'posts_per_page' => -1,
        'tax_query' => array(
            array(
                'taxonomy' => 'broker_status',
                'field' => 'term_id',
                'terms' => $term_ids,
            ),
        ),
        'fields' => 'ids',
    ) );
    return $q->found_posts;
}

/**
 * Возвращает число жалоб (CPT complaint) за последние N дней.
 * @param int $days
 * @return int
 */
function bc_count_recent_complaints( $days = 7 ) {
    $args = array(
        'post_type' => 'complaint',
        'post_status' => 'publish',
        'date_query' => array( array( 'after' => "{$days} days ago" ) ),
        'posts_per_page' => -1,
        'fields' => 'ids',
    );
    $q = new WP_Query( $args );
    return $q->found_posts;
}

/**
 * Возвращает число новостей (bc_news) за последние N дней.
 * @param int $days
 * @return int
 */
function bc_count_recent_news( $days = 7 ) {
    $args = array(
        'post_type' => 'bc_news',
        'post_status' => 'publish',
        'date_query' => array( array( 'after' => "{$days} days ago" ) ),
        'posts_per_page' => -1,
        'fields' => 'ids',
    );
    $q = new WP_Query( $args );
    return $q->found_posts;
}

/**
 * Удобный форматер: если число 0 -> показываем 0, если >0 -> возвращаем int
 */
function bc_format_count( $n ) {
    return intval($n);
}