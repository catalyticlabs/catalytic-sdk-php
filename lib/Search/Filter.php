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
     *
     * @return Filter   The Filter object
     */
    public function and() : Filter
    {
        return $this;
    }

    /**
     * Creates a FilterCriteria object for filtering text
     *
     * @return FilterCriteria   The created FilterCriteria object
     */
    public function text() : FilterCriteria
    {
        $filterCriteria = new FilterCriteria($this, 'text');
        return $filterCriteria;
    }

    /**
     * Creates a FilterCriteria object for filtering owner
     *
     * @return FilterCriteria   The created FilterCriteria object
     */
    public function owner() : FilterCriteria
    {
        $filterCriteria = new FilterCriteria($this, 'owner');
        return $filterCriteria;
    }

    /**
     * Creates a FilterCriteria object for filtering category
     *
     * @return FilterCriteria   The created FilterCriteria object
     */
    public function category() : FilterCriteria
    {
        $filterCriteria = new FilterCriteria($this, 'category');
        return $filterCriteria;
    }
}