<!DOCTYPE html>
<html lang="<?php language_attributes(); ?>">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php wp_head(); ?>
</head>
<body class="<?php body_class(); ?>">
  <?php
    if (is_page('home')) {
      $bg = 'sticky-top main-menu none';
    } else {
      $bg = 'sticky-top main-menu bg-gray-light';
    }
  ?>
  <header class="<?php echo $bg; ?>">
    <nav class="navbar navbar-expand-lg navbar-light bg-suinfra">
      <a href="<?php echo site_url(); ?>" class="navbar-brand">
        <img src="<?php bloginfo("template_directory"); ?>/assets/logo.svg" alt="Superintendência de infraestrutura da Universidade Federal do Rio Grande do Sul" width="230">
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#suinfra-navbar-collapse" aria-controls="suinfra-navbar-collapse" aria-expanded="false" aria-label="<?php esc_attr_e( 'Toggle navigation', 'your-theme-slug' ); ?>">
        <span class="navbar-toggler-icon"></span>
      </button>
      <?php
        wp_nav_menu( array(
          'menu'              => 'primary',
          'theme_location'    => 'primary',
          'depth'             => 2,
          'container'         => 'div',
          'container_class'   => 'collapse navbar-collapse',
          'container_id'      => 'suinfra-navbar-collapse',
          'menu_class'        => 'nav navbar-nav ms-auto',
          'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
          'walker'            => new wp_bootstrap_navwalker())
        );
      ?>
    </nav>
  </header>