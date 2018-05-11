<?php

namespace Cosmologist\Gears;

use Cosmologist\Gears\ObjectType\Exception\PropertyNotFoundException;

/**
 * Collection of commonly used methods for working with objects
 */
class ObjectType
{
    /**
     * Return the value of the object property
     *
     * If the property is not available, try to find and use a getter (property(), getProperty(), get_property())
     *
     * @param object $object       Object
     * @param string $propertyName Property name
     *
     * @return mixed
     *
     * @throws PropertyNotFoundException When the the property is not exist
     */
    public static function get($object, $propertyName)
    {
        if (array_key_exists($propertyName, get_object_vars($object))) {
            return $object->$propertyName;
        }

        $possiblePropertyNames = [
            $propertyName,
            'get' . $propertyName,
            'get_' . $propertyName
        ];

        foreach ($possiblePropertyNames as $possiblePropertyName) {
            if (is_callable([$object, $possiblePropertyName])) {
                return $object->$possiblePropertyName();
            }
        }

        throw new PropertyNotFoundException(sprintf('Property #%s does not exists', $propertyName));
    }

    /**
     * Try to get object string representation (via __toString)
     *
     * @param object $object Object
     *
     * @return null|string
     */
    public static function getStringRepresentation($object)
    {
        if (method_exists($object, '__toString')) {
            return (string) $object;
        }

        return null;
    }
}