<?php
declare(strict_types=1);

namespace AppBundle\Validator\Constraints;


use Symfony\Component\Form\Exception\UnexpectedTypeException;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

/**
 * Class IsStringWithSeparatorsValidator
 * @package AppBundle\Validator\Constraints
 */
class IsStringWithSeparatorsValidator extends ConstraintValidator
{
    /**
     * @param mixed $value
     * @param Constraint $constraint
     */
    public function validate($value, Constraint $constraint)
    {
        if (!$constraint instanceof IsStringWithSeparators) {
            throw new UnexpectedTypeException($constraint, IsStringWithSeparators::class);

        }

        $numberList = explode($constraint->separator, $value);
        if (!strpos($value, $constraint->separator) && count($numberList) > 1) {
            $this->context->buildViolation($constraint->messageSeparator)
                ->setParameter('{{separator}}', $constraint->separator)
                ->setInvalidValue($value)
                ->addViolation();
        }
    }

}