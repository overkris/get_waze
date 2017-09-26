<?php

namespace Entity;

/**
 * LoadWaze
 *
 * @Table(name="load_waze", indexes={@Index(name="FK_load_waze_event_load", columns={"id_load"})})
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
     * @var string
     *
     * @Column(name="id_event", type="string", length=200, nullable=false)
     */
    private $idEvent;

    /**
     * @var string
     *
     * @Column(name="type_event", type="string", length=20, nullable=false)
     */
    private $typeEvent;

    /**
     * @var float
     *
     * @Column(name="coor_x", type="float", precision=10, scale=8, nullable=false)
     */
    private $coorX;

    /**
     * @var float
     *
     * @Column(name="coor_y", type="float", precision=10, scale=8, nullable=false)
     */
    private $coorY;

    /**
     * @var integer
     *
     * @Column(name="nb_up", type="smallint", nullable=false)
     */
    private $nbUp;

    /**
     * @var \EventLoad
     *
     * @ManyToOne(targetEntity="EventLoad")
     * @JoinColumns({
     *   @JoinColumn(name="id_load", referencedColumnName="id")
     * })
     */
    private $idLoad;

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
     * @return string
     */
    public function getIdEvent()
    {
        return $this->idEvent;
    }

    /**
     * @param string $idEvent
     */
    public function setIdEvent($idEvent)
    {
        $this->idEvent = $idEvent;
    }

    /**
     * @return string
     */
    public function getTypeEvent()
    {
        return $this->typeEvent;
    }

    /**
     * @param string $typeEvent
     */
    public function setTypeEvent($typeEvent)
    {
        $this->typeEvent = $typeEvent;
    }

    /**
     * @return float
     */
    public function getCoorX()
    {
        return $this->coorX;
    }

    /**
     * @param float $coorX
     */
    public function setCoorX($coorX)
    {
        $this->coorX = $coorX;
    }

    /**
     * @return float
     */
    public function getCoorY()
    {
        return $this->coorY;
    }

    /**
     * @param float $coorY
     */
    public function setCoorY($coorY)
    {
        $this->coorY = $coorY;
    }

    /**
     * @return int
     */
    public function getNbUp()
    {
        return $this->nbUp;
    }

    /**
     * @param int $nbUp
     */
    public function setNbUp($nbUp)
    {
        $this->nbUp = $nbUp;
    }

    /**
     * @return EventLoad
     */
    public function getIdLoad()
    {
        return $this->idLoad;
    }

    /**
     * @param EventLoad $idLoad
     */
    public function setIdLoad($idLoad)
    {
        $this->idLoad = $idLoad;
    }
}

