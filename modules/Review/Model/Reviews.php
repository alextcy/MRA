<?php
namespace Review\Model;

use core\Model;
use idiorm\ORM;

class Reviews extends Model
{
    protected $table = 'review';


    /**
     * [getList description]
     * @param  integer $movieId  [description]
     * @param  integer $authorId [description]
     * @param  integer $sourceId [description]
     * @param  integer $start    [description]
     * @param  integer  $limit    [description]
     * @return integer            [description]
     */
    public function getList($movieId=false, $authorId=false, $sourceId=false, $visible=null, $start=0, $limit=null)
    {
        $table = ORM::for_table($this->table);
        $table->select_many(
            'review.id', 
            'review.author_id',
            'review.movie_id',
            'review.source_id',
            'review.original_url',
            'review.original_date'
        );
        $table->select_expr('SUBSTR(review.content, 1, 250)', 'content');
        $table->select('author.name', 'author_name');
        //$table->select('author.alias' , 'author_alias');
        $table->select('author.avatar', 'author_avatar');

        $table->select('movie.name', 'movie_name');
        $table->select('movie.name_native', 'movie_name_native');
        $table->select('movie.poster', 'movie_poster');
        $table->select('movie.release_year', 'movie_release_year');
        $table->select('movie.alias', 'movie_alias');

        $table->select('source.name', 'source_name');

        $table->left_outer_join('author', array('review.author_id', '=', 'author.id') );
        $table->left_outer_join('movie', array('review.movie_id', '=', 'movie.id') );
        $table->left_outer_join('source', array('review.source_id', '=', 'source.id') );

        if($movieId !== false) {
            $table->where('review.movie_id', $movieId);
        }

        if($authorId !== false) {
            $table->where('review.author_id', $authorId);
        }

        if($sourceId !== false) {
            $table->where('review.source_id', $sourceId);
        }
        
        if(!is_null($visible)) {
            $table->where('review.visible', $visible);
        }

        $table->order_by_desc('review.original_date');

        if(!is_null($limit)) {
            $table->offset($start);
            $table->limit($limit);
        }

        return array(
            $table->find_many(),                  //list
            $table->offset(0)->count('review.id') //count
        );
    }
    
    
    public function getReview($reviewId)
    {
        $table = ORM::for_table($this->table);
        $table->select_many(
            'review.author_id',
            'review.movie_id',
            'review.source_id',
            'review.original_url',
            'review.original_date',
            'review.content'
        );
        $table->select('author.name', 'author_name');
        //$table->select('author.alias', 'author_alias');
        $table->select('author.avatar', 'author_avatar');
        
        $table->select('movie.name', 'movie_name');
        $table->select('movie.name_native', 'movie_name_native');
        $table->select('movie.poster', 'movie_poster');
        $table->select('movie.release_year', 'movie_release_year');
        $table->select('movie.alias', 'movie_alias');
        
        $table->select('source.name', 'source_name');

        $table->left_outer_join('author', array('review.author_id', '=', 'author.id') );
        $table->left_outer_join('movie', array('review.movie_id', '=', 'movie.id') );
        $table->left_outer_join('source', array('review.source_id', '=', 'source.id') );
        
        $table->where('review.id', $reviewId);
        return $table->find_one();
    }
    
    
    public function getData($reviewId)
    {
        $table = ORM::for_table($this->table);
        $table->select_many(
            'id',
            'author_id',
            'movie_id',
            'source_id',
            'original_url',
            'original_date',
            'content'
        );
        
        return $table->find_one($reviewId);
    }
    
    
    public function edit($reviewId)
    {
        $record = ORM::for_table($this->table)->find_one($reviewId);
        
        if($record === false) {
            throw new \core\GException('No record # '.$reviewId.' in: '.$this->table);
        }
        
        return $record;
    }


    /*public function edit($reviewId, $authorId=null, $movieId=null, $sourceId=null, $originalUrl=null, $originalDate=null, $content=null, $visible=null, $dateAdd=null)
    {
        $record = ORM::for_table($this->table)->find_one($reviewId);
        
        if($record === false) {
            throw new \core\GException('No record # '.$reviewId.' in: '.$this->table);
        }
        
        if(!is_null($authorId)) {
            $record->author_id = $authorId;
        }
        
        if(!is_null($movieId)) {
            $record->movie_id = $movieId;
        }
        
        if(!is_null($sourceId)) {
            $record->source_id = $sourceId;
        }
        
        if(!is_null($originalUrl)) {
            $record->original_url = $originalUrl;
        }
        
        if(!is_null($originalDate)) {
            $record->original_date = $originalDate;
        }
        
        if(!is_null($content)) {
            $record->content = $content;
        }
        
        if(!is_null($visible)) {
            $record->visible = $visible;
        }
        
        if(!is_null($dateAdd)) {
            $record->date_add = $dateAdd;
        }
        
        $record->save();
        return true;
    }*/
}
