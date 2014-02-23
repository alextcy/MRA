<?php
namespace Author\Model;

use core\Model;
use idiorm\ORM;
/**
 * Description of Authors
 *
 * @author alextcy
 */
class Authors extends Model
{
    protected $table = 'author';
    
    /*public function getId($alias)
    {
        $record = ORM::for_table($this->table)->where('alias', $alias)->find_one();
        if($record === false) {
            return false;
        }

        return (int)$record->id;
    }*/
    
    public function getData($authorId)
    {
        $record = ORM::for_table($this->table)->find_one($authorId);
        return $record;
    }
}
