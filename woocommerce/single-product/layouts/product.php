<?php
/**
 * Product.
 *
 * @package          Flatsome/WooCommerce/Templates
 * @flatsome-version 3.19.0
 */

?>
<div class="product-container otherspace-product-container">

	<div class="row content-row mb-0">
		<div class="otherspace-breadcrumbs-wrapper">
			<?php flatsome_breadcrumb(); ?>
		</div>
	</div>
	<div class="row content-row mb-0">

		<div class="product-gallery col large-<?php echo flatsome_option('product_image_width'); ?>">
			<?php flatsome_sticky_column_open( 'product_sticky_gallery' ); ?>
			<?php
				/**
				 * woocommerce_before_single_product_summary hook
				 *
				 * @hooked woocommerce_show_product_images - 20
				 */
				do_action( 'woocommerce_before_single_product_summary' );
			?>
			<?php flatsome_sticky_column_close( 'product_sticky_gallery' ); ?>
		</div>
		<div class="product-info summary col-fit col entry-summary <?php flatsome_product_summary_classes();?>">
			<?php
				/**
				 * woocommerce_single_product_summary hook
				 *
				 * @hooked woocommerce_template_single_title - 5
				 * @hooked woocommerce_template_single_rating - 10
				 * @hooked woocommerce_template_single_price - 10
				 * @hooked woocommerce_template_single_excerpt - 20
				 * @hooked woocommerce_template_single_add_to_cart - 30
				 * @hooked woocommerce_template_single_meta - 40
				 * @hooked woocommerce_template_single_sharing - 50
				 */
				do_action( 'woocommerce_single_product_summary' );
			?>

		</div>
	</div>
</div>

<div class="product-footer otherspace-footer">
	<div class="container">
		<?php
			/**
			 * woocommerce_after_single_product_summary hook
			 *
			 * @hooked woocommerce_output_product_data_tabs - 10
			 * @hooked woocommerce_upsell_display - 15
			 * @hooked woocommerce_output_related_products - 20
			 */
			do_action( 'woocommerce_after_single_product_summary' );
		?>
	</div>
</div>
