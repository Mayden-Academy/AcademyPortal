<?php

namespace Portal\Entities;

class EventEntity
{
    protected $id;
    protected $name;
    protected $category;
    protected $location;
    protected $date;
    protected $startTime;
    protected $endTime;
    protected $notes;

    public function __construct(
        int $eventId = null,
        string $name = null,
        int $category = null,
        string $location = null,
        Date $date = null,
        Time $startTime = null,
        Time $endTime = null,
        string $notes = null
    ) {
        $this->id = ($this->id ?? $eventId);
        $this->name = ($this->name ?? $name);
        $this->category = ($this->category ?? $category);
        $this->location = ($this->location ?? $location);
        $this->date = ($this->date ?? $date);
        $this->startTime = ($this->startTime ?? $startTime);
        $this->endTime = ($this->endTime ?? $endTime);
        $this->notes = ($this->notes ?? $notes);

        $this->sanitiseData();
    }

    /**
     * Will sanitise all the fields for an applicant.
     */
    private function sanitiseData()
    {
        $this->id = (int) $this->id;
        $this->name = $this->sanitiseString($this->name);
        $this->category = (int)$this->category;
        $this->location = $this->sanitiseString($this->location);
        $this->date = $this->sanitiseString($this->date);
        $this->startTime = $this->sanitiseString($this->startTime);
        $this->endTime = $this->sanitiseString($this->endTime);
        $this->notes = $this->sanitiseString($this->notes);
    }

    /**(
     * Sanitise as a string in the applicant table as data.
     *
     * @param string $eventData
     *
     * @return string, which will return the applicant data.
     */
    public function sanitiseString($eventData)
    {
        return filter_var($eventData, FILTER_SANITIZE_STRING);
    }
}