<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

#[\Attribute]
class IdentificationQualityConstraint extends Constraint
{
    public string $message = 'Only the following identification of qualities are possible suspicion, probable, verified';

    public function validatedBy(): string
    {
        return IdentificationQualityValidator::class;
    }
}