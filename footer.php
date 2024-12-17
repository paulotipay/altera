<?php
/**
 * The template for displaying the footer.
 *
 * @package          Flatsome\Templates
 * @flatsome-version 3.16.0
 */

global $flatsome_opt;
?>

</main>

<footer id="footer" class="otherspace-footer-wrapper">

	<?php echo '<h1 style="text-align: center; font-size: 40px;">' . get_bloginfo('name') . '</h1>'; ?>
	<nav>
		<?php wp_nav_menu(array(
		  'theme_location' => 'primary',
		  'menu_class'     => 'header-nav header-nav-main nav nav-center',
  		)); ?>
	</nav>
	
	<p class="copy">
		<?php echo '© ' . date('Y') . ' ' .  get_bloginfo('name') . '. All rights reserved.'; ?>
	</p>

</footer>

</div>

<?php wp_footer(); ?>

</body>
</html>
