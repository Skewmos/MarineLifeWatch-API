<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

#[\Attribute]
class IdentificationQualityConstraint extends Constraint
{
    public $message = 'Only the following identification of qualities are possible suspicion, probable, verified';
}