<?php

namespace Entity;

/**
 * EventLoad
 *
 * @Table(name="event_load")
 * @Entity
 */
class EventLoad
{
    /**
     * @var integer
     *
     * @Column(name="id", type="integer", nullable=false)
     * @Id
     * @GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @Column(name="datetimeevent", type="datetime", nullable=false)
     */
    private $datetimeevent;

    /**
     * @var float
     *
     * @Column(name="time_load", type="float", precision=10, scale=0, nullable=false)
     */
    private $timeLoad;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return DateTime
     */
    public function getDatetimeevent()
    {
        return $this->datetimeevent;
    }

    /**
     * @param DateTime $datetimeevent
     */
    public function setDatetimeevent($datetimeevent)
    {
        $this->datetimeevent = $datetimeevent;
    }

    /**
     * @return float
     */
    public function getTimeLoad()
    {
        return $this->timeLoad;
    }

    /**
     * @param float $timeLoad
     */
    public function setTimeLoad($timeLoad)
    {
        $this->timeLoad = $timeLoad;
    }
}

