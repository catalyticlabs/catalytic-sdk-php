<?php

namespace Catalytic\SDK\Search;

/**
 * An expression object for matching UUID's
 */
class GuidSearchExpression
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
