<?php

namespace Catalytic\SDK\Search;

/**
 * An expression object for matching DateTime's
 */
class DateTimeSearchExpression
{
    private $isEqualTo;
    private $between;

    public function getIsEqualTo()
    {
        return $this->isEqualTo;
    }

    public function setIsEqualTo($isEqualTo)
    {
        $this->isEqualTo = $isEqualTo;
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
