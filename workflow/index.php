<?php

require __DIR__ . '/vendor/autoload.php';

use NeuronAI\Workflow\WorkflowState;
use Weather\WeatherWorkflow;

$state = new WorkflowState();
$state->set('user_input', 'I live in Poznan, Poland.');

$workflow = new WeatherWorkflow();
$state = $workflow->run($state);

echo $state->get('recommendation');