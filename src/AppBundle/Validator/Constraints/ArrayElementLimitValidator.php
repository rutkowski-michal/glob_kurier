<?php
declare(strict_types=1);

namespace AppBundle\Validator\Constraints;


use Symfony\Component\Form\Exception\UnexpectedTypeException;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

/**
 * Class ArrayElementLimitValidator
 * @package AppBundle\Validator\Constraints
 */
class ArrayElementLimitValidator extends ConstraintValidator
{

    /**
     * @param mixed $value
     * @param Constraint $constraint
     */
    public function validate($value, Constraint $constraint)
    {
        if (!$constraint instanceof ArrayElementLimit) {
            throw new UnexpectedTypeException($constraint, ArrayElementLimit::class);

        }
        $numberList = explode($constraint->separator, $value);

        if (count($numberList) > $constraint->limit) {
            $this->context->buildViolation($constraint->messageLimit)
                ->setParameter('{{limit}}', $constraint->limit)
                ->setInvalidValue($value)
                ->addViolation();
        }
    }

}