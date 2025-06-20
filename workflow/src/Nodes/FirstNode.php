<?php

namespace Weather\Nodes;

use NeuronAI\Chat\Messages\UserMessage;
use NeuronAI\Workflow\Node;
use NeuronAI\Workflow\WorkflowState;
use Throwable;
use Weather\Agents\PlaceAgent;
use Weather\Dto\Coordinates;

class FirstNode extends Node
{
    /**
     * @throws Throwable
     */
    public function run(WorkflowState $state): WorkflowState
    {
        $coordinates = PlaceAgent::make()->structured(
            new UserMessage($state->get('user_input')),
            Coordinates::class
        );

        $state->set('lat', $coordinates->lat);
        $state->set('lon', $coordinates->lon);

        return $state;
    }
}