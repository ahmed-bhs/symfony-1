<?php
/**
 * This file is part of the Final-Safe.
 * Created by trimechmehdi.
 * Date: 5/24/17
 * Time: 10:47
 * @author: Mobelite <http://www.mobelite.fr/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Components;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Validation;

/**
 * Class Validate
 * @package Shared\Constraints
 */
class Validate
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