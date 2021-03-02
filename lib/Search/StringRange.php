<?php

namespace Catalytic\SDK\Search;

/**
 * An expression object for a range of strings
 */
class StringRange
{
    private $lowerBoundInclusive;
    private $upperBoundInclusive;

    public function __construct(String $lowerBoundInclusive = null, String $upperBoundInclusive = null)
    {
        $this->lowerBoundInclusive = $lowerBoundInclusive;
        $this->upperBoundInclusive = $upperBoundInclusive;
    }

    public function getLowerBoundInclusive()
    {
        return $this->lowerBoundInclusive;
    }

    public function setLowerBoundInclusive(String $lowerBoundInclusive)
    {
        $this->lowerBoundInclusive = $lowerBoundInclusive;
    }

    public function getUpperBoundInclusive()
    {
        return $this->upperBoundInclusive;
    }

    public function setUpperBoundInclusive(String $upperBoundInclusive)
    {
        $this->upperBoundInclusive = $upperBoundInclusive;
    }
}
