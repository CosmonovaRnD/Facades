<?php
declare(strict_types=1);

namespace CosmonovaRnD\Facades\Notifications\DTO;

/**
 * Class NotificationResult
 *
 * @author Serhii Kondratiuk <serhii.kondratiuk@cosmonova.net>
 * @package CosmonovaRnD\Facades\Notifications\DTO
 * @since   1.2.0
 * Cosmonova | Research & Development
 */
final class NotificationResult
{
    /**
     * @var int
     */
    public $id;
    /**
     * @var string
     */
    public $self;
    /**
     * @var string
     */
    public $link;

    /**
     * NotificationResult constructor.
     * @param int $id
     * @param string $self
     * @param string $link
     */
    public function __construct(
        int $id,
        string $self,
        string $link
    ) {
        $this->id = $id;
        $this->self = $self;
        $this->link = $link;
    }

    /**
     * @param array $data
     * @return NotificationResult
     */
    public static function createFromResponse(array $data): self
    {
        return new self(
            (int)$data['id'],
            $data['self'],
            $data['link']
        );
    }
}