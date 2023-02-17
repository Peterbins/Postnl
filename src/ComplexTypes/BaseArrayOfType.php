<?php namespace DivideBV\Postnl\ComplexTypes;

use IteratorAggregate;
use ArrayIterator;
use ArrayAccess;
use Exception;

abstract class BaseArrayOfType extends BaseType implements IteratorAggregate, ArrayAccess
{

    /**
     * @var string The name of the array property to use for iterating.
     *
     * Actual wrapper classes must define this.
     */
    const WRAPPED_PROPERTY = '';

    public function getIterator(): \Traversable
    {
        return new  \ArrayIterator($this->getWrappedProperty());
    }

    public function offsetExists(mixed $offset):bool
    {
        return isset($this->getWrappedProperty()[$offset]);
    }

    public function offsetGet(mixed $offset):mixed
    {
        return $this->offsetExists($offset) ? $this->getWrappedProperty()[$offset] : null;
    }

    public function offsetSet(mixed $offset, mixed $value) :void
    {
        throw new Exception('Writing to ArrayOf types using ArrayAccess not supported.');
    }

    public function offsetUnset(mixed $offset):void
    {
        throw new Exception('Writing to ArrayOf types using ArrayAccess not supported.');
    }

    /**
     * Get wrapped property.
     */
    private function getWrappedProperty()
    {
        return $this->{static::WRAPPED_PROPERTY};
    }
}
