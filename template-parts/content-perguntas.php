<?php 
  $Perguntas = new WP_Query(array(
    'posts_per_page' => -1,
    'post_type' => 'perguntas-frequentes'
  ));
?>
<h2 class="fs-24"><span class="title-border-sm border-yellow"></span>Perguntas Frequentes</h2>
<div class="accordion" id="accordionPerguntas">
  <?php while($Perguntas->have_posts()) {
    $Perguntas->the_post();
    $identificador = 'heading'.get_the_ID();
    $collapseTarget = 'collapse'.get_the_ID();
    ?>
  <div class="accordion-item">
    <h2 class="accordion-header" id="<?php echo $identificador; ?>">
      <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#<?php echo $collapseTarget; ?>" aria-expanded="true" aria-controls="<?php echo $collapseTarget; ?>">
        <?php the_title(); ?>
      </button>
    </h2>
    <div id="<?php echo $collapseTarget; ?>" class="accordion-collapse collapse" aria-labelledby="<?php echo $identificador; ?>" data-bs-parent="#accordionPerguntas">
      <div class="accordion-body">
        <?php the_content(); ?>
      </div>
    </div>
  </div>
  <?php } ?>
</div>