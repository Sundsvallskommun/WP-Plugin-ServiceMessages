<?php if( $service_messages ): ?>
    <div class="sk-elnat-service-messages">
        <?php include( plugin_dir_path(__DIR__) . 'templates/sk-elnat-service-messages-iterator.php' ); ?>
        <?php if ($has_current_jobs) : ?>
            <div style="margin-top: 1rem;"class="row">
                <div class="col-lg-12">
                    <h3><a style="color:#e5312b;" href="http://avbrottskarta.sundsvallelnat.se/" target="_blank">Besök vår avbrottskarta </a> för geografisk översikt över pågående avbrott och planerade arbeten.</h3>
                </div>
            </div>
        <?php endif; ?>
    </div>
<?php else: ?>
    <div class="alert alert-danger" role="alert">
        För tillfället har vi ingen anslutning till våra service meddelanden!
    </div>
<?php endif; ?>

