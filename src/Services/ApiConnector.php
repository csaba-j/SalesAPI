<?php

use Exception\InvalidApiAuthenticationException;

class ApiConnector
{
    private string $username;
    private string $password;

    public function __construct()
    {
        $this->username = getenv('API_USERNAME') ?: "";
        $this->password = getenv('API_PASSWORD') ?: "";
    }

    public function getLists(): array
    {
        return $this->callApiEndpoint("https://api.salesautopilot.com/getlists");
    }

    /**
     * @throws InvalidApiAuthenticationException
     * @throws JsonException
     */
    private function callApiEndpoint(string $url): array
    {
        if (empty($this->username) || empty($this->password)) {
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