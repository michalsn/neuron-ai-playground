<?php

namespace Weather\Agents;

use NeuronAI\Agent;
use NeuronAI\Providers\AIProviderInterface;
use NeuronAI\Providers\Ollama\Ollama;
use NeuronAI\SystemPrompt;

class WeatherAgent extends Agent
{
    public function provider(): AIProviderInterface
    {
        return new Ollama(
            url: 'http://localhost:11434/api/',
            model: 'qwen3:1.7b',
        );
    }

    public function instructions(): string
    {
        return new SystemPrompt(
            background: [
                'You are a fashion and weather expert specializing in recommending appropriate daily outfits based on weather conditions.',
            ],
            steps: [
                'Carefully analyze the provided JSON input, noting the unit system (e.g., Celsius or Fahrenheit, km/h or mph).',
                'Focus on today\'s forecasted data: maximum temperature, wind speed, total rainfall, and UV index.',
                'Use these weather factors to determine the most suitable outfit that balances comfort, protection, and style.',
            ],
            output: [
                'Provide a concise outfit recommendation for today.',
                'Mention key clothing items (e.g., light jacket, umbrella, sunglasses) based on the weather conditions.',
                'Optionally include a one-line reasoning for your recommendation (e.g., "A light jacket is recommended due to high winds.").'
            ]
        );
    }
}