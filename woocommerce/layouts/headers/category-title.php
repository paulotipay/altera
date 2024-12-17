<?php
/**
 * Category title.
 *
 * @package          Flatsome/WooCommerce/Templates
 * @flatsome-version 3.18.4
 */

$classes = [
	'shop-page-title',
	'category-page-title',
	'page-title',
	'otherspace-category-page-title',
	flatsome_header_title_classes( false ),
];

if ( get_theme_mod( 'content_color' ) === 'dark' ) {
	$classes[] = 'dark';
}
?>
<div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
	<div class="page-title-inner flex-row  medium-flex-wrap container">
		<div class="flex-col flex-grow medium-text-center">
			<?php do_action( 'flatsome_category_title' ); ?>
		</div>
	</div>
	<div class="page-title-inner flex-row  medium-flex-wrap container">
		<div class="flex-col flex-grow medium-text-center">
			<h1><?php if (is_product_category()) {
					single_cat_title('<h1 class="category-title">', '</h1>');
				} ?>
			</h1>
		</div>
		<div class="flex-col medium-text-center">
			<?php do_action( 'add_filter_dropdown' ); ?>
		</div>
	</div>
</div>
