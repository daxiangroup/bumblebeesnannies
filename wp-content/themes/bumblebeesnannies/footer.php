    </div><!-- #main -->     
</div><!-- #wrapper -->

<div id="footer">
    <div class="wrapper">
        <div class="column">
            <span>Bumble Bees Nannies</span><br />
            &copy; 2012
        </div>
        <div class="column">
            <span>Services</span><br />
            <?php wp_nav_menu( array( 'theme_location' => 'footer-services') ); ?>
        </div>
        <div class="column">
            <span>Toronto Service Areas</span><br />
            <?php wp_nav_menu( array( 'theme_location' => 'footer-service-areas') ); ?>
        </div>
        <div class="column">
            <span>More Information</span><br />
            <?php wp_nav_menu( array( 'theme_location' => 'footer-information') ); ?>
        </div>
    </div>
</div><!-- #footer -->

</body>
</html>