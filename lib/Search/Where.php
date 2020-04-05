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
     * @return Filter
     */
    public function text()
    {
        return (new Filter())->text();
    }

    /**
     * Owner to be filtered
     *
     * @return Filter
     */
    public function owner()
    {
        return (new Filter())->owner();
    }

    /**
     * Category to be filtered
     *
     * @return Filter
     */
    public function category()
    {
        return (new Filter())->category();
    }
}

