<?php
namespace Movie\Model;

use core\Model;
use idiorm\ORM;
use core\GException;

class Movies extends Model
{
    protected $table = 'movie';
    protected $tableReview = 'review';

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
    
    public function getList($start, $limit)
    {
        $table = ORM::for_table($this->table);
        $table->select_many(
            'id',
            'name',
            'name_native',
            'poster',
            'release_year',
            'release_date',
            'description',
            'alias'
        );
        $table->order_by_desc('release_date');
        $table->offset($start);
        $table->limit($limit);
        $records = $table->find_array();
        
        foreach ($records as $index => $movie) {
            $records[$index] = (object)$movie;
            $records[$index]->reviews_count = $this->getCountReviews($movie['id']);
        }
        
        return array(
            $records,              //list
            $table->offset(0)->count('id') //count
        );
    }

    public function getCountReviews($movieId)
    {
        $table = ORM::for_table($this->tableReview);
        return (int)$table->where('movie_id', $movieId)->count('id');
    }
    
}