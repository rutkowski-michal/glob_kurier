<?php


namespace AppBundle\Validator\Constraints;


use Symfony\Component\Validator\Constraint;

class IsStringWithSeparators extends Constraint
{
    /**
     * @var string
     */
    public $separator;

    public $messageSeparator = 'is_number_list_separator';

    /**
     * ArrayElementLimit constructor.
     * @param null $options
     */
    public function __construct($options = null)
    {
        if (null !== $options && !\is_array($options)) {
            $options = [
                'separator' => $options
            ];
        } elseif (\is_array($options) && isset($options['value']) && !isset($options['separator'])) {
            $options['separator'] = $options['value'];
            unset($options['value']);
        }

        parent::__construct($options);


    }

}