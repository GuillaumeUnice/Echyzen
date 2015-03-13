<?php
namespace Echyzen\TestBundle\Form\Type\NumberToStringTransformer;
 
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\UnexpectedTypeException;
use Symfony\Component\Form\Exception\TransformationFailedException;
 
/**
 * A simple number transformer that allows either comma or dot as decimal separator.
 *
 * Caution: this transformer does not understand thousands separators.
 *
 */
class NumberToStringTransformer implements DataTransformerInterface
{
    /**
     * @param mixed $value
     * @return string
     * @throws \Symfony\Component\Form\Exception\UnexpectedTypeException
     */
    public function transform($value)
    {
        if (null === $value) {
            return '';
        }
 
        if (!is_numeric($value)) {
            throw new UnexpectedTypeException($value, 'numeric');
        }
 
        return (string)$value;
    }
 
    /**
     * @param mixed $value
     * @return float|mixed|null
     * @throws \Symfony\Component\Form\Exception\UnexpectedTypeException
     * @throws \Symfony\Component\Form\Exception\TransformationFailedException
     */
    public function reverseTransform($value)
    {
        if (!is_string($value)) {
            throw new UnexpectedTypeException($value, 'string');
        }
 
        if ('' === $value) {
            return null;
        }
 
        $value = str_replace(',', '.', $value);
 
        if (is_numeric($value)) {
            $value = (float)$value;
        } else {
            throw new TransformationFailedException('not a number');
        }
 
        return $value;
    }
}