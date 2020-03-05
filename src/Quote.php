<?php

declare(strict_types=1);

namespace Quote;

use Quote\Services\CurrencyLayerService;

class Quote
{
    /** @var string */
    protected $apiKey;

    /** @var CurrencyLayerService  */
    protected $currencyLayer;

    /**
     * Quote constructor.
     *
     * @param $apiKey
     */
    public function __construct($apiKey)
    {
        $this->apiKey = $apiKey;
        $this->currencyLayer = new CurrencyLayerService($this->apiKey);
    }

    /**
     * @return array
     */
    public function live()
    {
        return $this->currencyLayer->live();
    }

    /**
     * @param string $date
     * @return array
     */
    public function historical(string $date)
    {
        return $this->currencyLayer->historical(['date' => $date]);
    }
}
