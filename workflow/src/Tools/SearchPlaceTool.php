<?php

namespace Weather\Tools;

use GuzzleHttp\Client;
use NeuronAI\Tools\PropertyType;
use NeuronAI\Tools\Tool;
use NeuronAI\Tools\ToolProperty;

class SearchPlaceTool extends Tool
{
    protected Client $client;

    public function __construct()
    {
        parent::__construct(
            'place_coordinates',
            'Get the coordinates of the place (lat ,lon) which will be used later in weather api',
        );
    }

    protected function properties(): array
    {
        return [
            new ToolProperty(
                name: 'city',
                type: PropertyType::STRING,
                description: 'The city name',
                required: true
            ),
            new ToolProperty(
                name: 'country',
                type: PropertyType::STRING,
                description: 'The country name',
                required: false
            )
        ];
    }

    public function __invoke(string $city, $country)
    {
        $params = [
            'city' => $city,
        ];

        if (! empty($country)) {
            $params['country'] = $country;
        }

        $response = $this->client->get('/search?format=json&' . http_build_query($params));

        if ($response->getStatusCode() !== 200) {
            return 'Error :(';
        }

        return $response->getBody()->getContents();
    }

    protected function getClient(): Client
    {
        if (isset($this->client)) {
            return $this->client;
        }

        return $this->client = new Client([
            'base_uri' => 'https://nominatim.openstreetmap.org',
        ]);
    }

}