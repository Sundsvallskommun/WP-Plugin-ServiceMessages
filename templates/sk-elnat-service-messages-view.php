<?php if( $service_messages ): ?>
    <div class="sk-elnat-service-messages">
        <a href="http://avbrottskarta.sundsvallelnat.se/" target="_blank">Se avbrottskarta</a>
        
        <?php include( plugin_dir_path(__DIR__) . 'templates/sk-elnat-service-messages-iterator.php' ); ?>

    </div>
<?php else: ?>
    <div class="alert alert-danger" role="alert">
        För tillfället har vi ingen anslutning till våra service meddelanden!
    </div>
<?php endif; ?>
