<?php

namespace Catalytic\SDK\Search;

use Catalytic\SDK\Search\FilterCriteria;

/**
 * Class which creates and stores all the search filter criteria
 * to be used when making REST api calls
 */
class Filter
{
    // Contains all the search filter criteria objects to
    // be used for actually filtering
    public array $searchFilters = [];

    /**
     * Syntactic sugar to allow chaining
     */
    public function and()
    {
        return $this;
    }

    public function text()
    {
        $filterCriteria = new FilterCriteria($this, 'text');
        return $filterCriteria;
    }

    public function owner()
    {
        $filterCriteria = new FilterCriteria($this, 'owner');
        return $filterCriteria;
    }

    public function category()
    {
        $filterCriteria = new FilterCriteria($this, 'category');
        return $filterCriteria;
    }
}