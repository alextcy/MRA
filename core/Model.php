<?php
namespace core;

use idiorm\ORM;


/**
 * Description of Model
 *
 * @author alextcy
 */
class Model
{
    
    public function __construct()
    {
        ORM::configure('mysql:host='.\Config::$DB['host'].';dbname='.\Config::$DB['name']);
        ORM::configure('username', \Config::$DB['user']);
        ORM::configure('password', \Config::$DB['passwd']);
        ORM::configure('logging' , \Config::$DB['logging']);
        //Collections of results can be returned as an array (default) or as a result set. See the find_result_set() documentation for more information.
        //ORM::configure('return_result_sets', true); //
        ORM::configure('driver_options', array(\PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
        
        //настройки 'table name'=>'primary key name'
        ORM::configure('id_column_overrides', array(
            'review_queue' => 'review_id'
            //'file_template'    => 'subject_id',
            //'config_deploy'    => 'domain_id',
            //'domains_file'     => 'domain_id',
            //'domain_registration' => 'domain_id',
            //'satellites_deploy' => 'domain_id'
        ));
    }
    
    
}


