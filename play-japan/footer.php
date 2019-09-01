    
            </main>

            <?php get_sidebar(); ?>

        </div>
        
        <footer>
            <div class="footer-container">
                <?php
                    wp_nav_menu( array(
                        'theme_location' => 'footer-navigation',
                        'container'      => 'div', 
                        'menu_class'     => 'footer-navigation', 
                        'menu_id'        => 'footer-navigation'
                    ));
                ?>
            </div>

            <!-- Add icon library -->
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

            <!-- Add font awesome icons -->
            <a href="#" class="fa fa-facebook"></a>
            <a href="#" class="fa fa-youtube"></a>
            <a href="#" class="fa fa-twitter"></a>
            <a href="#" class="fa fa-instagram"></a>
            <a href="#" class="fa fa-linkedin"></a>

        </footer>

        <?php wp_footer(); ?>
    
    </body>
</html>