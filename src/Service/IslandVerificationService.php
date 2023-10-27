<?php

namespace App\Service;

use AllowDynamicProperties;
use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

#[AllowDynamicProperties]
class IslandVerificationService
{
    private string $apiBaseUrl;

    public function __construct(string $apiBaseUrl)
    {
        $this->apiBaseUrl = $apiBaseUrl;
    }


    private function buildApiUrl(string $island, string $responseMode): string
    {
        return sprintf('%s/pandore/ilot/IlotDto/%s?_responseMode=%s', $this->apiBaseUrl, $island, $responseMode);
    }

    private function sendHttpRequest(string $url): ResponseInterface
    {
        $client = new Client();

        $options = [
            'headers' => [
                'content-type' => 'application/json+ld',
                'accept' => 'application/json+ld',
            ],
            'timeout' => 10,
        ];

        return $client->request('GET', $url, $options);
    }

    public function verifyIslandId(string $island, string $responseMode="json")
    {
        if (empty($island)) {
            throw new \Exception("The island identifier cannot be an empty string");
        }

        try {
            $url = $this->buildApiUrl($island, $responseMode);
            $response = $this->sendHttpRequest($url);
            $content = json_decode($response->getBody()->getContents(), true);
            if ($response->getStatusCode() === 200 && isset($content['data'])) {
                return $content['data'];
            }
        } catch (\Exception $e) {
            return new JsonResponse(['error' => 'HTTP error: ' . $e->getMessage()], $e->getStatusCode());
        } catch (TransportExceptionInterface $e) {
            return new JsonResponse(['error' => 'Transport error: ' . $e->getMessage()], 500);
        }

        return null;
    }
}