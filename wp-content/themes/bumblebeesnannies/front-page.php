<?php get_header(); ?>        

<div id="#container">
	<div id="content">
		<div id="impact">
			<div id="tagline"><?php bloginfo( 'description' ) ?></div>
		</div>

		<div id="body">
			<?php while (have_posts() ) : the_post() ?>
			<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( __('Permalink to %s', 'your-theme'), the_title_attribute('echo=0') ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>		
			<?php the_content(); ?>
			<?php endwhile; ?>
		</div>
	</div>
</div>

<?php get_footer(); ?>