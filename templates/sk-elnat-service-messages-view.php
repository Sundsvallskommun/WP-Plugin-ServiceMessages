<?php if( $service_messages ): ?>
    <div class="sk-elnat-service-messages">
        <small>Service meddelanden (<?php echo count( $service_messages ) ?>)</small>
        <div class="sk-elnat-alert alert alert-warning" role="alert">
            <div class="sk-elnat-expandeble-area">
                <?php foreach( $service_messages as $key => $value ) { 
                    if( $value['status'] == 1 ) {
                        include(plugin_dir_path(__DIR__) . 'templates/sk-elnat-planned-service-view.php');
                    } elseif ( $value['status'] == 2 ) {
                        include(plugin_dir_path(__DIR__) . 'templates/sk-elnat-ongoing-service-view.php');
                    }
                    echo '<hr class="sk-elnat-hr">';
                } ?>
            </div>
            <div class="sk-elnat-expand-button-container">
                <i class="sk-elnat-expand-button material-icons">expand_more</i>
            </div>
        </div>
    </div>
<?php else: ?>
<div class="alert alert-danger" role="alert">
    JSON-fil ej hittat under "<?php echo get_field( 'sk_elnat_service_messages_sokvag', 'option' ); ?>"—Ändra inställningar under "Service Meddelanden"
</div>
<?php endif; ?>

