<?php

namespace Weather\Nodes;

use NeuronAI\Chat\Messages\UserMessage;
use NeuronAI\Workflow\Node;
use NeuronAI\Workflow\WorkflowState;
use Weather\Agents\WeatherAgent;

class ThirdNode extends Node
{
    public function run(WorkflowState $state): WorkflowState
    {
        $response = WeatherAgent::make()->chat(
            new UserMessage($state->get('weather_info'))
        );

        $state->set('recommendation', $response->getContent());

        return $state;
    }
}