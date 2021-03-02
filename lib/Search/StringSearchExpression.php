<?php

namespace Catalytic\SDK\Search;

/**
 * An expression object for matching strings
 */
class StringSearchExpression
{
    private $isEqualTo;
    private $contains;
    private $between;

    public function getIsEqualTo()
    {
        return $this->isEqualTo;
    }

    public function setIsEqualTo($isEqualTo)
    {
        $this->isEqualTo = $isEqualTo;
    }

    public function getContains()
    {
        return $this->contains;
    }

    public function setContains($contains)
    {
        $this->contains = $contains;
    }

    public function getBetween()
    {
        return $this->between;
    }

    public function setBetween($between)
    {
        $this->between = $between;
    }
}