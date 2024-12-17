<?php
/*
Template Name: Category List
*/

get_header();
do_action( 'flatsome_before_page' );
// Get the selected category from the custom field
$selected_category = get_post_meta(get_the_ID(), 'selected_product_category', true);

// Fetch product categories based on the selected category
$args = array(
    'taxonomy'   => 'product_cat',
    'hide_empty' => true,
);

// If a category is selected, fetch its subcategories
if (!empty($selected_category)) {
    $selected_term = get_term_by('slug', $selected_category, 'product_cat');
    if ($selected_term) {
        $args['parent'] = $selected_term->term_id;
    }
}

// Get the categories
$categories = get_terms($args);
?>
<div class="otherspace-categories-container">

    <div class="row content-row mb-0">
		<div class="otherspace-breadcrumbs-wrapper">
			<?php flatsome_breadcrumb(); ?>
		</div>
	</div>

    <div class="row content-row mb-0">
        <h1><?php single_post_title(); ?></h1>
	</div>

    <div class="row content-row mb-0">
        <?php if (!empty($categories) && !is_wp_error($categories)) : ?>
            <ul>
                <?php foreach ($categories as $category) : ?>
                    <li class="otherspace-category-item">
                        <a href="<?php echo esc_url(get_term_link($category)); ?>">
                            <?php 
                            echo '<span>' . esc_html($category->name) . '</span>'; 
                            $thumbnail_id = get_term_meta($category->term_id, 'thumbnail_id', true);

                            if ($thumbnail_id) {
                                $image_url = wp_get_attachment_url($thumbnail_id);

                                echo '<img src="' . esc_url($image_url) . '" alt="' . esc_attr($category->name) . '">';
                            } else {
                                echo '<p>No thumbnail available for this category.</p>';
                            }
                            
                            ?>
                            
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else : ?>
            <p>No categories found.</p>
        <?php endif; ?>
    </div>

</div>
<?php
do_action( 'flatsome_after_page' );
get_footer();
