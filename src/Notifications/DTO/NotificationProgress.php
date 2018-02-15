<?php
declare(strict_types=1);

namespace CosmonovaRnD\Facades\Notifications\DTO;

/**
 * Class NotificationProgress
 *
 * @author Serhii Kondratiuk <serhii.kondratiuk@cosmonova.net>
 * @package CosmonovaRnD\Facades\Notifications\DTO
 * @since   1.2.0
 * Cosmonova | Research & Development
 */
final class NotificationProgress
{
    /**
     * @var int
     */
    public $total;
    /**
     * @var int
     */
    public $sent;
    /**
     * @var int
     */
    public $delivered;
    /**
     * @var int
     */
    public $rejected;

    /**
     * NotificationProgress constructor.
     * @param int $total
     * @param int $sent
     * @param int $delivered
     * @param int $rejected
     */
    public function __construct(
        int $total,
        int $sent,
        int $delivered,
        int $rejected
    ) {
        $this->total = $total;
        $this->sent = $sent;
        $this->delivered = $delivered;
        $this->rejected = $rejected;
    }

    /**
     * @param array $data
     * @return NotificationProgress
     */
    public static function createFromResponse(array $data): self
    {
        return new self(
            (int)$data['total'],
            (int)$data['sent'],
            (int)$data['delivered'],
            (int)$data['rejected']
        );
    }
}