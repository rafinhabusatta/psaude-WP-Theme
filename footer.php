<div class="container-fluid px-lg-0 ">
  <footer class="d-flex flex-column align-items-center pt-3 mt-4 text-center text-orange">
    <div class="row w-lg-100 mt-3">
      <div class="col-12 col-lg-4 v-border-lg mb-3 mb-lg-0">
        <h3 class="fw-bold tb-father mb-3 mb-lg-5"><span class="title-border-sm border-orange-dark"></span>Contate-nos</h3>
        
        
       
      </div>
      <div class="col-12 col-lg-4 text-gray-medium text-start v-border-lg">
        <div class="mb-3">
        Avenida Bento Gonçalves, 9.500 – CAMPUS DO VALE Agronomia – CEP. 90.540/000

        </div>
        <div class="d-grid g-template-columns-2 mb-3">
          <span class="d-flex flex-column">
            <span class="text-gray fw-semibold">Telefone:</span>
            <br> 
            <a href="tel:5133086610">(51) 3308.6610</a>
            <br>
            <a href="tel:5133087310">Fax (51) 3308.7310</a>
          </span>
          <span>
            <span class="text-gray fw-semibold">E-mail:</span>
            <br> 
            <a href="mailto:suinfra.vale@ufrgs.br">suinfra.vale@ufrgs.br</a>
          </span>
        </div>
      </div>
      <div class="col-12 col-lg-4 d-flex flex-column align-items-center gap-3 d-lg-block my-lg-auto">
        <?php 
          // wp_nav_menu(array(
          //   'theme_location' => 'FooterLocationOne',
            
          //));
        ?>
        <img src="<?php echo get_theme_file_uri('/assets/logo.svg') ?>" alt="" width="136">
        <img src="<?php echo get_theme_file_uri('/assets/ufrgs-logo.svg') ?>" alt="" width="136">
      </div>
      <p class="col-12 bg-orange-dark text-white mb-0 mt-5">&copy; 2023 - Prefeitura Campus Saúde UFRGS</p>
    </div>
  </footer>
</div>

<?php wp_footer(); ?>
</body>
</html>