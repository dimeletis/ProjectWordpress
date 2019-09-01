<?php get_header(); ?>

<?php if ( have_posts() ) : ?>
    <?php while( have_posts() ) : ?>
        <?php the_post(); ?>
        <article class="content">
            <h1><?php the_title(); ?></h1>
            <h4>Developer: <em><?php the_field('developer'); ?></em></h4>
            <h4>Publisher: <em><?php the_field('publisher'); ?></em></h4>
            <h4>Price: €<em><?php the_field('price'); ?></em></h4>
            <?php the_content(); ?>
            
            <?php the_category(); ?>
            <p>
                <?php the_tags(); ?>
            </p>
        </article>
    <?php endwhile; ?>
<?php endif; ?>

<?php get_footer(); ?>