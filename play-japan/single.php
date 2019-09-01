<?php get_header(); ?>

<?php if ( have_posts() ) : ?>
    <?php while( have_posts() ) : ?>
        <?php the_post(); ?>
        <article class="content">
            <h1><?php the_title(); ?></h1>
            <p class="date">
                <?php the_time('Y M d'); ?>
            </p>
            <?php the_content(); ?>
            <?php the_category(); ?>
            <p>
                <?php the_tags(); ?>
            </p>
        </article>
    <?php endwhile; ?>
<?php endif; ?>

<?php get_footer(); ?>