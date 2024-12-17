<?php
function child_theme_google_fonts() {
    // Preconnect to Google Fonts
    wp_enqueue_style( 'google-fonts-preconnect-1', 'https://fonts.googleapis.com', [], null );
    wp_enqueue_style( 'google-fonts-preconnect-2', 'https://fonts.gstatic.com', [], null );
    
    // Enqueue the Baskervville font
    wp_enqueue_style( 'child-theme-google-fonts', 'https://fonts.googleapis.com/css2?family=Baskervville:ital@0;1&display=swap', [], null );
}
add_action( 'wp_enqueue_scripts', 'child_theme_google_fonts' );

// Add custom text input fields to product edit page
function add_custom_text_attribute_field() {
  echo '<div class="options_group options_group_otherspace">';

  woocommerce_wp_text_input(array(
      'id'          => '_artist_name_otherspace',
      'label'       => __('Artist Name', 'woocommerce'),
      'placeholder' => '',
      'desc_tip'    => 'false',
      'description' => __('', 'woocommerce')
  ));

  woocommerce_wp_text_input(array(
      'id'          => '_medium_otherspace',
      'label'       => __('Medium', 'woocommerce'),
      'placeholder' => 'Oil on canvas',
      'desc_tip'    => 'false',
      'description' => __('', 'woocommerce')
  ));

  woocommerce_wp_text_input(array(
    'id'          => '_size_otherspace',
    'label'       => __('Size', 'woocommerce'),
    'placeholder' => '36 x 60 in',
    'desc_tip'    => 'false',
    'description' => __('', 'woocommerce')
  ));

  woocommerce_wp_text_input(array(
    'id'          => '_object_otherspace',
    'label'       => __('Object', 'woocommerce'),
    'placeholder' => '',
    'desc_tip'    => 'false',
    'description' => __('', 'woocommerce')
  ));

  woocommerce_wp_text_input(array(
    'id'          => '_region_otherspace',
    'label'       => __('Region', 'woocommerce'),
    'placeholder' => '',
    'desc_tip'    => 'false',
    'description' => __('', 'woocommerce')
  ));

  woocommerce_wp_text_input(array(
    'id'          => '_condition_otherspace',
    'label'       => __('Condition', 'woocommerce'),
    'placeholder' => '',
    'desc_tip'    => 'false',
    'description' => __('', 'woocommerce')
  ));

  woocommerce_wp_text_input(array(
    'id'          => '_frame_dimension_otherspace',
    'label'       => __('Frame Dimensions', 'woocommerce'),
    'placeholder' => '',
    'desc_tip'    => 'false',
    'description' => __('', 'woocommerce')
  ));

  woocommerce_wp_text_input(array(
    'id'          => '_material_otherspace',
    'label'       => __('Material', 'woocommerce'),
    'placeholder' => '',
    'desc_tip'    => 'false',
    'description' => __('', 'woocommerce')
  ));

  woocommerce_wp_text_input(array(
    'id'          => '_rarity_otherspace',
    'label'       => __('Rarity', 'woocommerce'),
    'placeholder' => '',
    'desc_tip'    => 'false',
    'description' => __('', 'woocommerce')
  ));

  echo '</div>';
}
add_action('woocommerce_product_options_general_product_data', 'add_custom_text_attribute_field');

// Save the custom text attribute field value
function save_artist_name_attribute_field($post_id) {
  $artist_name_field = '_artist_name_otherspace';
  $medium_field = "_medium_otherspace";
  $size_field = "_size_otherspace";

  $object_field = '_object_otherspace';
  $region_field = "_region_otherspace";
  $condition_field = "_condition_otherspace";
  $frame_dimension_field = '_frame_dimension_otherspace';
  $material_field = "_material_otherspace";
  $rarity_field = "_rarity_otherspace";

  if (isset($_POST[$artist_name_field])) {
    $artist_name = sanitize_text_field($_POST[$artist_name_field]);
    update_post_meta($post_id, $artist_name_field, $artist_name);
  }

  if (isset($_POST[$medium_field])) {
    $medium = sanitize_text_field($_POST[$medium_field]);
    update_post_meta($post_id, $medium_field, $medium);
  }

  if (isset($_POST[$size_field])) {
    $size = sanitize_text_field($_POST[$size_field]);
    update_post_meta($post_id, $size_field, $size);
  }

  if (isset($_POST[$object_field])) {
    $object = sanitize_text_field($_POST[$object_field]);
    update_post_meta($post_id, $object_field, $object);
  }

  if (isset($_POST[$region_field])) {
    $region = sanitize_text_field($_POST[$region_field]);
    update_post_meta($post_id, $region_field, $region);
  }

  if (isset($_POST[$condition_field])) {
    $condition = sanitize_text_field($_POST[$condition_field]);
    update_post_meta($post_id, $condition_field, $condition);
  }

  if (isset($_POST[$frame_dimension_field])) {
    $frame_dimension = sanitize_text_field($_POST[$frame_dimension_field]);
    update_post_meta($post_id, $frame_dimension_field, $frame_dimension);
  }

  if (isset($_POST[$material_field])) {
    $material = sanitize_text_field($_POST[$material_field]);
    update_post_meta($post_id, $material_field, $material);
  }

  if (isset($_POST[$rarity_field])) {
    $rarity = sanitize_text_field($_POST[$rarity_field]);
    update_post_meta($post_id, $rarity_field, $rarity);
  }

}
add_action('woocommerce_process_product_meta', 'save_artist_name_attribute_field');

