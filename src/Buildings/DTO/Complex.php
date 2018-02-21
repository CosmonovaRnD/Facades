<?php
declare(strict_types=1);

namespace CosmonovaRnD\Facades\Buildings\DTO;

/**
 * Class Complex
 *
 * @author Serhii Kondratiuk <serhii.kondratiuk@cosmonova.net>
 * @package CosmonovaRnD\Facades\Buildings\DTO
 * @since   1.3.0
 * Cosmonova | Research & Development
 */
class Complex extends Building
{
    /**
     * @var array|null
     */
    public $multiApartments;

    /**
     * Complex constructor.
     * @param string $id
     * @param array|null $multiApartments
     * @param int $type
     * @param string $name
     * @param null|string $googlePlaceId
     * @param array|null $photos
     * @param Housing|null $housing
     * @param array|null $agreements
     * @param array|null $competitors
     * @param string $createdBy
     * @param \DateTimeImmutable $createdAt
     * @param string $editedBy
     * @param \DateTimeImmutable $updatedAt
     * @param null|string $objectType
     */
    public function __construct(
        string $id,
        ?array $multiApartments,
        int $type,
        string $name,
        ?string $googlePlaceId,
        ?array $photos,
        ?Housing $housing,
        ?array $agreements,
        ?array $competitors,
        string $createdBy,
        \DateTimeImmutable $createdAt,
        string $editedBy,
        \DateTimeImmutable $updatedAt,
        ?string $objectType
    ) {
        $this->id = $id;
        $this->multiApartments = $multiApartments;
        $this->type = $type;
        $this->name = $name;
        $this->googlePlaceId = $googlePlaceId;
        $this->photos = $photos;
        $this->housing = $housing;
        $this->agreements = $agreements;
        $this->competitors = $competitors;
        $this->createdBy = $createdBy;
        $this->createdAt = $createdAt;
        $this->editedBy = $editedBy;
        $this->updatedAt = $updatedAt;
        $this->objectType = $objectType;
    }

    /**
     * @param array $data
     * @return Complex
     */
    public static function createFromResponse(array $data): self
    {
        return new self(
            $data['id'],
            $data['multi_apartment'],
            (int)$data['type'],
            $data['name'],
            $data['google_place_id'],
            $data['photos'],
            $data['housing'],
            $data['agreements'],
            $data['competitors'],
            $data['created_by'],
            new \DateTimeImmutable($data['created_at']),
            $data['edited_by'],
            new \DateTimeImmutable($data['updated_at']),
            $data['object_type']
        );
    }
}