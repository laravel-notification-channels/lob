<?php

namespace NotificationChannels\Lob;

class LobAddress
{
    /**
     * @var string
     */
    protected $line1 = 'postcards';

    /**
     * @var string
     */
    protected $line2;

    /**
     * @var string
     */
    protected $country;

    /**
     * @var string
     */
    protected $city;

    /**
     * @var string
     */
    protected $state;

    /**
     * @var string
     */
    protected $zip;

    /**
     * @var string
     */
    protected $name = 'name';


    /**
     * @param string $body
     *
     * @return static
     */
    public static function create($line1, $country = 'US')
    {
        return new static($line1, $country);
    }

    /**
     * @param $line1
     * @param null $name
     */
    public function __construct($line1, $country = 'US')
    {
        $this->line1 = $line1;

        $this->country = $country;
    }

    /**
     * @param mixed $value
     * @return $this
     */
    public function line2($value)
    {
        $this->line2 = $value;

        return $this;
    }

    /**
     * @param mixed $value
     * @return $this
     */
    public function country($value)
    {
        $this->country = $value;

        return $this;
    }

    /**
     * @param mixed $value
     * @return $this
     */
    public function city($value)
    {
        $this->city = $value;

        return $this;
    }

    /**
     * @param mixed $value
     * @return $this
     */
    public function state($value)
    {
        $this->state = $value;

        return $this;
    }

    /**
     * @param mixed $value
     * @return $this
     */
    public function zip($value)
    {
        $this->zip = $value;

        return $this;
    }

    /**
     * @param mixed $value
     * @return $this
     */
    public function name($value)
    {
        $this->name = $value;

        return $this;
    }

    /**
     * Get an array representation of the address.
     *
     * @return array
     */
    public function toArray()
    {
        $output = [
            'address_line1' => $this->line1,
            'address_country' => $this->country,
        ];

        if ($this->line2) {
            $output['address_line2'] = $this->line2;
        }

        if ($this->city) {
            $output['address_city'] = $this->city;
        }

        if ($this->state) {
            $output['address_state'] = $this->state;
        }

        if ($this->zip) {
            $output['address_zip'] = $this->zip;
        }

        if ($this->name) {
            $output['name'] = $this->name;
        }

        return $output;
    }
}
