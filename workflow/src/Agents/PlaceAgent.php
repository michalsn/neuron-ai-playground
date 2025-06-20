<?php

namespace Weather\Agents;

use NeuronAI\Agent;
use NeuronAI\Providers\AIProviderInterface;
use NeuronAI\Providers\Ollama\Ollama;
use Weather\Dto\Coordinates;
use Weather\Tools\SearchPlaceTool;

class PlaceAgent extends Agent
{
    public function provider(): AIProviderInterface
    {
        return new Ollama(
            url: 'http://localhost:11434/api/',
            model: 'qwen3:1.7b',
        );
    }

    protected function tools(): array
    {
        return [
            SearchPlaceTool::make(),
        ];
    }

    protected function getOutputClass(): string
    {
        return Coordinates::class;
    }
}