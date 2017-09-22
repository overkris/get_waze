<?php
namespace Entity;

/**
 * LoadWaze
 *
 * @Table(name="load_waze", indexes={@Index(name="FK_load_waze_event_load", columns={"id_event"})})
 * @Entity
 */
class LoadWaze
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
     * @var boolean
     *
     * @Column(name="segment", type="smallint", nullable=false)
     */
    private $segment;

    /**
     * @var string
     *
     * @Column(name="return_api", type="text", nullable=false)
     */
    private $returnApi;

    /**
     * @var \EventLoad
     *
     * @ManyToOne(targetEntity="EventLoad")
     * @JoinColumns({
     *   @JoinColumn(name="id_event", referencedColumnName="id")
     * })
     */
    private $idEvent;

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
     * @return bool
     */
    public function isSegment()
    {
        return $this->segment;
    }

    /**
     * @param bool $segment
     */
    public function setSegment($segment)
    {
        $this->segment = $segment;
    }

    /**
     * @return string
     */
    public function getReturnApi()
    {
        return $this->returnApi;
    }

    /**
     * @param string $returnApi
     */
    public function setReturnApi($returnApi)
    {
        $this->returnApi = $returnApi;
    }

    /**
     * @return EventLoad
     */
    public function getIdEvent()
    {
        return $this->idEvent;
    }

    /**
     * @param EventLoad $idEvent
     */
    public function setIdEvent($idEvent)
    {
        $this->idEvent = $idEvent;
    }


}

