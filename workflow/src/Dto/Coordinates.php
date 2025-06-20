<?php

namespace Weather\Dto;

use NeuronAI\StructuredOutput\SchemaProperty;

class Coordinates
{
    #[SchemaProperty(description: 'The latitude of the place, the value can be negative.', required: true)]
    public string $lat;

    #[SchemaProperty(description: 'The longitude of the place, the value can be negative.', required: true)]
    public string $lon;
}