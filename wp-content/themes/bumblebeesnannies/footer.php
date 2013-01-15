    </div><!-- #main -->     
</div><!-- #wrapper -->

<div id="footer">
    <div class="wrapper">
        <div class="column">
            <span>Bumble Bees Nannies</span>
            <ul>
                <li>&copy; <?php echo date("Y"); ?></li>
            </ul>
        </div>
        <div class="column">
            <span>Services</span><br />
            <?php wp_nav_menu( array( 'theme_location' => 'footer-services') ); ?>
        </div>
        <div class="column">
            <span>Toronto Service Areas</span><br />
            <ul>
                <li>Beaches/Leslieville/Riverdale<br />Danforth/Scarborough</li>
                <li>Roncesvalles/Ossington/<br />High Park</li>
                <li>Leaside/Rosedale/<br />Summerhill</li>
                <li>Davisville/Eglinton/<br />Lawrence</li>
            </ul>
        </div>
        <div class="column">
            <span>More Information</span><br />
            <?php wp_nav_menu( array( 'theme_location' => 'footer-information') ); ?>
            <a href="http://www.twitter.com/BumbleBeesNanny" target="_blank"><div class="social-twitter"></div></a>
            <a href="http://www.facebook.com/BumbleBeesNanniesInc" target="_blank"><div class="social-facebook"></div></a>
        </div>
    </div>
</div><!-- #footer -->

<?php wp_footer(); ?>
</body>
</html>