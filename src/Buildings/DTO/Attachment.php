<?php
declare(strict_types=1);

namespace CosmonovaRnD\Facades\Buildings\DTO;

/**
 * Class Attachment
 *
 * @author Serhii Kondratiuk <serhii.kondratiuk@cosmonova.net>
 * @package CosmonovaRnD\Facades\Buildings
 * @since   1.3.0
 * Cosmonova | Research & Development
 */
class Attachment
{
    /**
     * @var int
     */
    public $id;
    /**
     * @var string
     */
    public $link;
    /**
     * @var string
     */
    public $createdBy;
    /**
     * @var \DateTimeImmutable
     */
    public $createdAt;
    /**
     * @var string
     */
    public $editedBy;
    /**
     * @var \DateTimeImmutable
     */
    public $updatedAt;

    /**
     * Attachment constructor.
     *
     * @param int $id
     * @param string $link
     * @param string $createdBy
     * @param \DateTimeImmutable $createdAt
     * @param string $editedBy
     * @param \DateTimeImmutable $updatedAt
     */
    public function __construct(
        int $id,
        string $link,
        string $createdBy,
        \DateTimeImmutable $createdAt,
        string $editedBy,
        \DateTimeImmutable $updatedAt
    ) {
        $this->id = $id;
        $this->link = $link;
        $this->createdBy = $createdBy;
        $this->createdAt = $createdAt;
        $this->editedBy = $editedBy;
        $this->updatedAt = $updatedAt;
    }

    /**
     * @param array $data
     *
     * @return Attachment
     */
    public static function createFromResponse(array $data): self
    {
        return new self(
            (int)$data['id'],
            $data['link'],
            $data['created_by'],
            new \DateTimeImmutable($data['created_at']),
            $data['edited_by'],
            new \DateTimeImmutable($data['updated_at'])
        );
    }
}