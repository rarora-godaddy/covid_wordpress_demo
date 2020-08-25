<?php
   /*
   Plugin Name: Covid19 tracker
   description: A plugin to create awesomeness and spread joy
   Version: 1.0
     */
?>
<?php 

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

function update_data( $country_slug = "" ) {
    $summary_url = "https://api.covid19api.com/summary";

    if( $country_slug == "" ) return;

    if( $country_slug == "world" ) {

        $resp_json = file_get_contents( $summary_url );
        $resp = json_decode( $resp_json, true );
        $confirmed_cases = $resp[ 'Global' ][ 'TotalConfirmed' ];
        $recovered_cases = $resp[ 'Global' ][ 'TotalRecovered' ];
        $deaths_cases = $resp[ 'Global' ][ 'TotalDeaths' ];

    } else {

        $resp_json = file_get_contents( $summary_url );
        $resp = json_decode( $resp_json, true );
        $countries = $resp[ 'Countries' ];
        $key = array_search( $country_slug, array_column( $countries, 'Slug' ) );
        $country = $countries[ $key ];
        $confirmed_cases = $country[ 'TotalConfirmed' ];
        $recovered_cases = $country[ 'TotalRecovered' ];
        $deaths_cases = $country[ 'TotalDeaths' ];
    }
    
  //  print_r($resp);
    update_option( 'covid_tracker_data_country', $country_slug );
    update_option( 'covid_tracker_data_country_deaths', $deaths_cases );
    update_option( 'covid_tracker_data_country_recovered', $recovered_cases );
    update_option( 'covid_tracker_data_country_confirmed', $confirmed_cases );
    update_option( 'covid_tracker_last_job_run_date', date( 'Y-m-d h:i:sa' ) ); 
}

update_data("world");

function get_option_values () {
    return [
        'last_job_run_date' => ( filter_var( get_option(  'covid_tracker_last_job_run_date' ), FILTER_SANITIZE_STRING ) ?: date( 'Y-m-d h:i:sa' ) ),
        'data_country' => ( filter_var( get_option(  'covid_tracker_data_country' ), FILTER_SANITIZE_STRING ) ?: '' ),
        'data_country_confirmed' => ( filter_var( get_option(  'covid_tracker_data_country_confirmed' ), FILTER_SANITIZE_NUMBER_INT ) ?: 0 ),
        'data_country_recovered' => ( filter_var( get_option(  'covid_tracker_data_country_recovered' ), FILTER_SANITIZE_NUMBER_INT ) ?: 0 ),
        'data_country_deaths' => ( filter_var( get_option(  'covid_tracker_data_country_deaths' ), FILTER_SANITIZE_NUMBER_INT ) ?: 0 ),
        
    ];
}

function display_shortcode() {

 //   echo "hrere"; exit;
    $summary_url = "https://api.covid19api.com/summary";
    $resp_json = file_get_contents( $summary_url );
    $resp = json_decode( $resp_json, true );

    
  
    $world_data = $resp['Global'];
    $country_summery = $resp['Countries'];

//    print_r($world_data);

    $html = '<style>
        .ocvb-shortcode-headline {
            font-size: 35px;
            font-family: inherit;
            line-height: 61px;

        }
        .ocvb-shortcode-country {
            font-size: 35px;
            line-height: 61px;
            color: #ea3838;
            font-weight: bold;
        }
        .ocvb-shortcode-stats-label {
            font-size: 31px;
            font-family: inherit;
            line-height: 40px;
        }
        .ocvb-shortcode-stats-value {
            font-size: 31px;
            line-height: 40px;
            color: #ea3838;
            font-weight: bold;

        }
        .ocvb-shortcode-stats-recovered-value {
            font-size: 31px;
            line-height: 40px;
            color: green;
            font-weight: bold;

        }

        .country-shortcode-div {
            border: 1px solid grey;
            width: 90%;
            margin: 0px auto;
        }    

    </style>
    <div id="world-shortcode-container">
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
                    <td> '.$each_country['Country'].' </td>
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
add_shortcode('some_random_code_sc', 'display_shortcode' );