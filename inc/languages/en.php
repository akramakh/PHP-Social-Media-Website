<?php

function lang( $phrase ){
    static $lang = array(
        //Navbar Links
        'HOME_ADMEN'        => 'admin area',
        'NAFICATIONS'       => ' Nafications',
        'MESSAGES'          => ' Messages',
        'PROFILE'           => ' Profile',
        'HOME'              => ' Home',
        'LOGS'              => ' Logs',
        
    
    );
    return $lang[$phrase];
}