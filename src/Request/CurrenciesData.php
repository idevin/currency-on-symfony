<?php

namespace App\Request;

use App\Entity\Currency;
use App\Entity\Data;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

class CurrenciesData {

    private string $apiKey;
    private string $baseUrl;
    private EntityManagerInterface $entityManager;

    public function __construct($apiKey, $baseUrl, EntityManagerInterface $entityManager) {
        $this->setApiKey($apiKey);
        $this->setBaseUrl($baseUrl);
        $this->entityManager = $entityManager;
    }

    /**
     * @throws ServerExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws ClientExceptionInterface
     */
    public function latest(): array|string {
        return $this->createRequest('latest');
    }

    /**
     * @throws ServerExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws ClientExceptionInterface
     */
    public function all(): array|string {
        return $this->createRequest('currencies');
    }

    public function getApiKey(): string {
        return $this->apiKey;
    }

    public function setApiKey(string $apiKey): void {
        $this->apiKey = $apiKey;
    }

    public function getBaseUrl(): string {
        return $this->baseUrl;
    }

    public function setBaseUrl(string $baseUrl): void {
        $this->baseUrl = $baseUrl;
    }

    /**
     * @throws ServerExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws ClientExceptionInterface
     */
    public function sync(): void {

        $currencies = $this->getEntityManager()->createQueryBuilder()
            ->select('currency')->from(Currency::class, 'currency', 'currency.id')
            ->getQuery()->getArrayResult();

        $currencyData = $this->all()['data'];

        $values = $this->latest()['data'];

        if (empty($currencies) && !empty($currencyData)) {

            foreach ($currencyData as $symbol => $currency) {
                $currencyEntity = new Currency();
                $currencyEntity->setSymbol($symbol);

                $data = new Data();
                $data->setSymbol($currency['symbol']);
                $data->setName($currency['name']);
                $data->setSymbolNative($currency['symbol_native']);
                $data->setDecimalDigits($currency['decimal_digits']);
                $data->setRounding($currency['rounding']);
                $data->setCode($currency['code']);
                $data->setNamePlural($currency['name_plural']);
                $data->setType($currency['type']);
                $data->setCurrency($currencyEntity);
                $data->setValue($values[$symbol]);

                $this->getEntityManager()->persist($currencyEntity);
                $this->getEntityManager()->persist($data);
                $this->getEntityManager()->flush();
            }
        }
    }

    public function getEntityManager(): EntityManagerInterface {
        return $this->entityManager;
    }

    /**
     * @throws ServerExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws ClientExceptionInterface
     */
    public function createRequest(string $uri, array $data = []): Exception|array {

        $client = HttpClient::create();
        $content = [];

        try {
            $response = $client->request(
                'GET',
                $this->getBaseUrl() . $uri,
                [
                    'query' => [
                            'apikey' => $this->getApiKey()
                        ] + $data
                ]
            );

            if ($response->getStatusCode() == 200) {
                $content = $response->toArray();
            }

        } catch (TransportExceptionInterface $e) {
            return new Exception($e->getTraceAsString());
        }

        return $content;
    }

    public function convert($from, $to, mixed $amount): float|int {
        return ($to / $from) * $amount;
    }
}