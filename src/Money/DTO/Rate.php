<?php
declare(strict_types=1);

namespace CosmonovaRnD\Facades\Money\DTO;

/**
 * Class Rate
 *
 * @author  Aleksandr Besedin <bs@cosmonova.net>
 * @package CosmonovaRnD\Facades\Money\DTO
 * @since   1.1.0
 * Cosmonova | Research & Development
 */
final class Rate
{
    /**
     * @var int
     */
    public $id;
    /**
     * @var string
     */
    public $baseCurrency;
    /**
     * @var string
     */
    public $counterCurrency;
    /**
     * @var float
     */
    public $rate;
    /**
     * @var \DateTimeImmutable
     */
    public $date;

    /**
     * Rate constructor.
     *
     * @param int                $id
     * @param string             $baseCurrency
     * @param string             $counterCurrency
     * @param float              $rate
     * @param \DateTimeImmutable $date
     */
    public function __construct(
        int $id,
        string $baseCurrency,
        string $counterCurrency,
        float $rate,
        \DateTimeImmutable $date
    ) {
        $this->id              = $id;
        $this->baseCurrency    = $baseCurrency;
        $this->counterCurrency = $counterCurrency;
        $this->rate            = $rate;
        $this->date            = $date;
    }

    /**
     * @param array $data
     *
     * @return \CosmonovaRnD\Facades\Money\DTO\Rate
     */
    public static function createFromResponse(array $data): self
    {
        return new self(
            (int)$data['id'],
            $data['base_currency'],
            $data['counter_currency'],
            (float)$data['rate'],
            new \DateTimeImmutable($data['date'])
        );
    }
}
