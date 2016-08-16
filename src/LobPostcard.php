<?php

namespace NotificationChannels\Lob;

class LobPostcard
{
    /** @var string */
    public $type = 'postcards';

    /** @var string|null */
    protected $fromAddress = null;

    /** @var string|null */
    protected $toAddress = null;

    /** @var string */
    protected $front;

    /** @var string */
    protected $message;

    /** @var string */
    protected $size = '4x6';

    /**
     * @param string $message
     *
     * @return static
     */
    public static function create($message = '')
    {
        return new static($message);
    }

    /**
     * @param string $message
     */
    public function __construct($message = '')
    {
        $this->message = $message;
    }

    /**
     * @param string|LobAddress $value
     *
     * @return $this
     */
    public function fromAddress($value)
    {
        $this->fromAddress = is_string($value) ? $value : $value->toArray();

        return $this;
    }

    /**
     * @param string|LobAddress $value
     *
     * @return $this
     */
    public function toAddress($value)
    {
        $this->toAddress = is_string($value) ? $value : $value->toArray();

        return $this;
    }

    /**
     * @param mixed $front
     *
     * @return $this
     */
    public function front($front)
    {
        $this->front = $front;

        return $this;
    }

    /**
     * @param string $message
     *
     * @return $this
     */
    public function message($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * @param string $size
     *
     * @return $this
     */
    public function size($size)
    {
        $this->size = $size;

        return $this;
    }

    /**
     * @return $this
     */
    public function size4x6()
    {
        $this->size = '4x6';

        return $this;
    }

    /**
     * @return $this
     */
    public function size6x11()
    {
        $this->size = '6x11';

        return $this;
    }

    /**
     * Get an array representation of the message.
     *
     * @return array
     */
    public function toArray()
    {
        return array_filter([
            'to' => $this->toAddress,
            'from' => $this->fromAddress,
            'front' => $this->front,
            'message' => $this->message,
            'size' => $this->size,
        ]);
    }
}
