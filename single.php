<?php
  get_header();
 while(have_posts()) {
  the_post();
  pageBanner();
  ?>
  <div class="container">
    <div class="row mx-0 mt-5">
      <div class="col-12">
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo site_url('/noticias'); ?>">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?php the_title(); ?></li>
          </ol>
        </nav>
        <?php the_content(); ?>
      </div>
    </div>
  </div>

  <?php }
  get_footer();
?>