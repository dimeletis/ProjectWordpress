<?php get_header(); ?>

<h1 class="page-heading">Search Results for: <em><?php echo get_search_query(); ?></em></h1>

<?php if ( have_posts() ) { ?>
    <?php while( have_posts() ) : ?>
        <?php the_post(); ?>
        <article class="content">
        <a href="<?php the_permalink(); ?>">
            <h2><?php the_title(); ?></h2>
            </a>
            <p class="date">
                <?php the_time('Y M d'); ?>
            </p>
            <?php the_excerpt(); ?>
            <p>
                <a href="<?php the_permalink(); ?>" class="btn-readmore">Read more</a>
            </p>
            <p>
                <?php the_tags(); ?>
            </p>
        </article>
    <?php endwhile; ?>
    <?php } else { ?>
    
        <div class="no-results">
            <h3>Oops couldn't find anything</h3>
            <h3>Don't worry. Check out these following pages:</h3>
            <ul>
                <li><a href="<?php echo site_url('/category/articles') ?>">Articles</a></li>
                <li><a href="<?php echo site_url('/game') ?>">All Games</a></li>
                <li><a href="<?php echo site_url('') ?>">Home Page</a></li>
            </ul>
        </div>

    <?php } ?>

<div class="pagination">
<?php echo paginate_links(); ?>
</div>

<?php get_footer(); ?>