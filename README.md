# php-gears
Collection of useful functions

## Installation
```
composer require cosmologist/gears
```

## Array functions

##### Calculate the average of values in an array (array_avg)
```php
ArrayType::average([1, 2, 3]); // 3
```

##### Check if array is associative
```php
ArrayType::checkAssoc([1, 2, 3]); // false
ArrayType::checkAssoc(['foo' => 'bar']); // true
```

##### Get an item from the array by key
```php
ArrayType::get(['fruit' => 'apple', 'color' => 'red'], 'fruit'); // apple
ArrayType::get(['fruit' => 'apple', 'color' => 'red'], 'weight'); // null
ArrayType::get(['fruit' => 'apple', 'color' => 'red'], 'weight', 15); // 15
```

##### Convert list of items to ranges
```php
ArrayType::ranges([1, 3, 7, 9]); // [[1, 3], [3, 7], [7, 9]]
```

##### Unset array item by value
```php
ArrayType::unsetValue(['a', 'b', 'c'], 'b'); // ['a', 'c']
```

##### List walker
Walks through the list and calls a callback for each item.
```php
ArrayType::each(iterable $list, callable $callback)
```

##### Recursive walker for list and descendants
Walks through the list and calls a callback for each item and for each child item (recursively).
```php
ArrayType::eachDescendantOrSelf(iterable $list, callable $callback, string $childrenKey)
```

##### Collect children recursively
Collects children recursively of each item in the list, as well as the item itself.
```php
ArrayType::descendantOrSelf(iterable $list, string $childrenKey): ArrayObject
```

##### Cast to an array
Behavior for different types:
  - array - returns as is
  - iterable - converts to a native array (`iterator_to_array()`)
  - another - creates an array with argument ([value])
```php
ArrayType::toArray($value);
```

## Json functions

#### Decodes a JSON string, used exceptions instead errors.
```php
try {
    Json::decode($json);
    // or
    Json::decodeToArray($json);
} catch (JsonParseException $e) {
    throw $e;
}
```

## Object functions
##### Reads the value at the end of the property path of the object graph
```php
ObjectType::get($person, 'address.street');
```
Uses Symfony PropertyAccessor
##### Sets the value at the end of the property path of the object graph
```php
ObjectType::set($person, 'address.street', 'Abbey Road');
```
Uses Symfony PropertyAccessor
##### Reads the value of internal object property (protected and private)
Read [ocramius](https://ocramius.github.io/blog/accessing-private-php-class-members-without-reflection/)
```php
ObjectType::readInternalProperty($object, $property);
```
##### Writes the value to internal object property (protected and private)
Read [ocramius](https://ocramius.github.io/blog/accessing-private-php-class-members-without-reflection/)
```php
ObjectType::writeInternalProperty($object, $property, $value);
```

##### A string representation of the object
Returns the result of `__toString` or null if the method is not defined.  
PHP default behavior: if the method is not defined, an error (`Object of class X could not be converted to string`) is triggered.
```php
ObjectType::toString($instance);
```

## String functions
##### Determine if a given string contains a given substring
```php
StringType::contains('Foo', 'Bar'); // false
StringType::contains('FooBar', 'Bar'); // true
```
##### Replace first string occurrence in an another string
```php
StringType::replaceFirst('name name name', 'name', 'title'); // 'title name name'
```
##### Wrap string
```php
StringType::wrap('target', '/'); // '/target/'
```

## Number functions

#### Checks if the value is odd
```php
NumberType::odd(2); // false
NumberType::odd(3); // true
```

#### Checks if the value is even
```php
NumberType::even(2); // true
NumberType::even(3); // false
```

##### Round to nearest multiple
```php
NumberType::roundStep(50, 5); // 50
NumberType::roundStep(52, 5); // 50
NumberType::roundStep(53, 5); // 55
```

##### Round down to nearest multiple
```php
NumberType::floorStep(50, 5); // 50
NumberType::floorStep(52, 5); // 50
NumberType::floorStep(53, 5); // 50
```

##### Round up to nearest multiple
```php
NumberType::ceilStep(50, 5); // 50
NumberType::ceilStep(52, 5); // 55
NumberType::ceilStep(53, 5); // 55
```

##### Spell out
```php
// Current locale used
NumberType::spellout(123.45); // one hundred twenty-three point four five

// Specific locale used
NumberType::spellout(123.45, 'ru'); // сто двадцать три целых сорок пять сотых
```