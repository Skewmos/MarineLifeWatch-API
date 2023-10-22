<?php

namespace App\Validator;

use App\Utils\ObservationUtils;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

#[\Attribute]
class SpeciesValidator extends ConstraintValidator
{

    public function validate($value, Constraint $constraint): void
    {
        if (!in_array($value, ObservationUtils::VALID_SPECIES, true)) {
            $this->context->buildViolation($constraint->message)->addViolation();
        }
    }
}