<?php
namespace Review\Model;

use core\Model;
use idiorm\ORM;

/**
 * Description of ReviewQueue
 *
 * @author alextcy
 */
class ReviewQueue extends Model
{
    const STATUS_QUEUE       = 0; //в очереди
    const STATUS_INPROGRESS  = 1; //в процессе
    const STATUS_ERROR       = 2; //ошибка
    
    protected $table = 'review_queue';
    protected $tableReview = 'review';
    
    
    /**
     * 
     * @return integer
     * @throws GException
     */
    public function getReviewIdFromQueue()
    {
        $table = ORM::for_table($this->table);
        $table->select('review_queue.review_id');
        $table->where('status', self::STATUS_QUEUE);
        $table->order_by_asc('date_add');
        $record = $table->find_one();
        if($record === false) {
            return false;
        }
        
        return (int)$record->review_id;
    }
    
    
    /**
     * @param integer $domainId
     * @return boolean
     * @throws GException
     */
    public function removeFromQueue($reviewId)
    {
        $record = ORM::for_table($this->table)->find_one($reviewId);
        if($record === false) {
            throw new GException('Ошибка удаления записи из `review_queue`. Запись отсутствует #'.$reviewId);
        }
        $record->delete();
        
        return true;
    }
    
    public function setStatusQueueInProgress($reviewId)
    {
        $record = ORM::for_table($this->table)->find_one($reviewId);
        if($record === false) {
            throw new GException('Ошибка запись отсутствует в `review_queue` #'.$reviewId);
        }
        
        $record->set('status', self::STATUS_INPROGRESS);
        $record->set('date_start', time());
        $record->save();
        
        return true;
    }
    
    public function setStatusQueueError($reviewId, $errorText)
    {
        $record = ORM::for_table($this->table)->find_one($reviewId);
        if($record === false) {
            throw new GException('Ошибка запись отсутствует в `review_queue` #'.$reviewId);
        }
        
        $record->set('status', self::STATUS_ERROR);
        $record->set('status_text', $errorText);
        $record->save();
        
        return true;
    }
}
