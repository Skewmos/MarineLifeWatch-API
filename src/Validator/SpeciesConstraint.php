<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

#[\Attribute]
class SpeciesConstraint extends Constraint
{
    public $message = 'The species must be "fish" or "marine mammal"';
}