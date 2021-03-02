<?php

namespace Catalytic\SDK\Clients;

use Exception;
use SplFileObject;
use Catalytic\SDK\ApiException;
use Catalytic\SDK\CatalyticLogger;
use Catalytic\SDK\ConfigurationUtils;
use Catalytic\SDK\Api\DataTablesApi;
use Catalytic\SDK\Clients\ClientHelpers;
use Catalytic\SDK\Entities\{DataTable, DataTablesPage};
use Catalytic\SDK\Exceptions\{InternalErrorException, DataTableNotFoundException, UnauthorizedException};
use Catalytic\SDK\Model\DataTable as InternalDataTable;
use Catalytic\SDK\Search\SearchUtils;

/**
 * DataTables client
 */
class DataTables
{
    private $token;
    private $logger;
    private $dataTablesApi;

    /**
     * Constructor for DataTables client
     *
     * @param string $token                             The token used to make the underlying api calls
     * @param DataTablesApi $dataTablesApi (Optional)   The injected DataTablesApi. Used for unit testing
     */
    public function __construct($token, $dataTablesApi = null)
    {
        $config = null;
        $this->logger = CatalyticLogger::getLogger(DataTables::class);
        $this->token = ClientHelpers::trimIfString($token);

        if ($dataTablesApi) {
            $this->dataTablesApi = $dataTablesApi;
        } else {
            $config = ConfigurationUtils::getConfiguration($this->token);
            $this->dataTablesApi = new DataTablesApi(null, $config);
        }
    }

    /**
     * Get a Datatable by id
     *
     * @param string $id                    The id of the Datatable to get
     * @return DataTable                    The Datatable object
     * @throws AccessTokenNotFoundException If the client was instantiated without an Access Token
     * @throws DataTableNotFoundException   If DataTable not found
     * @throws InternalErrorException       If any errors fetching DataTable
     * @throws UnauthorizedException        If unauthorized
     */
    public function get($id)
    {
        ClientHelpers::verifyAccessTokenExists($this->token);

        try {
            $this->logger->debug("Getting DataTable with id $id");
            $internalDataTable = $this->dataTablesApi->getDataTable($id);
        } catch (ApiException $e) {
            if ($e->getCode() === 401) {
                throw new UnauthorizedException(null, $e);
            } elseif ($e->getCode() === 404) {
                throw new DataTableNotFoundException("DataTable with id $id not found", $e);
            }
            throw new InternalErrorException("Unable to get DataTable", $e);
        }
        $dataTable = $this->createDataTable($internalDataTable);
        return $dataTable;
    }

    // /**
    //  * Find DataTables by a variety of filters
    //  *
    //  * @param string $filter                The filter to search DataTables by
    //  * @return DataTablesPage               A DataTablesPage which contains the results
    //  * @throws AccessTokenNotFoundException If the client was instantiated without an Access Token
    //  * @throws InternalErrorException       If any errors finding DataTables
    //  * @throws UnauthorizedException        If unauthorized
    //  */
    // public function find($filter = null, $pageToken = null, $pageSize = null)
    // {
    //     ClientHelpers::verifyAccessTokenExists($this->token);

    //     $text = null;
    //     $dataTables = [];

    //     if ($filter !== null) {
    //         $text = SearchUtils::getSearchCriteriaValueByKey($filter->searchFilters, 'text');
    //     }

    //     try {
    //         $this->logger->debug("Finding DataTables with text $text");
    //         $internalDataTables = $this->dataTablesApi->findDataTables($text, null, null, null, null, null, null, $pageToken, $pageSize);
    //     } catch (ApiException $e) {
    //         if ($e->getCode() === 401) {
    //             throw new UnauthorizedException(null, $e);
    //         }
    //         throw new InternalErrorException("Unable to find DataTables");
    //     }

    //     foreach ($internalDataTables->getDataTables() as $internalDataTable) {
    //         $dataTable = $this->createDataTable($internalDataTable);
    //         array_push($dataTables, $dataTable);
    //     }

    //     $dataTablesPage = new DataTablesPage($dataTables, $internalDataTables->getCount(), $internalDataTables->getNextPageToken());
    //     return $dataTablesPage;
    // }

