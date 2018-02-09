<?php
declare(strict_types=1);

namespace CosmonovaRnD\Facades\Money\DTO;

/**
 * Class ConverterResult
 *
 * @author  Aleksandr Besedin <bs@cosmonova.net>
 * @package CosmonovaRnD\Facades\Money
 * @since   1.1.0
 * Cosmonova | Research & Development
 */
final class ConverterResult
{
    /** @var int|float */
    public $amount;
    /** @var string */
    public $currency;

    /**
     * ConverterResult constructor.
     *
     * @param int|float $amount
     * @param string    $currency
     */
    public function __construct($amount, string $currency)
    {
        $this->amount   = $amount;
        $this->currency = $currency;
    }
}
