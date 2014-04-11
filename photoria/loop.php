<?php
wp_reset_query();

if ( have_posts() ) :

	$i = 0;

	?><ul class="posts">

		<?php
		while ( have_posts() ) :

			the_post();
			$i++;

			?>
			<li<?php if ( ($i % 3) == 0 ) echo ' class="last"'; ?>>

				<h2><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>

				<div class="content">

					<?php
					get_the_image( array( 'size' => 'loop-main', 'width' => 300, 'height' => 230, 'before' => '<div class="cover">', 'after' => '</div>' ) );
					?>

					<?php
					the_excerpt();
					?>

					<div class="cleaner">&nbsp;</div>

				</div>

			</li><?php

			if ( ($i % 3) == 0 ) { ?><div class="cleaner">&nbsp;</div><?php }

		endwhile;
		?>

	</ul>

	<div class="cleaner">&nbsp;</div><?php

	get_template_part('pagination');

else :

	?><p class="title"><?php _e('There are no posts to display', 'wpzoom'); ?></p><?php

endif;
?>

<div class="cleaner">&nbsp;</div>