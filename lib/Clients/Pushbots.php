<?php

namespace Catalytic\SDK\Clients;

use \Catalytic\SDK\ConfigurationUtils;
use \Catalytic\SDK\Api\PushbotsApi;
use Catalytic\SDK\Entities\{Pushbot, PushbotsPage};
use Catalytic\SDK\Search\Filter;

/**
 * Pushbot client to be exposed to consumers
 */
class Pushbots
{
    private PushbotsApi $pushbotsApi;

    public function __construct($secret)
    {
        $config = ConfigurationUtils::getConfiguration($secret);
        $this->pushbotsApi = new PushbotsApi(null, $config);
    }

    /**
     * Get a pushbot by id
     *
     * @param string $id    The id of the pushbot to get
     */
    public function get(string $id)
    {
        $internalPushbot = $this->pushbotsApi->getPushbot($id);
        $pushbot = new Pushbot(
            $internalPushbot->getId(),
            $internalPushbot->getName(),
            $internalPushbot->getTeamName(),
            $internalPushbot->getDescription(),
            $internalPushbot->getCategory(),
            $internalPushbot->getOwner(),
            $internalPushbot->getCreatedBy(),
            $internalPushbot->getInputFields(),
            $internalPushbot->getIsPublished(),
            $internalPushbot->getIsArchived(),
            $internalPushbot->getFieldVisibility(),
            $internalPushbot->getInstanceVisibility(),
            $internalPushbot->getAdminUsers(),
            $internalPushbot->getStandardUsers()
        );
        return $pushbot;
    }

    /**
     * Find pushbots by a variety of filters
     *
     * @param string $filter    The filter criteria to search pushbots by
     * @param string $pageToken The token of the page to fetch
     * @param int    $pageSize  The number of pushbots per page to fetch
     */
    public function find(Filter $filter = null, string $pageToken = null, int $pageSize = null)
    {
        $text = null;
        $owner = null;
        $category = null;

        if ($filter !== null) {
            $text = $this->getSearchCriteriaValueByKey($filter->searchFilters, 'text');
            $owner = $this->getSearchCriteriaValueByKey($filter->searchFilters, 'owner');
            $category = $this->getSearchCriteriaValueByKey($filter->searchFilters, 'category');
        }

        $internalPushbots = $this->pushbotsApi->findPushbots($text, null, null, null, $owner, $category, null, $pageToken, $pageSize);
        $pushbots = [];
        foreach ($internalPushbots->getPushbots() as $internalPushbot) {
            $pushbot = new Pushbot(
                $internalPushbot->getId(),
                $internalPushbot->getName(),
                $internalPushbot->getTeamName(),
                $internalPushbot->getDescription(),
                $internalPushbot->getCategory(),
                $internalPushbot->getOwner(),
                $internalPushbot->getCreatedBy(),
                $internalPushbot->getInputFields(),
                $internalPushbot->getIsPublished(),
                $internalPushbot->getIsArchived(),
                $internalPushbot->getFieldVisibility(),
                $internalPushbot->getInstanceVisibility(),
                $internalPushbot->getAdminUsers(),
                $internalPushbot->getStandardUsers()
            );
            array_push($pushbots, $pushbot);
        }
        $pushbotsPage = new PushbotsPage($pushbots, $internalPushbots->getCount(), $internalPushbots->getNextPageToken());
        return $pushbotsPage;
    }

    // TODO: Finish/test
    public function export(string $id)
    {
        $exportedPushbot = $this->pushbotsApi->getPushbotExport($id);
        return $exportedPushbot;
    }

    // TODO: Finish/test
    public function import($importFile)
    {
        throw new Exception('Not yet implemented');
    }

    /**
     * Finds a SearchCriteria object from $array where the 'name' equals $name
     *
     * @param array $array  The array of searchCriteria
     * @param string $name  The name of the search critiera object to look for
     * @return string       The value of the search criteria by name
     */
    private function getSearchCriteriaValueByKey(array $array, string $name)
    {
        $filteredArray = array_filter(
            $array,
            function ($criteria) use (&$name) {
                return $criteria->name == $name;
            }
        );

        // Since array_filter preserves array keys, reindex the order of elements in the array
        $filteredArray = array_values($filteredArray);

        echo "name = $name".PHP_EOL;
        echo 'count($filteredArray) = '. count($filteredArray).PHP_EOL;

        // If no filters exist that match $name
        if (count($filteredArray) == 0) {
            return null;
        }

        print_r($filteredArray);

        echo "try this".PHP_EOL;
        print_r($filteredArray[0]);

        $searchCriteriaObject = $filteredArray[0];
        $value = $searchCriteriaObject->value;
        echo "value = $value".PHP_EOL;
        return $value;
    }
}
