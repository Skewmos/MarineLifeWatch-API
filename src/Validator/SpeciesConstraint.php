<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

#[\Attribute]
class SpeciesConstraint extends Constraint
{
    public string $message = 'The species must be "fish" or "marine mammal"';

    public function validatedBy(): string
    {
        return SpeciesValidator::class;
    }
}