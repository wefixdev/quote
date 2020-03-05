<?php

namespace Quote\Services;

use Quote\Helpers\ResponseHelper;

class CurrencyLayerService
{
    /** @var string  */
    const BASE_URL = 'http://apilayer.net/api/%s?access_key=%s';

    /**
     * @var string
     */
    protected $accessKey;

    /** @var string */
    protected $params;

    /**
     * @var HttpService $httpService
     */
    protected $httpService;

    /**
     * CurrencyLayerService constructor.
     *
     * @param $accessKey
     */
    public function __construct($accessKey)
    {
        $this->httpService = new HttpService();
        $this->accessKey = $accessKey;
        $this->params = null;
    }

    /**
     * Get live currencies
     *
     * @param array $params
     * @return array
     */
    public function live(array $params = [])
    {
        $url = sprintf(self::BASE_URL, 'live', $this->accessKey);
        $url .= $this->prepareParams($params);

        return $this->getArrayResponse($this->httpService->get($url));
    }

    /**
     * Get historical currencies
     *
     * @param array $params
     * @return array
     */
    public function historical(array $params = [])
    {
        if (!array_key_exists('date', $params)) {
            //TODO: add a custom exception
        }

        $url = sprintf(self::BASE_URL, 'historical', $this->accessKey);
        $url .= $this->prepareParams($params);

        return $this->getArrayResponse($this->httpService->get($url));
    }

    /**
     * Get time interval currencies
     *
     * @param array $params
     * @return array
     */
    public function timeframe(array $params = [])
    {
        if (!array_key_exists('date_start', $params) || array_key_exists('date_end', $params)) {
            //TODO: add a custom exception
        }

        $url = sprintf(self::BASE_URL, 'timeframe', $this->accessKey);
        $url .= $this->prepareParams($params);

        return $this->getArrayResponse($this->httpService->get($url));
    }

    /**
     * Convert json response to array
     * @param $response
     * @return array
     */
    public function getArrayResponse($response)
    {
        return ResponseHelper::toArray($response->getBody()->__toString());
    }

    /**
     * Prepare params query
     *
     * @param array $params
     * @return string|null
     */
    private function prepareParams(array $params)
    {
        if (empty($params)) {
            return null;
        }

        if (!empty($params)) {
            foreach ($params as $paramKey => $paramValue) {
                if (is_array($paramValue)) {
                    $paramValue = implode(',', $paramValue);
                }

                $this->params .= "&{$paramKey}={$paramValue}";
            }
        }

        return $this->params;
    }
}
