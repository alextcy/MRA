<?php
//LOCAL
class Config
{
    const TEMPLATE_FOLDER = '/templates';

    //const DOMAINS_ITEMS_ON_PAGE = 10;
    const REVIEWS_ON_PAGE = 10;            
    

    //Production DB settings
    public static $DB = array(
        'user'   => 'root',
        'passwd' => 'root',
        'name'   => 'mra',
        'host'   => 'localhost',
        'logging'=> true,
    );

}
