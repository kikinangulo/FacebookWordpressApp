<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the wordpress construct of pages
 * and that other 'pages' on your wordpress site will use a
 * different template.
 *
 * @package WordPress
 * @subpackage Boilerplate
 * @since Boilerplate 1.0
 */

get_header(); ?>
<? /*
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<?php if ( is_front_page() ) { ?>
					<h2 class="entry-title"><?php the_title(); ?></h2>
				<?php } else { ?>	
					<h1 class="entry-title"><?php the_title(); ?></h1>
				<?php } ?>
					<div class="entry-content">
						<?php the_content(); ?>
						<?php wp_link_pages( array( 'before' => '' . __( 'Pages:', 'boilerplate' ), 'after' => '' ) ); ?>
						<?php edit_post_link( __( 'Edit', 'boilerplate' ), '', '' ); ?>
					</div><!-- .entry-content -->
				</article><!-- #post-## -->
				<?php comments_template( '', true ); ?>
<?php endwhile; ?>
*/ ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="container container_12"> <? /* Start of grid */ ?>
		<h2 class="grid_12">
			<?
				the_title();
				the_post();
				the_content(); 
			?>
		</h2>
		<div class="grid_12">
			<p>784px</p>
		</div>
			
		<div class='clear'>&nbsp;</div>

		<div class='grid_1'>
			<p>47px</p>
		</div>
		<div class='grid_11'>
			<p>717px</p>
		</div>
	
	<?php get_sidebar(); ?>

	</div> <? /* EOF - Start of grid */ ?>
</article><!-- #post-## -->
<?php get_footer(); ?>