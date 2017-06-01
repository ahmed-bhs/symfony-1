<?php
/**
 * Copyright (c) 2017.
 */e.
 */

namespace Components;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Validation;

/**
 * Class Validate
 * @package Shared\Constraints
 */
final class Validate
{
    /**
     * ---------------------------------------
     * @author: Trimech Mehdi <trimechmehdi11@gmail.com>
     * ---------------------------------------
     * **************** Function documentation: ****************
     * Validate input email
     * ---------------------------------------
     * **************** Function input: ****************
     * @param Constraint $constraint
     * @param $value
     *
     * ---------------------------------------
     * **************** Function output: ****************
     * @return \Symfony\Component\Validator\ConstraintViolationListInterface
     * ---------------------------------------
     */
    public static function validate($value, Constraint $constraint)
    {
        $validator = Validation::createValidator();

        $violations = $validator->validate($value, $constraint);

        return $violations;
    }
}