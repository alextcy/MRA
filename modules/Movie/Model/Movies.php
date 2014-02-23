<?php
namespace Movie\Model;

use core\Model;
use idiorm\ORM;
use core\GException;

class Movies extends Model
{
    protected $table = 'movie';

    public function getId($alias)
    {
        $record = ORM::for_table($this->table)->where('alias', $alias)->find_one();
        if($record === false) {
            return false;
        }

        return (int)$record->id;
    }

    /**
     * [getData description]
     * @param  integer $movieId [description]
     * @return [type]          [description]
     */
    public function getMovie($movieId)
    {
        $record = ORM::for_table($this->table)->find_one($movieId);
        if($record === false) {
            throw new GException('Запись с идентификатором: '.$movieId . ' не существует. Таблица: '.$this->table);
        }

        return $record;
    }

}