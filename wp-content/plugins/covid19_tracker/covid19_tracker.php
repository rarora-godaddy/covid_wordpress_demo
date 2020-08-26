<?php
   /*
   Plugin Name: Covid19 tracker
   description: A plugin to create awesomeness and spread joy
   Version: 1.0
     */
?>
<?php 

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

require_once 'covid19_tracker_api.php';   

class covid19_tracker {

    function covid19_tracker()
    {
        add_shortcode('covid19_tracker', array( $this,'tracker_shortcode') );
        add_action( 'wp_print_styles', array( $this, 'tracker_stylesheet') );
    }
    public function tracker_stylesheet()
    {
        wp_register_style('tracker_stylesheet', '/wp-content/plugins/covid19_tracker/assets/css/covid_tracker.css');
        wp_enqueue_style('tracker_stylesheet');

    }
    public function get_world_summery()
    {

        $resp = covid19_tracker_api :: get_summary();
     
        $world_data = $resp['Global'];
        $country_summery = $resp['Countries'];
    
        //    print_r($world_data);
    
        $html = '<div id="world-shortcode-container">
                    <div class="grid-y align-middle ocvb-shortcode">
                        <div class="cell small-2">
                            <div class="ocvb-shortcode-headline">Coronavirus Cases</div>
                            <div class="ocvb-shortcode-country">'.$world_data['TotalConfirmed'].'</div>
                        </div>
                        <div class="ocvb-shortcode-stats cell small-9">
                            <div class="ocvb-shortcode-stats-recovered grid-x grid-padding-y">
                                <div class="ocvb-shortcode-stats-label cell small-7">Recovered cases</div>
                                <div class="ocvb-shortcode-stats-recovered-value cell small-5">'.$world_data['TotalRecovered'].'</div>
                            </div>
                            <div class="ocvb-shortcode-stats-deaths grid-x grid-padding-y">
                                <div class="ocvb-shortcode-stats-label cell small-7">Death cases</div>
                                <div class="ocvb-shortcode-stats-value cell small-5">'.$world_data['TotalDeaths'].'</div>
                            </div>
                        </div>
                    </div>
                </div>';
    
        $html .= '<div class="country-shortcode-div"> <table id="country-shortcode-container" class="display" > 
                    <thead><tr>
                        <th>Country Name </th>
                        <th> Total Cases </th>
                        <th> New Cases </th>
                        <th> Total Recovered </th>
                        <th> New Recovered </th>
                        <th> Total Deaths </th>
                        <th> New Deaths </th>
                        
                    </tr></thead><tbody>';
    
        
        
    
        foreach ($country_summery as  $each_country)  
        { 
            $html .= '<tr>
                        <td> <a href="/country/'.$each_country['Country'].'/" >'.$each_country['Country'].' </a></td>
                        <td> '.$each_country['TotalConfirmed'].' </td>
                        <td> '.$each_country['NewConfirmed'].' </td>
                        <td> '.$each_country['TotalRecovered'].' </td>
                        <td> '.$each_country['NewRecovered'].' </td>
                        <td> '.$each_country['TotalDeaths'].' </td>
                        <td> '.$each_country['NewDeaths'].'  </td>
                    </tr>';
        }
        $html .= '</tbody><tfoot><tr>
                        <th>Country Name </th>
                        <th> Total Cases </th>
                        <th> New Cases </th>
                        <th> Total Recovered </th>
                        <th> New Recovered </th>
                        <th> Total Deaths </th>
                        <th> New Deaths </th>
                        
                    </tr></tfoot>';
        $html .= '</table> </div>';
        return $html;
    }

    public function get_country_summary($country)
    {
        $resp = covid19_tracker_api :: get_country_summary($country);

        $country_data = end($resp) ;
 
        $html = '<div id="world-shortcode-container">
            <div class="grid-y align-middle ocvb-shortcode">
                <div class="cell small-2">
                    <div class="ocvb-shortcode-headline">Coronavirus Cases - '.$country.' </div>
                    <div class="ocvb-shortcode-country">'.$country_data['Confirmed'].'</div>
                </div>
                <div class="ocvb-shortcode-stats cell small-9">
                    <div class="ocvb-shortcode-stats-recovered grid-x grid-padding-y">
                        <div class="ocvb-shortcode-stats-label cell small-7">Recovered cases</div>
                        <div class="ocvb-shortcode-stats-recovered-value cell small-5">'.$country_data['Recovered'].'</div>
                    </div>
                    <div class="ocvb-shortcode-stats-deaths grid-x grid-padding-y">
                        <div class="ocvb-shortcode-stats-label cell small-7">Death cases</div>
                        <div class="ocvb-shortcode-stats-value cell small-5">'.$country_data['Deaths'].'</div>
                    </div>
                </div>
            </div>
        </div>';


        return $html;

    }
    public function tracker_shortcode() {
     
        $country = get_query_var('country');
      
        if($country) 
            return $this->get_country_summary($country);
        
        return $this->get_world_summery();

    }
}

new covid19_tracker();
