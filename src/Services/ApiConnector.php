<?php

declare(strict_types=1);

namespace Csaba\SalesApi\Services;

use Csaba\SalesApi\DTO\ListDTO;
use Csaba\SalesApi\Exception\InvalidApiAuthenticationException;
use JsonException;

final class ApiConnector
{
    private const LISTS_ENDPOINT = 'https://api.salesautopilot.com/getlists';
    private const LIST_FORMS_ENDPOINT = 'https://api.salesautopilot.com/getforms/';

    private string $username;
    private string $password;

    public function __construct()
    {
        $this->username = (string) getenv('API_USERNAME');
        $this->password = (string) getenv('API_PASSWORD');
    }

    /**
     * @throws InvalidApiAuthenticationException
     * @throws JsonException
     */
    public function getLists(): array
    {
        $lists = [];
        $listsArray = $this->callApiEndpoint(self::LISTS_ENDPOINT);

        foreach ($listsArray as $list) {
            $lists[] = new ListDTO(
                $list['id'],
                $list['name'],
                $list['size'],
                new \DateTimeImmutable($list['created_at'])
            );
        }

        return $lists;
    }

    /**
     * @throws InvalidApiAuthenticationException
     * @throws JsonException
     */
    public function getListForms(string $listId): array
    {
        $listForms = [];
        $listFormsArray = $this->callApiEndpoint(self::LIST_FORMS_ENDPOINT . $listId);

        foreach ($listFormsArray as $listForm) {
            $listForms[] = new ListDTO(
                $listForm['id'],
                $listForm['name'],
                $listForm['size'],
                new \DateTimeImmutable($listForm['created_at'])
            );
        }

        return $listForms;
    }

    /**
     * @throws InvalidApiAuthenticationException
     * @throws JsonException
     */
    private function callApiEndpoint(string $url): array
    {
        if ($this->username === '' || $this->password === '') {
            throw new InvalidApiAuthenticationException();
        }

        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
            CURLOPT_USERPWD => $this->username . ':' . $this->password,
            CURLOPT_RETURNTRANSFER => true,
        ]);

        $response = curl_exec($curl);
        if ($response === false) {
            throw new \RuntimeException('cURL error: ' . curl_error($curl));
        }

        $statusCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);

        if ($statusCode === 401) {
            throw new InvalidApiAuthenticationException();
        }

        return json_decode($response, true, 512, JSON_THROW_ON_ERROR);
    }
}
