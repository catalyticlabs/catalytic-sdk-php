<?php

namespace Catalytic\SDK\Clients;

use Exception;
use SplFileObject;
use Catalytic\SDK\ConfigurationUtils;
use Catalytic\SDK\Api\FilesApi;
use Catalytic\SDK\Entities\{File, FilesPage};
use Catalytic\SDK\Model\FileMetadata as InternalFile;
use Catalytic\SDK\Search\{Filter, SearchUtils};

/**
 * Files client
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
     *
     * @param string $id    The id of the file to get
     * @return File         The File object
     */
    public function get(string $id) : File
    {
        $internalFile = $this->filesApi->getFile($id);
        $file = $this->createFile($internalFile);
        return $file;
    }

    /**
     * Find files by a variety of criteria
     *
     * @param Filter $filter    The filter criteria to search files by
     * @param string $pageToken The token of the page to fetch
     * @param int    $pageSize  The number of files per page to fetch
     * @return FilesPage        A FilesPage which contains the reults
     */
    public function find(Filter $filter = null, string $pageToken = null, int $pageSize = null): FilesPage
    {
        $text = null;
        $owner = null;
        $workflowId = null;
        $instanceId = null;

        if ($filter !== null) {
            $text = SearchUtils::getSearchCriteriaValueByKey($filter->searchFilters, 'text');
            $owner = SearchUtils::getSearchCriteriaValueByKey($filter->searchFilters, 'owner');
            $workflowId = SearchUtils::getSearchCriteriaValueByKey($filter->searchFilters, 'workflowId');
            $instanceId = SearchUtils::getSearchCriteriaValueByKey($filter->searchFilters, 'instanceId');
        }
        $internalFiles = $this->filesApi->findFiles($text, null, $workflowId, $instanceId, $owner, null, null, $pageToken, $pageSize);
        $files = [];
        foreach ($internalFiles->getFiles() as $internalFile) {
            $file = $this->createFile($internalFile);
            array_push($files, $file);
        }

        $filesPage = new FilesPage($files, $internalFiles->getCount(), $internalFiles->getNextPageToken());
        return $filesPage;
    }

    public function getFileStream($id)
    {
        throw new Exception('Not yet implemented');
    }

    /**
     * Downloads a file to the users temp dir or a specified dir if passed in
     *
     * @param string $id                    The id of the file to download
     * @param string $directory (Optional)  The dir to download the file to
     * @return SplFileObject                An object containing the file info
     * @throws Exception
     */
    public function download(string $id, string $directory = null)
    {
        // By default this downloads the file to a temp dir
        $file = $this->filesApi->downloadFile($id);

        // If no directory was passed in, return the downloaded file
        // as a SplFileInfo object
        if ($directory === null) {
            return $file;
        }

        // If a directory was passed in, move the file from the temp dir
        // to $directory and return the new file as a SplFileInfo object
        $newPath = realpath($directory) . '/' . $file->getFilename();
        $renamed = rename($file->getRealPath(), $newPath);

        if (!$renamed) {
            throw new Exception('Failed to download file to ' . $directory);
        }

        $newFile = new SplFileObject($newPath);
        return $newFile;
    }

    /**
     * Uploads the passed in file
     *
     * @param SplFileObject $file   The file to upload
     * @return File                 The file that was uploaded
     */
    public function upload(SplFileObject $fileToUpload) : File
    {
        $internalFile = $this->filesApi->uploadFiles($fileToUpload);
        $uploadedFile = $internalFile->getFiles()[0];
        $file = $this->createFile($uploadedFile);
        return $file;
    }

    /**
     * Create a File object from an internal File object
     *
     * @param InternalFile  $internalFile   The internal file to create a File object from
     * @return File                         The created File object
     */
    private function createFile(InternalFile $internalFile): File
    {
        $file = new File(
            $internalFile->getId(),
            $internalFile->getName(),
            $internalFile->getTeamName(),
            $internalFile->getContentType(),
            $internalFile->getSizeInBytes(),
            $internalFile->getDisplaySize(),
            $internalFile->getIsPublic(),
            $internalFile->getMd5Hash(),
            $internalFile->getReferenceName(),
        );
        return $file;
    }
}