function get_product_price_by_id($product_id) {
  $product = wc_get_product($product_id);

  if ($product) {
      $price = $product->get_price();

      $formatted_price = wc_price($price);

      $currency_code = get_woocommerce_currency();

      return  $currency_code . $formatted_price;
  }

  return null; // Return null if the product is not found
}

function otherspace_add_to_single_product_summary() {
  add_action('woocommerce_single_product_summary', 'display_title_and_artist_name', 6);
  add_action('woocommerce_single_product_summary', 'display_price_medium_size', 6);


  function display_title_and_artist_name() {
    $post = get_post($post_id);
    $title = $post->post_title;

    $artist_name = get_post_meta(get_the_ID(), '_artist_name_otherspace', true);
    echo '<div class="otherspace-product-title">';
    echo '<p class="otherspace-attribute product-title">' . esc_html($title) . '</p>';
    echo '<p class="otherspace-attribute artist-name">' . esc_html($artist_name) . '</p>';
    echo '</div>';
  }

  function display_price_medium_size(){
    $product_id = get_post($post_id);
    $price = get_product_price_by_id($product_id);

    $medium = get_post_meta(get_the_ID(), '_medium_otherspace', true);
    $size = get_post_meta(get_the_ID(), '_size_otherspace', true);

    echo '<div class="otherspace-product-price">';
    echo '<div class="medium-size">';
    echo '<p>' . esc_html($medium) . '</p>';
    echo '<p>' . esc_html($size) . '</p>';
    echo '</div>';
    echo '<p class="price-amount">' . $price . '</p>';
    echo '</div>';
  }
}
add_action('init', 'otherspace_add_to_single_product_summary');

function otherspace_add_to_before_single_product_summary() {

  add_action('woocommerce_before_single_product_summary', 'display_product_content', 25);
  add_action('woocommerce_before_single_product_summary', 'display_product_details', 26);
  
  function display_detail($value, $label) {
    if (!empty($value)){
      echo '<div>';
      echo '<span>' . esc_html($label) . '</span>';
      echo '<p>' . esc_html($value) . '</p>';
      echo '</div>';
    }
  }

  function display_product_details() {
    $object = get_post_meta(get_the_ID(), '_object_otherspace', true);
    $region = get_post_meta(get_the_ID(), '_region_otherspace', true);
    $frame_dimension = get_post_meta(get_the_ID(), '_frame_dimension_otherspace', true);
    $condition = get_post_meta(get_the_ID(), '_condition_otherspace', true);
    $material = get_post_meta(get_the_ID(), '_material_otherspace', true);
    $rarity = get_post_meta(get_the_ID(), '_rarity_otherspace', true);

    echo '<div class="otherspace-details-grid">';
    display_detail($object, 'Object');
    display_detail($region, 'Region');
    display_detail($frame_dimension, 'Frame Dimensions');
    display_detail($condition, 'Condition');
    display_detail($material, 'Material');
    display_detail($rarity, 'Rarity');
    echo '</div>';
  }

  function display_product_content() {
    $product_id = get_post($post_id);
    $product = wc_get_product($product_id);
    $content = $product->get_description();

    $title = 'Product Details';
    if (is_product()) {
      if (has_term('artist', 'product_cat', $post)) {
        $title = 'Artwork Details';
      }
    }

    echo '<div class="otherspace-description-wrapper">';
    echo '<h5>' . $title . '</h5>';
    echo '<p class="otherspace-description">';
    echo $content;
    echo '</p>';
    echo '</div>';
  }
}
add_action('init', 'otherspace_add_to_before_single_product_summary');

function custom_remove_actions_from_single_product_summary() {
  remove_action( 'woocommerce_single_product_summary', 'flatsome_woocommerce_product_breadcrumb',  0 );
  remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title',  5 );
  remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt',  20 );
  remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta',  40 );
  remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing',  50 );
  remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price',  10 );

  remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs',  10 );
  remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display',  15 );
}
add_action('wp', 'custom_remove_actions_from_single_product_summary');

