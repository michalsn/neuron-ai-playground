<?php

namespace Weather;

use NeuronAI\Workflow\Edge;
use NeuronAI\Workflow\Workflow;
use Weather\Nodes\FirstNode;
use Weather\Nodes\SecondNode;
use Weather\Nodes\ThirdNode;

class WeatherWorkflow extends Workflow
{
    public function nodes(): array
    {
        return [
            new FirstNode(),
            new SecondNode(),
            new ThirdNode(),
        ];
    }

    public function edges(): array
    {
        return [
            new Edge(FirstNode::class, SecondNode::class),
            new Edge(SecondNode::class, ThirdNode::class),
        ];
    }

    protected function start(): string
    {
        return FirstNode::class;
    }

    protected function end(): array
    {
        return [
            ThirdNode::class,
        ];
    }
}