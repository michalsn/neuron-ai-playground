<?php

require __DIR__ . '/vendor/autoload.php';

use NeuronAI\Workflow\WorkflowState;
use Weather\WeatherWorkflow;

$state = new WorkflowState();
$state->set('user_input', 'I live in Sydney, Australia.');

$workflow = new WeatherWorkflow();
$state = $workflow->run($state);

echo $state->get('recommendation');
echo PHP_EOL;
echo $state->get('lat') . PHP_EOL;
echo $state->get('lon') . PHP_EOL;
echo $state->get('weather_info') . PHP_EOL;