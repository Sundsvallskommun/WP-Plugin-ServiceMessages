<?php 

    require_once($_SERVER['DOCUMENT_ROOT'].'/wp-load.php');
    require_once( plugin_dir_path(__DIR__) . 'classes/service-messages.class.php' );

    $file_path = get_field( 'sk_elnat_service_messages_sokvag', 'option' ); //driftmeddelanden/driftmeddelandeelnat.json
    $service_messages_raw = new Service_messages( $file_path );
    $service_messages_raw->remove_status( 1 );
    $service_messages_raw->set_valid_class_id_numbers( array(1211, 1212, 1213, 1214, 1411, 3101, 3102, 3103, 3201, 3202, 3203, 3208, 3301) );
    $service_messages = $service_messages_raw->get_service_messages();

    $planned_jobs_classid_numbers = array( 3101, 3102, 3103, 3201, 3202, 3203, 3208, 3301 );
    $current_jobs = array();
    foreach( $service_messages as $key => $value ) {
        $planned_job = in_array( $value['classid'], $planned_jobs_classid_numbers);
        $value['plannedjob'] = $planned_job;
        $finnished_job = ( $value['status'] == 3 && $value['endtime'] != "" );

        if( ! $finnished_job ) {
            array_push( $current_jobs, $value );
        }
    }
?>



<?php header('Content-type: application/xml'); ?>

<rss version='2.0' xmlns:atom='http://www.w3.org/2005/Atom'>

<channel>
    <title>Pågående strömavbrott RSS-flöde</title>
    <description>Detta är ett RSS-flöde som visar pågående strömavbrott från Sundsvall Elnät.</description>
    <link>http://avbrottskarta.sundsvallelnat.se/</link>
    <lastBuildDate><?php echo $service_messages_raw->get_modified_date(); ?></lastBuildDate>

    <?php
        foreach(  $current_jobs as $key => $value ) :
            if ( $value['area'] != "Icke definierad" ) :
                $description_beginning_text = ($value['plannedjob'] ? 'Strömavbrott i samband med planerat arbete startade: ' : 'Strömavbrott startade: ') ;
            else :
                $description_beginning_text = 'Ett strömavbrott har uppstått.'; 
            endif;

            $description_text = $description_beginning_text . $value["starttime"] . '. ' . $value["statusinfo2"] . '. ' . $value["outagedescr"] . '.';
    ?>
    <item>
        <guid><?php echo $value["id"]; ?></guid>
        <title><?php echo $value["area"]; ?> - <?php echo $value["statusinfo"]; ?></title>
        <description><?php echo $description_text; ?></description>
        <link>http://avbrottskarta.sundsvallelnat.se/</link>
    </item>
    <?php endforeach; ?>
</channel>

</rss>