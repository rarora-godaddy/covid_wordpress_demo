<?php 

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );


class covid19_tracker_api {

    private static $api_base ='https://api.covid19api.com';
    function covid19_tracker_api()
    {
        
    }    
    function get_summary()
    {
        $summary_url = self::$api_base .'/summary';
        $resp_json = file_get_contents( $summary_url );
        return  json_decode( $resp_json, true );
    }    
    function get_country_summary($country)
    {
        $summary_url = self::$api_base .'/live/country/'.$country;
        $resp_json = file_get_contents( $summary_url );
        return json_decode( $resp_json, true );
    }
}