<?php

namespace NotificationChannels\Lob\Test;

use Illuminate\Notifications\Notifiable;
use Illuminate\Notifications\Notification;
use Lob\Lob;
use Lob\Resource\Postcards;
use Mockery;
use NotificationChannels\Lob\LobChannel;
use NotificationChannels\Lob\LobPostcard;
use PHPUnit_Framework_TestCase;

class ChannelTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->lobClient = Mockery::mock(Lob::class);

        $this->channel = new LobChannel($this->lobClient);

        $this->notification = new TestNotification;

        $this->notifiable = new TestNotifiable;
    }

    public function tearDown()
    {
        parent::tearDown();
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
}

class TestNotifiable
{
    use Notifiable;

    public function routeNotificationForPusherPushNotifications()
    {
        return 'interest_name';
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
