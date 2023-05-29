<?php 
  get_header(); 
  get_template_part('template-parts/content', 'homeBanner');
?>
  <main class="container-fluid px-0">
    <div class="container">
      <div class="row mt-3 pt-3">
        <div class="col-12">
          <h2 class="title">Serviços em Andamento</h2>
        </div>
        <?php 
          $args = array(
            'post_type' => 'servicos',
            'posts_per_page' => 4,
            'orderby' => 'date',
            'order' => 'DESC'
          );
          $servicos = new WP_Query($args);     
      
          while($servicos->have_posts()) {
            $servicos->the_post();
        ?>
        <div class="col-12 col-lg-6">
          <div class="service">
            <h3 class="fw-bold"><?php the_title(); ?></h3>
            <p><?php the_content(); ?></p>
          </div>
        </div>
        <?php } wp_reset_postdata(); ?>
      </div>
    </div>
      <div class="bg-gray-lighter">
        <div class="container">
          <div class="row mt-3 pt-3">
            <div class="col-12">
              <h2 class="title">Avisos</h2>
            </div>
            <?php 
              $args = array(
                'post_type' => 'avisos',
                'posts_per_page' => 4,
                'orderby' => 'date',
                'order' => 'DESC'
              );
              $avisos = new WP_Query($args);     
          
              while($avisos->have_posts()) {
                $avisos->the_post();
            ?>
            <div class="col-12 col-lg-6">
              <div class="service">
                <h3 class="fw-bold"><?php the_title(); ?></h3>
                <p><?php the_content(); ?></p>
              </div>
            </div>
            <?php } wp_reset_postdata(); ?>
          </div>
        </div>
      </div>
  </main>
<?php  get_footer(); ?>