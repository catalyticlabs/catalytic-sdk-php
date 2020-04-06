<?php

namespace Catalytic\SDK\Search;

/**
 * Class used to generate chainable filter clauses.
 *
 * Mainly syntactic sugar for creating FilterCriteria objects
 */
class Where
{
    /**
     * Text to be filtered
     *
     * @return FilterCriteria   The created FilterCriteria object
     */
    public function text() : FilterCriteria
    {
        return (new Filter())->text();
    }

    /**
     * Owner to be filtered
     *
     * @return FilterCriteria   The created FilterCriteria object
     */
    public function owner() : FilterCriteria
    {
        return (new Filter())->owner();
    }

    /**
     * Category to be filtered
     *
     * @return FilterCriteria   The created FilterCriteria object
     */
    public function category() : FilterCriteria
    {
        return (new Filter())->category();
    }
}

