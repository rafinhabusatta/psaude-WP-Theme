<!-- bg-slider -->
<div class="container-fluid px-0 bg-suinfra">
  <div class="container mx-auto py-5">
    <?php
      $PostContent = new WP_Query(array(
        'post_type' => 'post',
        'posts_per_page' => -1,
        )
      );
    ?>
    <div class="row mx-0">
      <div class="col-12 px-0">
        <div id="carouselPortfolio" class="carousel slide carousel-fade">
          <div class="carousel-inner text-center">
            <?php while($PostContent->have_posts()) {
              $PostContent->the_post(); 

              if ($PostContent->current_post == 0) {
                $fileClass = "carousel-item active";
              } else {
                $fileClass = "carousel-item";
              }
            ?>           
            <div class="<?php echo $fileClass; ?>">
              <h2 class="fw-bold"><?php the_title(); ?></h2>
              <?php 
                if(has_excerpt()) {
                  the_excerpt();
                } else {
                  echo wp_trim_words(get_the_content(), 18);
                }
              ?>
            </div> 
                
            <?php } wp_reset_postdata(); ?>
          </div>
          <button class="carousel-control-prev" type="button" data-bs-target="#carouselPortfolio" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Anterior</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#carouselPortfolio" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Próximo</span>
          </button>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /bg-slider -->
