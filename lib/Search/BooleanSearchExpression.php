<?php

namespace Catalytic\SDK\Search;

/**
 * An expression object for matching booleans
 */
class BooleanSearchExpression
{
    private $isEqualTo;

    public function getIsEqualTo()
    {
        return $this->isEqualTo;
    }

    public function setIsEqualTo($isEqualTo)
    {
        $this->isEqualTo = $isEqualTo;
    }
}
