<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Helios
 */

?>

<!-- Banner -->
<header id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<h2><?php the_field('cta1home_head'); ?></h2>
	<p><?php the_field('cta1home_text'); ?></p>
</header>

