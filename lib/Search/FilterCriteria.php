<?php

namespace Catalytic\SDK\Search;

/**
 * An object which contains a filter criteria name and value
 */
class FilterCriteria
{
    // The Filter that was passed into the
    // constructor which holds all the filter criteria
    private $filter;
    public $name;
    public $value;

    public function __construct(Filter $filter, $name)
    {
        $this->filter = $filter;
        $this->name = $name;
    }

    /**
     * Adds the $term as the filter criteria value
     *
     * The name of this method is for syntactic sugar
     *
     * @param string @term  The term to add as the filter criteria value
     * @return Filter       The Filter object that the filter criteria value was added to
     */
    public function matches(string $term)
    {
        return $this->addAsFilterCriteria($term);
    }

    /**
     * Adds the $term as the filter criteria value
     *
     * The name of this method is for syntactic sugar
     *
     * @param string @term  The term to add as the filter criteria value
     * @return Filter       The Filter object that the filter criteria value was added to
     */
    public function is(string $term)
    {
        return $this->addAsFilterCriteria($term);
    }

    /**
     * Adds the passed in term to the filter's search criteria
     *
     * @param string @term  The term to add as the filter criteria value
     * @return Filter       The Filter object that the filter criteria value was added to
     */
    private function addAsFilterCriteria(string $term)
    {
        $this->value = $term;
        array_push($this->filter->searchFilters, $this);
        return $this->filter;
    }
}