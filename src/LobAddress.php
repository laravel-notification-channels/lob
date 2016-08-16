<?php

namespace NotificationChannels\Lob;

class LobAddress
{
    /** @var string */
    protected $line1 = 'postcards';

    /** @var string */
    protected $line2;

    /** @var string */
    protected $country;

    /**  @var string */
    protected $city;

    /** @var string */
    protected $state;

    /** @var string */
    protected $zip;

    /** @var string */
    protected $name = 'name';


    /**
     * @param string $line1
     * @param string $country
     *
     * @return static
     *
     */
    public static function create($line1, $country = 'US')
    {
        return new static($line1, $country);
    }

    /**
     * @param string $line1
     * @param string $country
     */
    public function __construct($line1, $country = 'US')
    {
        $this->line1 = $line1;

        $this->country = $country;
    }

    /**
     * @param string $line2
     *
     * @return $this
     */
    public function line2($line2)
    {
        $this->line2 = $line2;

        return $this;
    }

    /**
     * @param string $country
     *
     * @return $this
     */
    public function country($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * @param string $city
     *
     * @return $this
     */
    public function city($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * @param string $state
     *
     * @return $this
     */
    public function state($state)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * @param string $zip
     *
     * @return $this
     */
    public function zip($zip)
    {
        $this->zip = $zip;

        return $this;
    }

    /**
     * @param string $name
     *
     * @return $this
     */
    public function name($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get an array representation of the address.
     *
     * @return array
     */
    public function toArray()
    {
        return array_filter([
            'address_line1' => $this->line1,
            'address_country' => $this->country,
            'address_line2' => $this->line2,
            'address_city' => $this->city,
            'address_state' => $this->state,
            'address_zip' => $this->zip,
            'name' => $this->name,
        ]);
    }
}
