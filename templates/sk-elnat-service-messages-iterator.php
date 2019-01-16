<?php
function cmp($a, $b)
{
    if($a['endtime'] == $b['endtime']){ return 0 ; }
	return ($a['endtime'] > $b['endtime']) ? -1 : 1;
}

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

//Sort $finnished_jobs (2D array) by date
usort($finnished_jobs, function ($a, $b)
{
    if($a['endtime'] == $b['endtime']){ return 0 ; }
	return ($a['endtime'] > $b['endtime']) ? -1 : 1;
});
//$current_jobs = [];
$has_current_jobs = (sizeof($current_jobs) > 0);
?>

<div class="row">
<?php if ($has_current_jobs) : ?>
    <div class="col-lg-6 sk-elnat-col">
        <a class="sk-elnat-toggle" data-toggle="collapse" href="#collapseCurrent" role="button" aria-expanded="false" aria-controls="collapseCurrent">
            <div class="sk-elnat-warning no-transition alert alert-warning" role="alert">
                <p class="no-transition" style="vertical-align: middle; display: inline-flex; line-height: 33px;">
                    <i style="padding-right: .3rem;" class="sk-elnat-icon-32 material-icons">
                        error_outline
                    </i>
                    <b>Pågående strömavbrott (<?php echo count( $current_jobs )?>)</b>
                </p>
                <i style="float: right; color: inherit;" class="sk-elnat-icon-32 material-icons">keyboard_arrow_down</i>
            </div>
        </a>

        <div class="collapse" id="collapseCurrent">
            <div class="no-transition alert alert-warning" role="alert">

                <?php foreach( $current_jobs as $key => $value ): ?>
                    <?php if ( $value['area'] != "Icke definierad" ) echo '<b style="display: block;">' . $value['area'] . '</b>'; ?>
                    <p data-id="<?php echo $value['id']; ?>" class="no-transition" style="display: inline-block;">
                        <i class="material-icons" style="vertical-align: middle; margin-top: -3px; margin-right: .2rem;">
                            <?php echo ($value['plannedjob'] ? 'error' : 'warning'); ?>
                        </i>
                        <?php if ( $value['area'] != "Icke definierad" ) : ?>
                            <?php echo ($value['plannedjob'] ? 'Strömavbrott i samband med planerat arbete startade: ' : 'Strömavbrott startade: ') ; ?>
                        <?php else : ?>
                            Ett strömavbrott har uppstått. 
                        <?php endif; ?>
                    </p>
                    <small style="display: inline-block;"><?php echo date("Y-m-d H:i", strtotime($value['starttime'])); ?></small>

                    <small style="display: block;">
                        <?php 
                            if ( $value['area'] == "Icke definierad" ) echo "Vi felsöker orsaken och vilket geografiskt område som är påverkat. ";
                            if ( $value['statusinfo'] != 'Ej definerad' ) echo $value['statusinfo'] . ". ";
                            if ( $value['statusinfo2'] != 'Meddelas senare' ) echo $value['statusinfo2'] . ". ";
                            echo $value['outagedescr'] 
                        ?>
                    </small>

                    <?php if ( $key < count($current_jobs)-1 ) : ?>
                        <hr class="sk-elnat-hr">
                    <?php endif; ?>
                <?php endforeach; ?>

            </div>
        </div>
    </div>
<?php endif; ?>
    <div class="<?php echo $has_current_jobs ? 'col-lg-6' : 'col-lg-12'; ?> sk-elnat-col">
        <a class="sk-elnat-toggle" data-toggle="collapse" href="#collapseDone" role="button" aria-expanded="false" aria-controls="collapseDone">
            <div class="sk-elnat-success no-transition alert alert-success" role="alert">
                <p class="no-transition" style="vertical-align: middle; display: inline-flex; line-height: 33px;">
                    <i style="padding-right: .3rem;" class="sk-elnat-icon-32 material-icons">
                        check_circle_outline
                    </i>
                    <b><?php echo $has_current_jobs ? 'Nyligen åtgärdade strömavbrott' : 'Vi har för tillfället inga strömavbrott'; ?></b>
                </p>
                <i style="float: right; color: inherit;" class="sk-elnat-icon-32 material-icons">keyboard_arrow_down</i>
            </div> 
        </a>

        <div class="collapse" id="collapseDone">
            <div class="sk-elnat-alert alert alert-success" role="alert">

                <?php foreach( $finnished_jobs as $key => $value ): ?>
                    <?php if ( $value['area'] != "Icke definierad" ) echo '<b style="display: block;">' . $value['area'] . '</b>'; ?>
                    <p data-id="<?php echo $value['id']; ?>" class="no-transition" style="display: inline-block;">
                        <i class="material-icons" style="vertical-align: middle; margin-top: -3px; margin-right: .2rem;">
                            check_circle
                        </i>
                        <?php echo ($value['plannedjob'] ? 'Strömavbrott i samband med planerat arbete pågick:<br>' : 'Strömavbrott pågick:<br>'); ?>
                    </p>

                    <small style="display: inline-block;"><?php echo date("Y-m-d H:i", strtotime($value['starttime'])) . ' - ' . date("Y-m-d H:i", strtotime($value['endtime'])); ?></small>

                    <small style="display: block;">
                        <?php
                            if ( $value['statusinfo'] != 'Ej definerad' ) echo $value['statusinfo'] . ". ";
                            if ( $value['statusinfo2'] != 'Meddelas senare' ) echo $value['statusinfo2'] . ". ";
                            echo $value['outagedescr'] 
                        ?>  
                    </small>

                    <?php if ( $key < count($finnished_jobs)-1 ) : ?>
                        <hr class="sk-elnat-hr">
                    <?php endif; ?>        
                <?php endforeach; ?>

            </div>
        </div>
    </div>
</div>

