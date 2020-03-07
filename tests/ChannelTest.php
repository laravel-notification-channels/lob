<?php

namespace NotificationChannels\Lob\Test;

use Illuminate\Notifications\Notifiable;
use Illuminate\Notifications\Notification;
use Lob\Lob;
use Lob\Resource\Postcards;
use Mockery;
use NotificationChannels\Lob\LobChannel;
use NotificationChannels\Lob\LobPostcard;
use PHPUnit\Framework\TestCase;

class ChannelTest extends TestCase
{
    /** @var \Lob\Lob|Mockery\Mock */
    protected $lobClient;

    /** @var \NotificationChannels\Lob\LobChannel */
    protected $channel;

    /** @var \NotificationChannels\Lob\Test\TestNotification */
    protected $notification;

    /** @var mixed */
    protected $notifiable;

    public function setUp(): void
    {
        parent::setUp();

        $this->lobClient = Mockery::mock(Lob::class);

        $this->channel = new LobChannel($this->lobClient);

        $this->notification = new TestNotification;

        $this->notifiable = new TestNotifiable;
    }

    /** @test */
    public function it_can_send_a_notification()
    {
        $message = $this->notification->toLobPostcard($this->notifiable);

        $data = $message->toArray();

        $this->lobClient->shouldReceive('postcards')->andReturn($postcard = Mockery::mock(Postcards::class));

        $postcard->shouldReceive('create')->with($data);

        $this->channel->send($this->notifiable, $this->notification);
    }

    /** @test */
    public function it_can_send_a_notification_with_default_to_address()
    {
        $notification = new TestNotificationWithToAddress;

        $message = $notification->toLobPostcard($this->notifiable);

        $data = $message->toArray();

        $this->lobClient->shouldReceive('postcards')->andReturn($postcard = Mockery::mock(Postcards::class));

        $expectedData = $data;

        $expectedData['to'] = 'address_default_id';

        $postcard->shouldReceive('create')->with($expectedData);

        $this->channel->send($this->notifiable, $notification);
    }
}

class TestNotifiable
{
    use Notifiable;

    public function routeNotificationForLob()
    {
        return 'address_default_id';
    }
}

class TestNotification extends Notification
{
    public function toLobPostcard($notifiable)
    {
        return LobPostcard::create()
            ->toAddress('address_id')
            ->front('http://image.site/image.png')
            ->message('test');
    }
}

class TestNotificationWithToAddress extends Notification
{
    public function toLobPostcard($notifiable)
    {
        return LobPostcard::create()
            ->front('http://image.site/image.png')
            ->message('test');
    }
}
