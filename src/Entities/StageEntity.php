<?php

namespace Portal\Entities;

use Portal\Validators\StringValidator;

class StageEntity implements \JsonSerializable
{
    protected $id;
    protected $title;
    protected $order;
    protected $deleted;

    public function __construct($title = null, $order = null)
    {
        $this->title = ($this->title ?? $title);
        $this->order = ($this->order ?? $order);
        $this->deleted = 0;

        $this->sanitiseData();
    }

    /**
     * Returns private properties from object.
     *
     * @return array|mixed
     */
    public function jsonSerialize()
    {

        return [
            'id' => $this->id,
            'title' => $this->title,
            'order' => $this->order
        ];
    }

    /**
     * Will sanitise all the fields for a stage.
     */
    private function sanitiseData()
    {
        $this->id = (int) $this->id;
        $this->title = StringValidator::sanitiseString($this->title);

        try {
            $this->title = StringValidator::validateLength($this->title, 255);
        } catch (\Exception $exception) {
            $this->title = substr($this->title, 0, 254);
        }

        $this->order = (int) $this->order;
        $this->deleted = (int) $this->deleted;
    }

    /**
     *  Get stage id
     *
     * @return mixed
     */
    public function getStageId()
    {
        return $this->id;
    }

    /**
     * Get's stage title.
     *
     * @return string, returns the stage title field.
     */
    public function getStageTitle(): string
    {
        return $this->title;
    }

    /**
     * Get's stage order.
     *
     * @return int, returns the stage order field.
     */
    public function getStageOrder(): int
    {
        return $this->order;
    }

    /**
     * Get stage deleted
     *
     * @return string
     */
    public function getStageDeleted() : int
    {
        return $this->deleted;
    }
}