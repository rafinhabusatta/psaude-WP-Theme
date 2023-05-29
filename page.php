<?php get_header(); ?>
<div class="py-5 bg-green">  
  <h1 class="title title-banner text-center text-uppercase my-4 py-2 px-3 px-lg-0">
    <?php the_title(); ?>
  </h1>
</div>
<?php
  $PortfolioContent = new WP_Query(array(
    'post_type' => 'page-content',
    'posts_per_page' => -1,
    'meta_query' => array(
      array(
        'key' => 'pagina_relacionada',
        'compare' => 'LIKE',
        'value' => '"' . get_the_ID() . '"'
      )
    )
  ));
?>
<div class="container-fluid px-0 mt-5">
  <div class="container mx-auto py-5">
    <div class="row">
      <div class="col-12">
        <?php while($PortfolioContent->have_posts()) {
          $PortfolioContent->the_post(); ?>          
          <div>
            <?php the_title(); the_content(); ?>
          </div>           
        <?php } wp_reset_postdata(); ?>
      </div>
    </div>
  </div>
</div>
<?php get_footer(); ?>