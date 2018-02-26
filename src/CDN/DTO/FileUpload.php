<?php
declare(strict_types=1);

namespace CosmonovaRnD\Facades\CDN\DTO;

/**
 * Class FileUpload
 *
 * @author Serhii Kondratiuk <serhii.kondratiuk@cosmonova.net>
 * @package CosmonovaRnD\Facades\CDN\DTO
 * @since   1.3.0
 * Cosmonova | Research & Development
 */
class FileUpload
{
    /**
     * @var string
     */
    public $uuid;
    /**
     * @var string
     */
    public $href;
    /**
     * @var string
     */
    public $type;
    /**
     * @var int
     */
    public $size;

    /**
     * FileUpload constructor.
     *
     * @param string $uuid
     * @param string $href
     * @param string $type
     * @param int $size
     */
    public function __construct(
        string $uuid,
        string $href,
        string $type,
        int $size
    ) {
        $this->uuid = $uuid;
        $this->href = $href;
        $this->type = $type;
        $this->size = $size;
    }

    /**
     * @param array $data
     *
     * @return FileUpload
     */
    public static function createFromResponse(array $data): self
    {
        return new self(
            $data['uuid'],
            $data['href'],
            $data['type'],
            (int)$data['size']
        );
    }
}