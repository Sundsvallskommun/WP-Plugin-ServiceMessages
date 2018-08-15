<?php foreach( $service_messages as $key => $value ):
    $status = $value['status'];
    $icon = ( $status == 1 ? 'calendar_today' :  'warning');
    $has_message = $value['outagedescr'];
    $pre_dates = ( $status == 1 ? 'Planerad' :  'Startade');
    $dates_seperator = ( $status == 1 ? ' - ' :  ', beräknas åtgärdat/åtgärdades ');
    
    if( $status == 1 or $status == 2 ): ?>

        <div class="sk-elnat-service-message-container">
            <div class="sk-elnat-icon-container">
                <i class="sk-elnat-icon-32 material-icons"><?php echo $icon ?></i>
            </div>
            <div class="<?php echo ( $has_message ? 'sk-elnat-info-container' :  'sk-elnat-info-container-no-message'); ?>">
                <b><?php echo $value['area']; ?></b>
                <small> 
                    <?php echo $pre_dates . ' ' . $value['plannedstarttime'] . $dates_seperator . $value['estendtime']; ?>
                </small>
                <small class="sk-elnat-info-text"><?php echo $value['outagedescr']; ?></small>
            </div>
        </div>
        <hr class="sk-elnat-hr">
        
    <?php endif;
endforeach; ?>