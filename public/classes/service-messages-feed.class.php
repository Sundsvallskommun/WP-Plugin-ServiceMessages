<?php

/**
 * Main class for the custom RSS Feed.
 * Outputs feed for news to be published
 * to the intranet.
 *
 * @package SK_News_Feed
 * @author Andreas Färnstrand <andreas.farnstrand@cybercom.com>
*/
class Service_Messages_Feed {
    private $service_messages;
    private $last_modified;

    /**
     * Constructor for the main class.
     * Adds feed on init
     *
     * @since 1.0.0
     * @accesspublic
    */
    public function __construct( $service_messages, $last_modified ) {
        $this->service_messages = $service_messages;
        $this->last_modified = $last_modified;
        add_action( 'init', array( $this, 'add_rss_feed' ) );
    }

    /**
     * Register and add the custom feed.
     *
     * @since 1.0.0
     * @accesspublic
    */
    public function add_rss_feed() {
        add_feed( 'service_messages', array( $this, 'get_feed' ) );
    }

    public function test()  {
        echo 'hej';
    }

    /**
     * The feed callback for the ouput.
     * Get the template for the feed.
     *
     * @since 1.0.0
     * @accesspublic
    */
    public function get_feed() {

        $service_messages = $this->service_messages;

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
        
        header('Content-type: application/xml'); ?>

        <rss version='2.0' xmlns:atom='http://www.w3.org/2005/Atom'>

        <channel>
            <title>Pågående strömavbrott RSS-flöde</title>
            <description>Detta är ett RSS-flöde som visar pågående strömavbrott från Sundsvall Elnät.</description>
            <link>http://avbrottskarta.sundsvallelnat.se/</link>
            <lastBuildDate><?php echo $this->last_modified; ?></lastBuildDate>

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

        <?php
    }
}