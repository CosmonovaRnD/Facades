<?php
declare(strict_types=1);

namespace CosmonovaRnD\Facades\Accounts;

use GuzzleHttp\ClientInterface;

/**
 * Class AccountsFacade
 *
 * @author  Aleksandr Besedin <bs@cosmonova.net>
 * @package CosmonovaRnD\Facades\Accounts
 * Cosmonova | Research & Development
 */
final class AccountsFacade
{
    /**
     * @var \GuzzleHttp\ClientInterface
     */
    private $client;
    /**
     * @var string
     */
    private $tokenUrl;

    /**
     * AccountsFacade constructor.
     *
     * @param \GuzzleHttp\ClientInterface $client
     * @param string                      $tokenUrl
     */
    public function __construct(ClientInterface $client, string $tokenUrl)
    {
        $this->client   = $client;
        $this->tokenUrl = $tokenUrl;
    }

    /**
     * @param string $appId
     * @param string $appSecret
     *
     * @return \CosmonovaRnD\Facades\Accounts\TokenData|null
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getAppAccessToken(string $appId, string $appSecret): ?TokenData
    {
        try {
            $response = $this->client->request('post', $this->tokenUrl, [
                'auth'        => [$appId, $appSecret],
                'form_params' => [
                    'grant_type' => 'client_credentials'
                ]
            ]);

            if (200 === $response->getStatusCode()) {
                return TokenData::createFromJson($response->getBody()->getContents());
            }
        } catch (\Throwable $throwable) {
            // DoNothing
        }

        return null;
    }

    /**
     * @param string $appId
     * @param string $appSecret
     * @param string $username
     * @param string $password
     *
     * @return \CosmonovaRnD\Facades\Accounts\TokenData|null
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getUserAccessToken(string $appId, string $appSecret, string $username, string $password): ?TokenData
    {
        try {
            $response = $this->client->request('post', $this->tokenUrl, [
                'auth'        => [$appId, $appSecret],
                'form_params' => [
                    'grant_type' => 'password',
                    'username'   => $username,
                    'password'   => $password
                ]
            ]);

            if (200 === $response->getStatusCode()) {
                return TokenData::createFromJson($response->getBody()->getContents());
            }
        } catch (\Throwable $throwable) {
            // DoNothing
        }

        return null;
    }

    /**
     * @param string $appId
     * @param string $appSecret
     * @param string $refreshToken
     *
     * @return \CosmonovaRnD\Facades\Accounts\TokenData|null
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function refreshTokenBy(string $appId, string $appSecret, string $refreshToken): ?TokenData
    {
        try {
            $response = $this->client->request('post', $this->tokenUrl, [
                'auth'        => [$appId, $appSecret],
                'form_params' => [
                    'grant_type'    => 'refresh_token',
                    'refresh_token' => $refreshToken
                ]
            ]);

            if (200 === $response->getStatusCode()) {
                return TokenData::createFromJson($response->getBody()->getContents());
            }
        } catch (\Throwable $throwable) {
            // DoNothing
        }

        return null;
    }
}
