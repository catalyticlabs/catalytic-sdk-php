<?php

namespace Catalytic\SDK\Clients;

use Exception;
use SplFileObject;
use Catalytic\SDK\CatalyticLogger;
use Catalytic\SDK\ConfigurationUtils;
use Catalytic\SDK\Clients\ClientHelpers;
use Catalytic\SDK\Api\FilesApi;
use Catalytic\SDK\ApiException;
use Catalytic\SDK\Entities\File;
use Catalytic\SDK\Exceptions\{
    FileNotFoundException,
    InternalErrorException,
    UnauthorizedException
};
use Catalytic\SDK\Model\FileMetadata as InternalFile;

/**
 * Files client
 */
class Files
{
    private $token;
    private $logger;
    private $filesApi;

    /**
     * Constructor for Files client
     *
     * @param string $token                 The token used to make the underlying api calls
     * @param FilesApi $filesApi (Optional) The injected DataTablesApi. Used for unit testing
     */
    public function __construct($token, $filesApi = null)
    {
        $config = null;
        $this->logger = CatalyticLogger::getLogger(Files::class);
        $this->token = ClientHelpers::trimIfString($token);

        if ($filesApi) {
            $this->filesApi = $filesApi;
        } else {
            $config = ConfigurationUtils::getConfiguration($this->token);
            $this->filesApi = new FilesApi(null, $config);
        }
    }

    /**
     * Get a File by id
     *
     * @param string $id                    The id of the File to get
     * @return File                         The File object
     * @throws AccessTokenNotFoundException If the client was instantiated without an Access Token
     * @throws FileNotFoundException        If File is not found
     * @throws InternalErrorException       If any errors fetching File
     * @throws UnauthorizedException        If unauthorized
     */
    public function get($id)
    {
        ClientHelpers::verifyAccessTokenExists($this->token);

        try {
            $this->logger->debug("Getting File with id $id");
            $internalFile = $this->filesApi->getFile($id);
        } catch (ApiException $e) {
            if ($e->getCode() === 401) {
                throw new UnauthorizedException(null, $e);
            } elseif ($e->getCode() === 404) {
                throw new FileNotFoundException("File with id $id not found", $e);
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
     * @throws AccessTokenNotFoundException If the client was instantiated without an Access Token
     * @throws InternalErrorException       If any errors downloading File
     * @throws UnauthorizedException        If unauthorized
     */
    public function download($id, $directory = null)
    {
        ClientHelpers::verifyAccessTokenExists($this->token);

        // By default this downloads the file to a temp dir
        try {
            $this->logger->debug("Downloading File with id $id");
            $file = $this->filesApi->downloadFile($id);
        } catch (ApiException $e) {
            if ($e->getCode() === 401) {
                throw new UnauthorizedException(null, $e);
            } elseif ($e->getCode() === 404) {
                throw new FileNotFoundException("File with id $id not found", $e);
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
     * @param SplFileObject $file           The File to upload
     * @return File                         The File that was uploaded
     * @throws AccessTokenNotFoundException If the client was instantiated without an Access Token
     * @throws InternalErrorExeption        If any errors uploading File
     * @throws UnauthorizedException        If unauthorized
     */
    public function upload($fileToUpload)
    {
        ClientHelpers::verifyAccessTokenExists($this->token);

        try {
            $this->logger->debug("Uploading File");
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
    private function createFile($internalFile)
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