    /**
     * Downloads a data table in the format passed in to the users temp dir or a specified dir if passed in
     *
     * @param string $id                    The id of the dataTable to download
     * @param string $format                The format of the data table to download
     * @param string $directory (Optional)  The dir to download the dataTable to
     * @return SplFileObject                An object containing the dataTable info
     * @throws AccessTokenNotFoundException If the client was instantiated without an Access Token
     * @throws DataTableNotFoundException   If DataTable not found
     * @throws InternalErrorException       If errors saving to $directory
     * @throws UnauthorizedException        If unauthorized
     */
    public function download($id, $format, $directory = null)
    {
        ClientHelpers::verifyAccessTokenExists($this->token);

        // By default this downloads the file to a temp dir
        try {
            $this->logger->debug("Downloading DataTable with id $id and format $format");
            $dataTableFile = $this->dataTablesApi->downloadDataTable($id, $format);
        } catch (ApiException $e) {
            if ($e->getCode() === 401) {
                throw new UnauthorizedException(null, $e);
            } elseif ($e->getCode() === 404) {
                throw new DataTableNotFoundException("DataTable with id $id not found", $e);
            }
            throw new InternalErrorException("Unable to download DataTable", $e);
        }

        // If no directory was passed in, return the downloaded data table
        // as a SplFileInfoObject
        if ($directory === null) {
            return $dataTableFile;
        }

        // If a directory was passed in, move the file from the temp dir
        // to $directory and return the new file as a SplFileInfo object
        $newPath = realpath($directory) . '/' . $dataTableFile->getFilename();
        $renamed = rename($dataTableFile->getRealPath(), $newPath);

        if (!$renamed) {
            // TODO: This should be some other more specific exception
            throw new Exception('Failed to download data table to ' . $directory);
        }

        $newDataTableFile = new SplFileObject($newPath);
        return $newDataTableFile;
    }

    /**
     * Uploads the passed in file as a data table
     *
     * @param SplFileObject $dataTableFile          The file to upload as a data table
     * @param string        $tableName (Optional)   A name to give to the table
     * @param int           $headerRow (Optional)   The header row
     * @param int           $sheetNumber (Optional) The sheet number of an excel file to use
     * @return DataTable                            The DataTable that was uploaded
     * @throws AccessTokenNotFoundException         If the client was instantiated without an Access Token
     * @throws InternalErrorException               If any errors uploading the DataTable
     * @throws UnauthorizedException                If unauthorized
     */
    public function upload($dataTableFile, $tableName = null, $headerRow = 1, $sheetNumber = 1)
    {
        ClientHelpers::verifyAccessTokenExists($this->token);

        try {
            $this->logger->debug("Uploading DataTable with tableName $tableName");
            $internalDataTable = $this->dataTablesApi->uploadDataTable($tableName, $headerRow, $sheetNumber, $dataTableFile);
        } catch (ApiException $e) {
            if ($e->getCode() === 401) {
                throw new UnauthorizedException(null, $e);
            }
            throw new InternalErrorException("Unable to upload DataTable", $e);
        }
        $dataTable = $this->createDataTable($internalDataTable);
        return $dataTable;
    }

    /**
     * Replaces the data table with $id with the passed in $dataTableFile
     *
     * @param string        $id                     The id of the data table to replace
     * @param SplFileObject $dataTableFile          The data table to replace with
     * @param int           $headerRow (Optional)   The header row
     * @param int           $sheetNumber (Optional) The sheet number of an excel file to use
     * @return DataTable                            The new DataTable
     * @throws AccessTokenNotFoundException         If the client was instantiated without an Access Token
     * @throws DataTableNotFoundException           If DataTable is not found
     * @throws InternalErrorException               If any errors replacing DataTable
     * @throws UnauthorizedException                If unauthorized
     */
    public function replace($id, $dataTableFile, $headerRow = 1, $sheetNumber = 1)
    {
        ClientHelpers::verifyAccessTokenExists($this->token);

        try {
            $this->logger->debug("Replacing DataTable with id $id");
            $internalDataTable = $this->dataTablesApi->replaceDataTable($id, $headerRow, $sheetNumber, $dataTableFile);
        } catch (ApiException $e) {
            if ($e->getCode() === 401) {
                throw new UnauthorizedException(null, $e);
            } elseif ($e->getCode() === 404) {
                throw new DataTableNotFoundException("DataTable with id $id not found");
            }
            throw new InternalErrorException("Unable to replace DataTable");
        }
        $dataTable = $this->createDataTable($internalDataTable);
        return $dataTable;
    }

    /**
     * Create a DataTable object from an internal DataTable object
     *
     * @param InternalDataTable $internalDataTable  The internal datatable to create a DataTable object from
     * @return DataTable        $dataTable          The created DataTable object
     */
    private function createDataTable($internalDataTable)
    {
        $dataTable = new DataTable(
            $internalDataTable->getId(),
            $internalDataTable->getReferenceName(),
            $internalDataTable->getName(),
            $internalDataTable->getTeamName(),
            $internalDataTable->getDescription(),
            $internalDataTable->getColumns(),
            $internalDataTable->getIsArchived(),
            $internalDataTable->getType(),
            $internalDataTable->getVisibility(),
            $internalDataTable->getVisibleToUsers(),
            $internalDataTable->getRowLimit(),
            $internalDataTable->getColumnLimit(),
            $internalDataTable->getCellLimit()
        );
        return $dataTable;
    }
}