<?php
/**
 * Created by PhpStorm.
 * User: santosh
 * Date: 4/7/19
 * Time: 12:26 PM
 */

namespace App\Repository;


use App\Event;

class EventRepository
{
    /**
     * @var Event
     */
    private $event;


    /**
     * EventRepository constructor.
     */
    public function __construct(Event $event)
    {
        $this->event = $event;
    }

    public function findById($id)
    {
        $event = $this->event->find($id);
        return $event;
    }

    public function getAll()
    {
        return $this->event->all();
    }

    public function getEventByOrganizer($id)
    {
        $event = $this->event->where('organizer_id',$id)->get();
        return $event;
    }
}