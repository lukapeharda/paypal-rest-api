<?php

namespace LukaPeharda\PayPal\Billing;

class Frequency
{
    const INTERVAL_UNIT_DAY = 'DAY';
    const INTERVAL_UNIT_WEEK = 'WEEK';
    const INTERVAL_UNIT_MONTH = 'MONTH';
    const INTERVAL_UNIT_YEAR = 'YEAR';

    /**
     * @var string
     */
    protected $intervalUnit = 'MONTH';

    /**
     * @var int
     */
    protected $intervalCount = 1;

    /**
     * Create frequency object from array.
     *
     * @param   array  $data
     *
     * @return  self
     */
    public static function fromArray($data)
    {
        $frequency = new Frequency;

        if (isset($data['interval_unit'])) {
            $frequency->setIntervalUnit($data['interval_unit']);
        }

        if (isset($data['interval_count'])) {
            $frequency->setIntervalCount((int) $data['interval_count']);
        }

        return $frequency;
    }

    /**
     * Return frequency as array.
     *
     * @return  array
     */
    public function toArray()
    {
        return [
            'interval_unit' => $this->getIntervalUnit(),
            'interval_count' => $this->getIntervalCount(),
        ];
    }

    /**
     * Return interval unit.
     *
     * @return  string
     */
    public function getIntervalUnit()
    {
        return $this->intervalUnit;
    }

    /**
     * Set interval unit.
     *
     * @param   string  $intervalUnit
     *
     * @return  self
     */
    public function setIntervalUnit($intervalUnit)
    {
        $this->intervalUnit = $intervalUnit;

        return $this;
    }

    /**
     * Return interval count.
     *
     * @return  string
     */
    public function getIntervalCount()
    {
        return $this->intervalCount;
    }

    /**
     * Set interval count.
     *
     * @param   string  $intervalCount
     *
     * @return  self
     */
    public function setIntervalCount($intervalCount)
    {
        $this->intervalCount = $intervalCount;

        return $this;
    }
}
