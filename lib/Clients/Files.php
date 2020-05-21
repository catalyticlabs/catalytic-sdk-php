<?php

namespace Catalytic\SDK\Clients;

use Exception;
use SplFileObject;
use Catalytic\SDK\ConfigurationUtils;
use Catalytic\SDK\Api\FilesApi;
use Catalytic\SDK\ApiException;
use Catalytic\SDK\Entities\{File, FilesPage};
use Catalytic\SDK\Exceptions\{DataTableNotFoundException, FileNotFoundException, InternalErrorException, UnauthorizedException};
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
     * Get a File by id
     *
     * @param string $id                The id of the File to get
     * @return File                     The File object
     * @throws FileNotFoundException    If File is not found
     * @throws InternalErrorException   If any errors fetching File
     * @throws UnauthorizedException    If unauthorized
     */
    public function get(string $id): File
    {
        try {
            $internalFile = $this->filesApi->getFile($id);
        } catch (ApiException $e) {
            if ($e->getCode() === 401) {
                throw new UnauthorizedException(null, $e);
            } elseif ($e->getCode() === 404) {
                throw new FileNotFoundException("Unable to find file with id $id");
            }
            throw new InternalErrorException("Unable to get File", $e);
        }
        $file = $this->createFile($internalFile);
        return $file;
    }

    public function getFileStream($id)
    {
        throw new Exception('Not yet implemented');
    }

    /**
     * Downloads a File to the users temp dir or a specified dir if passed in
     *
     * @param string $id                    The id of the File to download
     * @param string $directory (Optional)  The dir to download the File to
     * @return SplFileObject                An object containing the File info
     * @throws InternalErrorException       If any errors downloading File
     * @throws UnauthorizedException        If unauthorized
     */
    public function download(string $id, string $directory = null): SplFileObject
    {
        // By default this downloads the file to a temp dir
        try {
            $file = $this->filesApi->downloadFile($id);
        } catch (ApiException $e) {
            if ($e->getCode() === 401) {
                throw new UnauthorizedException(null, $e);
            } elseif ($e->getCode() === 404) {
                throw new FileNotFoundException("File with id $id not found", $e)
            }
            throw new InternalErrorException("Unable to download File", $e);
        }

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
            // TODO: Use some other more specific exception
            throw new Exception('Failed to download file to ' . $directory);
        }

        $newFile = new SplFileObject($newPath);
        return $newFile;
    }

    /**
     * Uploads the passed in File
     *
     * @param SplFileObject $file       The File to upload
     * @return File                     The File that was uploaded
     * @throws InternalErrorExeption    If any errors uploading File
     * @throws UnauthorizedException    If unauthorized
     */
    public function upload(SplFileObject $fileToUpload): File
    {
        try {
            $internalFile = $this->filesApi->uploadFiles($fileToUpload);
        } catch (ApiException $e) {
            if ($e->getCode() === 401) {
                throw new UnauthorizedException(null, $e);
            }
            throw new InternalErrorException("Unable to upload File", $e);
        }
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
