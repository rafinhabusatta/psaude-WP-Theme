<?php get_header();
  pageBanner(array(
    'title' => get_the_archive_title(),
    'subtitle' => get_the_archive_description()
  ))
?>
  <!-- generic archive -->
  <div class="container">
    <div class="row mx-0 mt-3">
      <div class="col-12">
        <div class="row">
          <?php
          while(have_posts()) {
            the_post(); ?>
            <div class="col-12 col-md-6 col-lg-4">
              <div class="card mb-4">
                <div class="card-body">
                  <h5 class="card-title"><?php the_title(); ?></h5>
                  <p>Posted by <?php the_author_posts_link(); ?> on <?php the_time('d/m/Y'); ?> in <?php echo get_the_category_list(', '); ?></p>
                  <p class="card-text"><?php echo wp_trim_words(get_the_content(), 18); ?></p>
                  <a href="<?php the_permalink(); ?>" class="btn btn-primary">Leia mais</a>
                </div>
              </div>
            </div>
          <?php }
          ?>
        </div>
      </div>
    </div>
    <?php echo paginate_links(); ?>
  </div>
<?php  get_footer(); ?>