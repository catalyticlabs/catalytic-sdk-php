<?php

namespace Catalytic\SDK\Clients;

use Catalytic\SDK\ConfigurationUtils;
use Catalytic\SDK\Api\PushbotsApi;
use Catalytic\SDK\Entities\{Pushbot, PushbotsPage};
use Catalytic\SDK\Model\Pushbot as InternalPushbot;
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
     * @return Pushbot      The Pushbot object
     */
    public function get(string $id) : Pushbot
    {
        $internalPushbot = $this->pushbotsApi->getPushbot($id);
        $pushbot = $this->createPushbot($internalPushbot);
        return $pushbot;
    }

    /**
     * Find pushbots by a variety of filters
     *
     * @param string $filter    The filter criteria to search pushbots by
     * @param string $pageToken The token of the page to fetch
     * @param int    $pageSize  The number of pushbots per page to fetch
     * @param PushbotsPage      A PushbotsPage which contains the reults
     */
    public function find(Filter $filter = null, string $pageToken = null, int $pageSize = null) : PushbotsPage
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
            $pushbot = $this->createPushbot($internalPushbot);
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
    private function getSearchCriteriaValueByKey(array $array, string $name) : string
    {
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

    /**
     * Create a Pushbot object from an internal Pushbot object
     *
     * @param InternalPushbot  $internalPushbot     The internal pushbot to create a Pushbot object from
     * @return Pushbot         $pushbot             The created Pushbot object
     */
    private function createPushbot(InternalPushbot $internalPushbot) : Pushbot
    {
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
}
