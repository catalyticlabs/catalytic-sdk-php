<?php

namespace Catalytic\SDK\Search;

class SearchUtils
{
    /**
     * Finds a SearchCriteria object from $array where the 'name' equals $name
     *
     * @param array $array  The array of searchCriteria
     * @param string $name  The name of the search critiera object to look for
     * @return string       The value of the search criteria by name
     */
    public static function getSearchCriteriaValueByKey(array $array, string $name) : ?string
    {
        // TODO: Can refactor this to simply use a find method

        // Filter $array for a key of $name
        $filteredArray = array_filter(
            $array,
            function ($criteria) use (&$name) {
                return $criteria->name == $name;
            }
        );

        // Since array_filter preserves array keys, reindex the order of elements in the array
        $filteredArray = array_values($filteredArray);

        // If no filters exist that match $name
        if (count($filteredArray) == 0) {
            return null;
        }

        $searchCriteriaObject = $filteredArray[0];
        $value = $searchCriteriaObject->value;
        return $value;
    }
}