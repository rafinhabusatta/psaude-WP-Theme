<?php get_header(); ?>
<div class="py-5 bg-green">  
  <h1 class="title title-banner text-center text-uppercase my-4 py-2 px-3 px-lg-0">
    <?php the_title(); ?>
  </h1>
</div>
<?php
  $PageContent = new WP_Query(array(
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
        <h2 class="title">A estrutura da UFRGS é composta por aproximadamente 461 prédios</h2>
        <div class="row row-cols-1 row-cols-md-3 g-4 text-center text-white">
          <div class="col">
            <div class="card bg-centro">
              <div class="card-body">
                <h5 class="card-title">Campus Centro</h5>
                <p class="card-text">43</p>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="card bg-green">
              <div class="card-body ">
                <h5 class="card-title">Campus Saúde</h5>
                <p class="card-text">26</p>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="card bg-olimpico">
              <div class="card-body">
                <h5 class="card-title">Campus Olímpico</h5>
                <p class="card-text">17</p>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="card bg-vale">
              <div class="card-body">
                <h5 class="card-title">Campus do Vale</h5>
                <p class="card-text">268</p>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="card bg-litoral">
              <div class="card-body">
                <h5 class="card-title">Campus Litoral Norte</h5>
                <p class="card-text">25</p>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="card bg-dispersas">
              <div class="card-body">
                <h5 class="card-title">Unidades Dispersas</h5>
                <p class="card-text">82</p>
              </div>
            </div>
          </div> 
        </div>
      </div>
    </div>
      <div class="mt-5 row">
        <div class="col-12">
          <?php while($PageContent->have_posts()) {
            $PageContent->the_post(); ?>          
            <div class="row">
              <?php 
                if (get_field('imagem') != NULL) {
                  $col = 'col-12 col-md-6';
                  $image = '<img class="img-fluid" src="' . get_field('imagem') . '" alt="' . get_the_title() . '">';
                } else {
                  $col = 'col-12';
                  $image = '';
                }
              ?>
              <div class="<?php echo $col ?>">
                <h2 class="title"><?php the_title(); ?></h2>
                <p class="justify-content"><?php echo get_field('conteudo_textual'); ?></p>
              </div>
              <?php 
                if (get_field('imagem') != NULL) {
                  echo '<div class="col-12 col-md-6">' . $image . '</div>';
                }
              ?>
              
            </div>           
          <?php } wp_reset_postdata(); ?>
        </div>
      </div>
    
  </div>
</div>
<?php get_footer(); ?>