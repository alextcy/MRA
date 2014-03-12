<?php
namespace Review\Model;

use core\Model;
use idiorm\ORM;


/**
 * Поиск по названию фильма, по имени автора, по названию источника
 * для админки при добавлении рецензии в очередь
 *
 * @author alextcy
 */
class Search extends Model
{
    protected $tableMovie = 'movie';
    protected $tableAuthor = 'author';
    protected $tableSource = 'source';
    
    public function find($type, $keyword)
    {
        switch ($type) {
            case $this->tableMovie:
                return $this->searchMovie($keyword);
                break;
            
            case $this->tableAuthor:
                return $this->searchAuthor($keyword);
                break;
            
            case $this->tableSource:
                return $this->searchSource($keyword);
                break;
        }
    }
    
    protected function searchMovie($keyword)
    {
        $table = ORM::for_table($this->tableMovie);
        $table->select('id');
        $table->select('name');
        $table->select('name_native');
        $table->where_raw('(`name` like ? OR `name_native`  like ?)', array('%'.$keyword.'%', '%'.$keyword.'%'));
        //$table->where_like('name', '%'.$keyword.'%');
        //$table->where_like('name_native', '%'.$keyword.'%');
        return $table->find_array();
    }
    
    protected function searchAuthor($keyword)
    {
        $table = ORM::for_table($this->tableAuthor);
        $table->select('id');
        $table->select('name');
        //$table->where_raw('(`name` like ? OR `name_native`  like ?)', array('%'.$keyword.'%', '%'.$keyword.'%'));
        $table->where_like('name', '%'.$keyword.'%');
        
        return $table->find_array();
    }
    
    protected function searchSource($keyword)
    {
        $table = ORM::for_table($this->tableSource);
        $table->select('id');
        $table->select('name');
        $table->where_raw('(`name` like ? OR `url`  like ?)', array('%'.$keyword.'%', '%'.$keyword.'%'));
        
        return $table->find_array();
    }
    
}
