<?php
declare(strict_types=1);

namespace CosmonovaRnD\Facades\Accounts;

/**
 * Class TokenData
 *
 * @author  Aleksandr Besedin <bs@cosmonova.net>
 * @package CosmonovaRnD\Facades\Accounts
 * Cosmonova | Research & Development
 */
final class TokenData
{
    /** @var string */
    public $accessToken;
    /** @var string */
    public $tokenType;
    /** @var int */
    public $expiresIn;
    /** @var string */
    public $refreshToken;

    /**
     * TokenData constructor.
     *
     * @param string      $accessToken
     * @param string      $tokenType
     * @param int         $expiresIn
     * @param string|null $refreshToken
     */
    public function __construct(string $accessToken, string $tokenType, int $expiresIn, string $refreshToken = null)
    {
        $this->accessToken  = $accessToken;
        $this->tokenType    = $tokenType;
        $this->expiresIn    = $expiresIn;
        $this->refreshToken = $refreshToken;
    }

    /**
     * @param string $json
     *
     * @return \CosmonovaRnD\Facades\Accounts\TokenData
     * @throws \Exception
     */
    public static function createFromJson(string $json): self
    {
        $data = \json_decode($json, true);

        if (JSON_ERROR_NONE !== \json_last_error()) {
            throw new \Exception(\json_last_error_msg());
        }

        $accessToken  = $data['access_token'] ?? '';
        $tokenType    = $data['token_type'] ?? '';
        $expiresIn    = $data['expires_in'] ?? 0;
        $refreshToken = $data['refresh_token'] ?? null;

        return new self($accessToken, $tokenType, $expiresIn, $refreshToken);
    }
}
