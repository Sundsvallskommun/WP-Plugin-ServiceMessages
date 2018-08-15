<?php if( $service_messages ): ?>
    <div class="sk-elnat-service-messages">
        <small>Service meddelanden (<?php echo count( $service_messages ) ?>)</small>
        <div class="sk-elnat-alert alert alert-warning" role="alert">
            <div class="sk-elnat-expandeble-area">
                <?php include( plugin_dir_path(__DIR__) . 'templates/sk-elnat-service-messages-iterator.php' ); ?>
            </div>
            <div class="sk-elnat-expand-button-container">
                <i class="sk-elnat-expand-button material-icons">expand_more</i>
            </div>
        </div>
    </div>
<?php else: ?>
    <div class="alert alert-danger" role="alert">
        För tillfället har vi ingen anslutning till våra service meddelanden!
    </div>
<?php endif; ?>

