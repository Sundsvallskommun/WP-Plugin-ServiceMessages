<?php
$planned_jobs_classid_numbers = array( 3101, 3102, 3103, 3201, 3202, 3203, 3208, 3301 );
$current_jobs = array();
$finnished_jobs = array();
foreach( $service_messages as $key => $value ) {
    $planned_job = in_array( $value['classid'], $planned_jobs_classid_numbers);
    $value['plannedjob'] = $planned_job;
    $finnished_job = ( $value['status'] == 3 && $value['endtime'] != "" );

    if( $finnished_job ) {
        $json_time_str = strtotime($value['endtime']);
        $json_time_new = date('Y-m-d',$json_time_str);
        $date_now = date('Y-m-d');
        $today = ( $json_time_new == $date_now );

        $value['istoday'] = $today;

        array_push( $finnished_jobs, $value );
        
    } else {
        array_push( $current_jobs, $value );
    }
}
?>


<a class="sk-elnat-toggle" data-toggle="collapse" href="#collapseCurrent" role="button" aria-expanded="false" aria-controls="collapseCurrent">
    <div class="sk-elnat-warning no-transition alert alert-warning" role="alert">
        <p class="no-transition" style="vertical-align: middle; display: inline-flex; line-height: 33px;">
            <i style="padding-right: 1rem;" class="sk-elnat-icon-32 material-icons">
                error_outline
            </i>
            <b>Pågående avbrott (<?php echo count( $current_jobs )?>)</b>
        </p>
        <i style="float: right; color: inherit;" class="sk-elnat-icon-32 material-icons">keyboard_arrow_down</i>
    </div>
</a>

<div class="collapse" id="collapseCurrent">
    <div class="sk-elnat-alert no-transition alert alert-warning" role="alert">

        <?php foreach( $current_jobs as $key => $value ): ?>

            <div class="sk-elnat-service-message-container">
                <div class="sk-elnat-icon-container">
                    <i class="sk-elnat-icon-32 material-icons">
                        <?php echo ($value['plannedjob'] ? 'error' : 'warning'); ?>
                    </i>
                </div>
                <div class="<?php echo ( $value['outagedescr'] ? 'sk-elnat-info-container' :  'sk-elnat-info-container-no-message'); ?>">
                    <b><?php echo $value['area'] ?></b>
                    <small> 
                        <?php echo ($value['plannedjob'] ? 'Planerat arbete har påbörjats' : 'Akut avbrott har uppstått'); ?>
                    </small>
                    <small class="sk-elnat-info-text"><?php if ( $value['outagedescr'] ) echo 'Meddelande: ' . $value['outagedescr']; ?></small>
                </div>
            </div>
            
            <?php if( $key != count( $current_jobs ) - 1 ) :?>
                <hr class="sk-elnat-hr">
            <?php endif; ?>
                    
        <?php endforeach; ?>

    </div>
</div>


<a class="sk-elnat-toggle" data-toggle="collapse" href="#collapseDone" role="button" aria-expanded="false" aria-controls="collapseDone">
    <div class="sk-elnat-success no-transition alert alert-success" role="alert">
        <p class="no-transition" style="vertical-align: middle; display: inline-flex; line-height: 33px;">
            <i style="padding-right: 1rem;" class="sk-elnat-icon-32 material-icons">
                check_circle_outline
            </i>
            <b>Nyligen åtgärdade avbrott</b>
        </p>
        <i style="float: right; color: inherit;" class="sk-elnat-icon-32 material-icons">keyboard_arrow_down</i>
    </div> 
</a>

    <div class="collapse" id="collapseDone">
        <div class="sk-elnat-alert alert alert-success" role="alert">

        <?php foreach( $finnished_jobs as $key => $value ): ?>

                <div class="sk-elnat-service-message-container">
                    <div class="sk-elnat-icon-container">
                        <i class="sk-elnat-icon-32 material-icons">
                        check_circle
                        </i>
                    </div>
                    <div class="<?php echo ( $value['outagedescr'] ? 'sk-elnat-info-container' :  'sk-elnat-info-container-no-message'); ?>">
                        <b><?php if ($value['area'] != "Icke definierad") echo $value['area']; ?></b>
                        <small> 
                            <?php echo ($value['plannedjob'] ? 'Planerat arbete har åtgärdats ' : 'Akut avbrott har åtgärdats ') . $value['endtime']; ?>
                        </small>
                        <small class="sk-elnat-info-text"><?php if ( $value['outagedescr'] ) echo 'Meddelande: ' . $value['outagedescr']; ?></small>
                    </div>
                </div>

                <?php if( $key != count( $finnished_jobs ) - 1 ) :?>
                    <hr class="sk-elnat-hr">
                <?php endif; ?>
                        
            <?php endforeach; ?>

        </div>
    </div>
