<?php

namespace Catalytic\SDK\Search;

use DateTime;

/**
 * An expression object for a range of datetime's
 */
class DateTimeRange
{
    private $lowerBoundInclusive;
    private $upperBoundInclusive;

    public function __construct(DateTime $lowerBoundInclusive = null, DateTime $upperBoundInclusive = null)
    {
        $this->lowerBoundInclusive = $lowerBoundInclusive;
        $this->upperBoundInclusive = $upperBoundInclusive;
    }

    public function getLowerBoundInclusive()
    {
        return $this->lowerBoundInclusive;
    }

    public function setLowerBoundInclusive(DateTime $lowerBoundInclusive)
    {
        $this->lowerBoundInclusive = $lowerBoundInclusive;
    }

    public function getUpperBoundInclusive()
    {
        return $this->upperBoundInclusive;
    }

    public function setUpperBoundInclusive(DateTime $upperBoundInclusive)
    {
        $this->upperBoundInclusive = $upperBoundInclusive;
    }
}