<!-- Start the Loop. -->
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <!--post start-->
        <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <div class="post_header clearfix">
                <h1 class="post_title"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
                <div class="post_date">
                    <ul class="date">
                        <li class="day"><?php echo get_the_time('d') ?></li>
                        <li class="month"><?php echo get_the_time('F') ?></li>
                        <li class="year"><?php echo get_the_time('Y') ?></li>
                    </ul>
                </div>
                <ul class="post_meta">
                    <li class="posted_by"><?php _e('By', 'poloray'); ?>&nbsp;&nbsp; <?php the_author_posts_link(); ?></li>
                    <li class="post_category">&nbsp;&nbsp;<?php the_category(', '); ?></li>
                    <li class="post_comment">&nbsp;&nbsp;<?php comments_popup_link('No Comments.', '1 Comment.', '% Comments.'); ?></li>
                </ul>
            </div>
            <div class="post_content">
                <?php
                if ((function_exists('has_post_thumbnail')) && (has_post_thumbnail())) {
                    ?><a href="<?php the_permalink() ?>"><?php the_post_thumbnail('thumbnail', array('class' => 'postimg')); ?></a>
                    <?php
                }
                ?>
                <?php the_excerpt(); ?>
                <a class="read_more" href="<?php the_permalink() ?>"><?php _e('read more', 'poloray'); ?></a> </div>
        </div>
        <!--End Post-->
    <?php
    endwhile;
else:
    ?>
    <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <p>
    <?php _e('Sorry, no posts matched your criteria.', 'poloray'); ?>
        </p>
    </div>
<?php endif; ?>
<!--End Loop-->