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
    public function text()
    {
        return (new Filter())->text();
    }

    /**
     * Owner to be filtered
     *
     * @return FilterCriteria   The created FilterCriteria object
     */
    public function owner()
    {
        return (new Filter())->owner();
    }

    /**
     * Category to be filtered
     *
     * @return FilterCriteria   The created FilterCriteria object
     */
    public function category()
    {
        return (new Filter())->category();
    }

    /**
     * Status to be filtered
     *
     * @return FilterCriteria   The created FilterCriteria object
     */
    public function status()
    {
        return (new Filter())->status();
    }

    /**
     * WorkflowId to be filtered
     *
     * @return FilterCriteria   The created FilterCriteria object
     */
    public function workflowId()
    {
        return (new Filter())->workflowId();
    }

    /**
     * Assignee to be filtered
     *
     * @return FilterCriteria   The created FilterCriteria object
     */
    public function assignee()
    {
        return (new Filter())->assignee();
    }

    /**
     * InstanceId to be filtered
     *
     * @return FilterCriteria   The created FilterCriteria object
     */
    public function instanceId()
    {
        return (new Filter())->instanceId();
    }
}

