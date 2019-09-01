<?php get_header(); ?>

<?php if ( have_posts() ) : ?>
    <?php while( have_posts() ) : ?>
        <?php the_post(); ?>
        <article class="content">
        <a href="<?php the_permalink(); ?>">
            <h2><?php the_title(); ?></h2>
            </a>
            <?php the_post_thumbnail(); ?>
            <h4><em><?php the_field('developer'); ?></em></h4>
            <h4><em><?php the_field('publisher'); ?></em></h4>
            <h4><em><?php the_field('price'); ?></em></h4>
            <?php the_excerpt(); ?>
            <p>
                <a href="<?php the_permalink(); ?>" class="btn-readmore">Read more</a>
            </p>
            <p>
                <?php the_tags(); ?>
            </p>
        </article>
    <?php endwhile; ?>
<?php endif; ?>



<?php get_footer(); ?>