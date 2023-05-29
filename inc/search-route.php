<?php 
//replace: Psaude with your theme name
//replace: psaude with your theme path url
//add: in the main query, the post types with your post types
function removeAccents($string) {
  return strtolower(trim(preg_replace('~[^0-9a-z]+~i', '-', preg_replace('~&([a-z]{1,2})(acute|cedil|circ|grave|lig|orn|ring|slash|th|tilde|uml);~i', '$1', htmlentities($string, ENT_QUOTES, 'UTF-8'))), ' '));
}

function PsaudeRegisterSearch() {
  register_rest_route('psaude/v1', 'search', array(
    'methods' => WP_REST_SERVER::READABLE, // GET request (crud)
    'callback' => 'psaude_search'
  )); // namespace, route, array of options

  register_rest_route('psaude/v1', 'portfolio', array(
    'methods' => WP_REST_SERVER::READABLE,
    'callback' => 'PsaudePortfolioSearchResults'
  ));
}
add_action('rest_api_init', 'PsaudeRegisterSearch');

function PsaudeSearchResults(WP_REST_Request $dataSearch) {
  $mainQuery = new WP_QUERY(array(
    'post_type' => array('post', 'page', 'portfolio'),
    //'s' => sanitize_text_field($dataSearch['term']),
    'posts_per_page' => -1
  ));

  $results = array(
    'generalInfo' => array(),
    'portfolio' => array()
    // add here arrays for your post types
  );

  while($mainQuery->have_posts()) {
    $mainQuery->the_post();

    if (get_post_type() == 'post' OR get_post_type() == 'page') {
      array_push($results['generalInfo'], array(
        'title' => get_the_title(),
        'permalink' => get_the_permalink() ,
        'postType' => get_post_type(),
        'authorName' => get_the_author()
      ));
    } 

    if(get_post_type() == 'portfolio') {
      $Date = new DateTime(get_field('data'));
      array_push($results['portfolio'], array(
        'title' => get_the_title(),
        'permalink' => get_the_permalink(),
        'authorName' => get_field('equipeparticipante'),
        'projectDate' => $Date->format('d/m/y'),
        'projectType' => get_field('categoria'),
      ));
    }
  }
  wp_reset_postdata();
  return $results;
}

function psaude_search( WP_REST_Request $request ) {
  $dataSearch = $request->get_params();
  $termo = isset($dataSearch['term']) ? sanitize_text_field($dataSearch['term']) : '';

  $args = array(
    'post_type' => array('post', 'page', 'portfolio'),
    's' => $termo,
    'posts_per_page' => -1,
  );

  $mainQuery = new WP_Query( $args );
  $results = array(
    'generalInfo' => array(),
    'portfolio' => array()
  );

  if ( $mainQuery->have_posts() ) {
    while ( $mainQuery->have_posts() ) {
      $mainQuery->the_post();

      if (get_post_type() == 'post' OR get_post_type() == 'page') {
        array_push($results['generalInfo'], array(
          'title' => get_the_title(),
          'permalink' => get_the_permalink() ,
          'postType' => get_post_type(),
          'authorName' => get_the_author()
        ));
      }

      $authorName = isset($dataSearch['authorName']) ? sanitize_text_field($dataSearch['authorName']) : '';
      $projectDate = isset($dataSearch['projectDate']) ? sanitize_text_field($dataSearch['projectDate']) : '';
      $projectDateFormatted = '';
      
      if (!empty($projectDate)) {
        $projectDateObj = DateTime::createFromFormat('d/m/Y', $projectDate);
        $projectDateFormatted = $projectDateObj->format('Y-m-d');
      }

      if(get_post_type() == 'portfolio') {
        $Date = new DateTime(get_field('data'));
        $equipeparticipante = get_field('equipeparticipante');
        $categoria = get_field('categoria');
        
        $authorMatch = empty($authorName) || strtolower($authorName) == strtolower($equipeparticipante);
        //$dateMatch = empty($projectDate) || $Date->format('d/m/Y') == $projectDate;
        $dateMatch = empty($projectDate) || $Date->format('Y-m-d') == $projectDateFormatted;

        if ($authorMatch && $dateMatch) {
          array_push($results['portfolio'], array(
            'title' => get_the_title(),
            'permalink' => get_the_permalink(),
            'authorName' => $equipeparticipante,
            'projectDate' => $Date->format('d/m/Y'),
            'projectType' => $categoria,
          ));
        }
      }
    }
  }

  wp_reset_postdata();
  return rest_ensure_response( $results );
}

function PsaudePortfolioSearchResults($request) {
  $dataSearch = $request->get_params();
  $termo = isset($dataSearch['term']) ? sanitize_text_field($dataSearch['term']) : '';

  $args = array(
    'post_type' => array('portfolio'),
    's' => $termo,
    'posts_per_page' => -1,
  );

  $mainQuery = new WP_Query( $args );

  $results = array();

  while($mainQuery->have_posts()) {
    $mainQuery->the_post();
      $authorName = isset($dataSearch['authorName']) ? sanitize_text_field($dataSearch['authorName']) : '';
      $projectDate = isset($dataSearch['projectDate']) ? sanitize_text_field($dataSearch['projectDate']) : '';
      $projectDateFormatted = '';
      
      if (!empty($projectDate)) {
        $projectDateObj = DateTime::createFromFormat('d/m/Y', $projectDate);
        $projectDateFormatted = $projectDateObj->format('Y-m-d');
      }
      $Date = new DateTime(get_field('data'));
      $equipeparticipante = get_field('equipeparticipante');
      $categoria = get_field('categoria');
      
      $authorMatch = empty($authorName) || strtolower($authorName) == strtolower($equipeparticipante);
      $dateMatch = empty($projectDate) || $Date->format('Y-m-d') == $projectDateFormatted;

      if ($authorMatch && $dateMatch) {
        array_push($results, array(
          'title' => get_the_title(),
          'permalink' => get_the_permalink(),
          'authorName' => $equipeparticipante,
          'projectDate' => $Date->format('d/m/Y'),
          'projectType' => $categoria,
        ));
      }     
  }
  return $results;
}