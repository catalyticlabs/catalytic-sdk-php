<?php

namespace Catalytic\SDK\Clients;

use Catalytic\SDK\Api\DataTablesApi;
use Catalytic\SDK\ConfigurationUtils;

/**
 * DataTables client to be exposed to consumers
 */
class DataTables
{
    private DataTablesApi $dataTablesApi;

    public function __construct($secret)
    {
        $config = ConfigurationUtils::getConfiguration($secret);
        $this->dataTablesApi = new DataTablesApi(null, $config);
    }

    public function get(string $id)
    {
        $dataTables = $this->dataTablesApi->findDataTables($id);
        return $dataTables;
    }

    public function find(Where $filter)
    {
        $dataTables = $this->dataTablesApi->findDataTables($filter);
        return $dataTables;
    }

    public function getFileStream(string $id)
    {
        throw new Exception('Not yet implemented');
    }

    public function downloadFile()
    {
        throw new Exception('Not yet implemented');
    }
}