function add_filter_dropdown_action() {
  $parent_slug = $_GET['product_cat'];

  if (!$parent_slug) {
    return;
}

  $parent_category = get_term_by('slug', $parent_slug, 'product_cat');

  if (!$parent_category) {
      return;
  }

  $child_categories = get_terms(array(
      'taxonomy'   => 'product_cat',
      'hide_empty' => true,
      'parent'     => $parent_category->term_id,
  ));

  ?>
    <div class="filter-dropdown">
        <button class="otherspace-button">Filter</button>
        <div class="filter-menu">
            <form method="GET" action="/">
              <input type="hidden" name="product_cat" value="<?php echo $parent_slug; ?>" checked />
              <div class="filter-section">
                  <p>Categories</p>
                  <ul>
                      <?php
                      foreach ($child_categories as $category) {
                        if ($category->slug === $parent_slug) {
                          continue;
                        }
                          $checked = isset($_GET['sub_cat']) && in_array($category->slug, explode(',', $_GET['sub_cat'])) ? 'checked' : '';
                          echo '<li>
                              <label>
                                  <input type="checkbox" name="sub_cat" value="' . esc_attr($category->slug) . '" ' . $checked . ' />
                                  ' . esc_html($category->name) . '
                              </label>
                          </li>';
                      }
                      ?>
                  </ul>
              </div>

              <?php if($parent_slug === 'artist') { ?>
              <div class="filter-section artist-section">
                  <p>Artist</p>
                  <input type="text" name="artist_name" value="<?php echo isset($_GET['artist_name']) ? esc_attr($_GET['artist_name']) : ''; ?>" placeholder="Enter artist name">
              </div>
              <?php } ?>

              <div class="filter-section filter-actions" >
                  <button type="submit" class="otherspace-button">Apply</button>
                  <a href='/?product_cat=<?php echo esc_attr($parent_slug); ?>'>Clear</a>
              </div>
            </form>
        </div>
    </div>
    <?php
}
add_action('add_filter_dropdown', 'add_filter_dropdown_action', 10 , 1);

function enqueue_filter_form_script() {
  wp_enqueue_script(
      'filter',
      get_stylesheet_directory_uri() . '/js/filter.js',
      array('jquery'),
      null,
      true
  );
}
add_action('wp_enqueue_scripts', 'enqueue_filter_form_script');

function add_artist_name_filter($query) {
  if (!is_admin() && $query->is_main_query() && (is_post_type_archive('product') || is_tax('product_cat') || is_tax('product_tag')) && isset($_GET['artist_name']) && !empty($_GET['artist_name'])) {
      $artist_name = sanitize_text_field($_GET['artist_name']);

      $meta_query = $query->get('meta_query');
      if (!is_array($meta_query)) {
          $meta_query = array();
      }

      $meta_query[] = array(
          'key'     => '_artist_name_otherspace',
          'value'   => $artist_name,
          'compare' => 'LIKE',
      );

      $query->set('meta_query', $meta_query);
  }
}
add_action('pre_get_posts', 'add_artist_name_filter');

function filter_products_by_subcategories($query) {
  if (!is_admin() && $query->is_main_query()) {
      $tax_query = $query->get('tax_query') ?: array();

      if (isset($_GET['product_cat']) && !empty($_GET['product_cat'])) {
          $parent_category = sanitize_text_field($_GET['product_cat']);
          
          $tax_query[] = array(
              'taxonomy' => 'product_cat',
              'field'    => 'slug',
              'terms'    => $parent_category,
              'operator' => 'IN',
          );
      }

      if (isset($_GET['sub_cat']) && !empty($_GET['sub_cat'])) {
          $subcategories = array_map('sanitize_text_field', explode(',', $_GET['sub_cat']));

          $tax_query[] = array(
              'taxonomy' => 'product_cat',
              'field'    => 'slug',
              'terms'    => $subcategories,
              'operator' => 'IN',
          );
      }

      if (!empty($tax_query)) {
          $query->set('tax_query', $tax_query);
      }
  }
}
add_action('pre_get_posts', 'filter_products_by_subcategories');

function custom_related_products_heading($heading) {
  if (is_product()) {
    global $post;
    if (has_term('artist', 'product_cat', $post)) {
      return 'Other similar artworks';
    }
  }
  return 'Related products';
  
}
add_filter('woocommerce_product_related_products_heading', 'custom_related_products_heading');

function add_product_category_meta_box() {
  add_meta_box(
      'product_category_meta_box',
      'Category List Page',
      'render_product_category_meta_box',
      'page',
      'side',
      'default'
  );
}
add_action('add_meta_boxes', 'add_product_category_meta_box');

function render_product_category_meta_box($post) {
  $selected_category = get_post_meta($post->ID, 'selected_product_category', true);

  $categories = get_terms(array(
      'taxonomy'   => 'product_cat',
      'hide_empty' => false,
  ));

  ?>
  <label for="selected_product_category">Choose a Product Category:</label>
  <select name="selected_product_category" id="selected_product_category" class="components-select-control__input">
      <option value="">-- All Categories --</option>
      <?php foreach ($categories as $category) : ?>
          <option value="<?php echo esc_attr($category->slug); ?>" <?php selected($selected_category, $category->slug); ?>>
              <?php echo esc_html($category->name); ?>
          </option>
      <?php endforeach; ?>
  </select>
  <?php
}

function save_product_category_meta_box($post_id) {
  if (array_key_exists('selected_product_category', $_POST)) {
      update_post_meta(
          $post_id,
          'selected_product_category',
          sanitize_text_field($_POST['selected_product_category'])
      );
  }
}
add_action('save_post', 'save_product_category_meta_box');

function enable_gutenberg_meta_boxes_for_pages() {
  add_post_type_support('page', 'custom-fields');
}
add_action('init', 'enable_gutenberg_meta_boxes_for_pages');