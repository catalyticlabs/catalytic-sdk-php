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
