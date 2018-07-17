<?php if( $service_messages ): ?>
    <div class="sk-elnat-service-messages">
        <span><small>Service meddelanden (<?php echo count( $service_messages ) ?>)</small></span>
        <div class="sk-elnat-alert alert alert-warning" role="alert">
            <div class="sk-elnat-expandeble">
                <?php foreach( $service_messages as $key => $value ) : ?>
                    <?php if( $value['status'] == 1 ): ?>
                        <div class="icon-container">
                            <div class="icon-div">
                                <i class="icon-48 material-icons">error</i>
                            </div>
                            <div class="info-div">
                                <span class="info-title"><small><?php echo $value['area']; ?> - Planerad fr.o.m. <?php echo $value['plannedstarttime']; ?></small></span>
                                <span class="info-text"><?php echo $value['outagedescr']; ?></span>
                            </div>
                        </div>
                    <?php elseif ( $value['status'] == 2 ): ?>
                        <div class="icon-container">
                            <div class="icon-div">
                                <i class="icon-48 material-icons">warning</i>
                            </div>
                            <div class="info-div">
                                <span class="info-title"><small><?php echo $value['area']; ?> - Pågående t.o.m. <?php echo $value['estendtime']; ?></small></span>
                                <span class="info-text"><?php echo $value['outagedescr']; ?></span>
                            </div>
                        </div>
                    <?php endif; ?>
                    <hr>
                <?php endforeach; ?>
            </div>
            <div class="sk-elnat-center">
                <i class="sk-elnat-expand-button material-icons">expand_more</i>
            </div>
        </div>
    </div>
<?php else: ?>
    <div class="alert alert-danger" role="alert">
        JSON-fil ej hittat under "<?php echo get_field( 'sk_elnat_service_messages_sokvag', 'option' ); ?>"—Ändra inställningar under "Service Meddelanden"
    </div>
<?php endif; ?>

