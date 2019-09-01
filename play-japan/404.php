<?php get_header(); ?>

<div class="container-404">
    <h2 class="page-heading">Error 404! Page not found!</h2>
    <img src="https://worldwideinterweb.com/wp-content/uploads/2012/04/funniest-404-error-messages.jpg">

    <h3>Don't worry Mario. How about visiting these following pages:</h3>
            <ul>
                <li><a href="<?php echo site_url('/category/articles') ?>">Articles</a></li>
                <li><a href="<?php echo site_url('/game') ?>">All Games</a></li>
                <li><a href="<?php echo site_url('') ?>">Home Page</a></li>
            </ul>
        </div>

<?php get_footer(); ?>