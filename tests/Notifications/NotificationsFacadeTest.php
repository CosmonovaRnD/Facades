<?php
declare(strict_types=1);

namespace CosmonovaRnD\Adapters\Tests\Notifications;

use CosmonovaRnD\Facades\Notifications\DTO\Delivery;
use CosmonovaRnD\Facades\Notifications\DTO\Notification;
use CosmonovaRnD\Facades\Notifications\DTO\NotificationProgress;
use CosmonovaRnD\Facades\Notifications\DTO\NotificationResult;
use CosmonovaRnD\Facades\Notifications\NotificationsFacade;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;

/**
 * Class NotificationsFacadeTest
 *
 * @author Serhii Kondratiuk <serhii.kondratiuk@cosmonova.net>
 * @package CosmonovaRnD\Adapters\Tests\Notifications
 * @since   1.2.0
 * Cosmonova | Research & Development
 */
class NotificationsFacadeTest extends TestCase
{
    /**
     * @var string
     */
    private static $baseApiUrl = 'http://some.host/api';

    /**
     * @throws \CosmonovaRnD\Facades\Notifications\NotificationsException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function testGetNotifications()
    {
        $token = 'some-token';
        $data = [
            [
                'id' => 1,
                'created_at' => '2018-02-06T12:46:29+00:00',
                'created_by' => 'admin',
                'type' => 'EMAIL',
                'subject' => 'Your subject',
                'receivers' => ['serhii.kondratiuk@cosmonova.net'],
                'sender' => 'serhii.kondratiuk@cosmonova.net',
                'placeholders' => null,
                'html' => 'Your text',
                'text' => 'Your text',
                'sent_counter' => 0,
                'delivered_counter' => 0,
                'schedule_time' => null,
                'translit' => null,
                'rejected_counter' => 0,
                'total' => 1
            ],
            [
                'id' => 1,
                'created_at' => '2018-02-06T12:46:29+00:00',
                'created_by' => 'admin',
                'type' => 'SMS',
                'subject' => 'Your subject',
                'receivers' => ['3801087650321'],
                'sender' => null,
                'placeholders' => null,
                'html' => null,
                'text' => 'Your text',
                'sent_counter' => 0,
                'delivered_counter' => 0,
                'schedule_time' => null,
                'translit' => false,
                'rejected_counter' => 0,
                'total' => 1
            ]
        ];

        $client = $this->createClient($data, 200);
        $notificationsFacade = new NotificationsFacade($client, self::$baseApiUrl);
        $notifications = $notificationsFacade->getNotifications($token);
        $this->assertContainsOnlyInstancesOf(Notification::class, $notifications);
    }

    /**
     * @throws \CosmonovaRnD\Facades\Notifications\NotificationsException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function testGetNotificationProgress()
    {
        $token = 'some-token';
        $data = [
            'total' => 2,
            'sent' => 2,
            'delivered' => 2,
            'rejected' => 0
        ];

        $client = $this->createClient($data, 200);
        $notificationsFacade = new NotificationsFacade($client, self::$baseApiUrl);
        $notificationProgress = $notificationsFacade->getNotificationProgress(172, $token);
        $this->assertInstanceOf(NotificationProgress::class, $notificationProgress);
    }

    /**
     * @throws \CosmonovaRnD\Facades\Notifications\NotificationsException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function testGetNotification()
    {
        $token = 'some-token';
        $data = [
            'id' => 172,
            'created_at' => '2018-02-06T12:46:29+00:00',
            'created_by' => 'admin',
            'type' => 'SMS',
            'subject' => 'Your subject',
            'receivers' => ['3801087650321'],
            'sender' => null,
            'placeholders' => null,
            'html' => null,
            'text' => 'Your text',
            'sent_counter' => 0,
            'delivered_counter' => 0,
            'schedule_time' => null,
            'translit' => false,
            'rejected_counter' => 0,
            'total' => 1
        ];

        $client = $this->createClient($data, 200);
        $notificationsFacade = new NotificationsFacade($client, self::$baseApiUrl);
        $notification = $notificationsFacade->getNotification(172, $token);
        $this->assertInstanceOf(Notification::class, $notification);
    }

    /**
     * @throws \CosmonovaRnD\Facades\Notifications\NotificationsException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function testResendNotification()
    {
        $token = 'some-token';

        $client = $this->createClient(null, 200);
        $notificationsFacade = new NotificationsFacade($client, self::$baseApiUrl);
        $resendResult = $notificationsFacade->resendNotification(172, $token);
        $this->assertTrue($resendResult);
    }

    /**
     * @throws \CosmonovaRnD\Facades\Notifications\NotificationsException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function testSendMails()
    {
        $token = 'some-token';
        $data = [
            'id' => 172,
            'self' => 'some-link/172',
            'link' => 'some-link'
        ];

        $client = $this->createClient($data, 200);
        $notificationsFacade = new NotificationsFacade($client, self::$baseApiUrl);
        $newMailsNotification = $notificationsFacade->sendMails(
            'serhii.kondratiuk@cosmonova.net',
            ['serhii.kondratiuk@cosmonova.net'],
            'Your text',
            'Your subject',
            null,
            null,
            $token
            );
        $this->assertInstanceOf(NotificationResult::class, $newMailsNotification);
    }

    /**
     * @throws \CosmonovaRnD\Facades\Notifications\NotificationsException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function testSendSms()
    {
        $token = 'some-token';
        $data = [
            'id' => 172,
            'self' => 'some-link/172',
            'link' => 'some-link'
        ];

        $client = $this->createClient($data, 200);
        $notificationsFacade = new NotificationsFacade($client, self::$baseApiUrl);
        $newMailsNotification = $notificationsFacade->sendMails(
            '3801087650321',
            ['3801087650321'],
            'Your text',
            'Your subject',
            null,
            null,
            $token
        );
        $this->assertInstanceOf(NotificationResult::class, $newMailsNotification);
    }

    /**
     * @throws \CosmonovaRnD\Facades\Notifications\NotificationsException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function testGetDeliveryByReceiverAndNotification()
    {
        $token = 'some-token';
        $data = [
            "text" => "Hello world",
            "type" => "SMS",
            "status" => "DELIVERED",
            "sent_at" => "2018-02-13T09:48:36+02:00",
            "delivered_at" => "2018-02-13T09:48:36+02:00",
            "receiver" => "380638109097",
            "created_by" => "admin"
        ];

        $client = $this->createClient($data, 200);
        $notificationsFacade = new NotificationsFacade($client, self::$baseApiUrl);
        $notificationDelivery = $notificationsFacade->getDeliveryByReceiverAndNotification(172, '380638109097', $token);
        $this->assertInstanceOf(Delivery::class, $notificationDelivery);
    }

    /**
     * @param array $responseBody
     * @param int   $statusCode
     *
     * @return \GuzzleHttp\Client
     */
    private function createClient(?array $responseBody, int $statusCode): Client
    {
        $mock = new MockHandler(
            [
                new Response($statusCode, ['Content-Type' => 'application/json'],
                    $responseBody ? \json_encode($responseBody) : $responseBody),
            ]
        );

        $handler = HandlerStack::create($mock);

        return new Client(['handler' => $handler]);
    }
}