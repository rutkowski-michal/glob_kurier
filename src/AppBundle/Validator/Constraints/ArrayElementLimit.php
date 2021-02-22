<?php

namespace AppBundle\Validator\Constraints;


use Symfony\Component\Validator\Constraint;

/**
 * Class ArrayElementLimit
 * @package AppBundle\Validator\Constraints
 */
class ArrayElementLimit extends Constraint
{
    /**
     * @var string
     */
    public $limit;

    public $separator;

    public $messageLimit = 'is_to_many_elements';

    /**
     * ArrayElementLimit constructor.
     * @param null $options
     */
    public function __construct($options = null)
    {
        if (null !== $options && !\is_array($options)) {
            $options = [
                'limit' => $options['limit'],
                'separator' => $options['separator']
            ];
        } elseif (\is_array($options) && isset($options['value']) && !isset($options['limit'])) {
            $options['limit'] = $options['value'];
            unset($options['value']);
        }

        parent::__construct($options);


    }

}