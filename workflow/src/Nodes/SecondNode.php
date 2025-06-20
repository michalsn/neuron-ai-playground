<?php

namespace Weather\Nodes;

use GuzzleHttp\Client;
use NeuronAI\Workflow\Node;
use NeuronAI\Workflow\WorkflowState;

class SecondNode extends Node
{
    public function run(WorkflowState $state): WorkflowState
    {
        $client = new Client([
            'base_uri' => 'https://api.open-meteo.com',
        ]);

        $params = [
            'latitude'  => $state->get('lat'),
            'longitude' => $state->get('lon'),
        ];

        $response = $client->get('/v1/forecast?hourly=temperature_2m,rain,uv_index,wind_speed_10m&forecast_days=1&forecast_hours=1&past_hours=1&' . http_build_query($params));

        $state->set(
            'weather_info',
            $response->getBody()->getContents()
        );

        return $state;
    }
}