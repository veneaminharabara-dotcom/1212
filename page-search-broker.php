<?php
/* Template Name: Search Broker (wrapper for archive-broker) */
get_header();
wp_redirect( get_post_type_archive_link('broker') ? get_post_type_archive_link('broker') : home_url('/search-broker/') );
exit;