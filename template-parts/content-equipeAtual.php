<div class="bg-orange-light text-white">
  <div class="container">
    <div class="row py-5">
      <div class="col-12">
        <h2>Equipe Atual</h2>
        <div id="carouselExample" class="carousel slide">
          <div class="carousel-inner">
            <div class="carousel-item active text-center">
              <?php
                $count = 0;
                $CI = null;

                $Equipe = new WP_Query(array(
                  'post_type' => 'equipe',
                  'posts_per_page' => -1,
                  'orderby' => 'title',
                  'order' => 'ASC'
                ));
                
                while($Equipe->have_posts()) {
                  $Equipe->the_post();

                  if($count > 5) {
                    $CI = '</div><div class="carousel-item text-center">';
                    $count = 0;
                  } else {
                    $CI = null;
                  }

                  $membroAtual = get_field('membro_atual');
                  $areaAtuacao = get_field('area_de_atuacao');
                  $professor = get_field('professor');
                  
                  if($membroAtual == 'true') {
                    $count ++;
              ?>
                  <div class="d-inline-block text-center ms-4">
                      <img src="<?php echo get_field('foto_de_perfil'); ?>" class="d-inline-block rounded-circle bg-gray" alt="..." width="150" height="150">
                    <h3 class="fs-18"><?php the_title(); ?></h3>
                    <h4 class="fs-6">
                      <?php 
                        if($areaAtuacao != '') {
                          echo $areaAtuacao;
                        } else if ($professor == 'false') { 
                          echo 'Bolsista'; 
                        } else {
                          echo 'Professor(a)';
                        }
                      ?>
                    </h4>
                  </div>
              <?php
                  }
                echo $CI;
               } ?>
            </div>
          </div>
          <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Anterior</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Próximo</span>
          </button>
        </div>
      </div>
    </div>
  </div>
</div>