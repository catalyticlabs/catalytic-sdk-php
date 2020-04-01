<?php

namespace Catalytic\SDK\Clients;

use Catalytic\SDK\Api\FilesApi;
use Catalytic\SDK\ConfigurationUtils;

/**
 * File client to be exposed to consumers
 */
class Files
{
    private FilesApi $filesApi;

    public function __construct($secret)
    {
        $config = ConfigurationUtils::getConfiguration($secret);
        $this->filesApi = new FilesApi(null, $config);
    }

    /**
     * Get a file by id
     */
    public function get(string $id)
    {
        $file = $this->filesApi->findFiles($id);
        return $file;
    }

    /**
     * Find files by a variety of criteria
     *
     * @param Where $filter The filter criteria to look up files
     */
    public function find(Where $filter)
    {
        $files = $this->filesApi->findFiles($filter);
        return $files;
    }

    public function getFileStream($id)
    {
        throw new Exception('Not yet implemented');
    }

    public function downloadFile($id)
    {
        throw new Exception('Not yet implemented');
    }

    public function updateFile(FileInfo $file)
    {
        throw new Exception('Not yet implemented');
    }
}
