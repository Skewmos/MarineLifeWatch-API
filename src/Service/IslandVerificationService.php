<?php

namespace App\Service;

use AllowDynamicProperties;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

#[AllowDynamicProperties] class IslandVerificationService
{
    private string $apiBaseUrl;

    public function __construct(string $apiBaseUrl, HttpClientInterface $httpClient)
    {
        $this->apiBaseUrl = $apiBaseUrl;
        $this->httpClient = $httpClient;
    }

    public function verifyIslandId(string $island, string $responseMode="json"): ?array
    {
        if (empty($island)) {
            throw new \Exception("The island identifier cannot be an empty string");
        }

        try {
            $url = $this->apiBaseUrl . '/pandore/ilot/IlotDto/';
            $response = $this->httpClient->request('GET', $url);
            if ($response->getStatusCode() === 200) {
                return $response->toArray();
            } else {
                return null;
            }
        } catch (TransportExceptionInterface $e) {
            return ['error' => $e];
        }
    }
}