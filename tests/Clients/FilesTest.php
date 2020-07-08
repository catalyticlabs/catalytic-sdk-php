<?php

use Catalytic\SDK\ApiException;
use Catalytic\SDK\Clients\Files;
use Catalytic\SDK\Entities\File;
use Catalytic\SDK\Exceptions\{
    AccessTokenNotFoundException,
    FileNotFoundException,
    InternalErrorException,
    UnauthorizedException,
};
use Catalytic\SDK\Search\Where;
use Mockery\Adapter\Phpunit\MockeryTestCase;

class FilesTest extends MockeryTestCase
{
    protected function tearDown(): void
    {
        // Delete the file that was created in any of the tests
        if (file_exists('foobar')) {
            unlink('foobar');
        }
    }

    public function testGetFile_ItShouldReturnAccessTokenNotFoundException()
    {
        $this->expectException(AccessTokenNotFoundException::class);
        $this->expectExceptionMessage('Access Token not found. Instantiate CatalyticClient with one of the authentication options or call CatalyticClient->setToken()');

        $filesClient = new Files(null);
        $filesClient->get('1234');
    }

    public function testGetFile_ItShouldThrowFileNotFoundExceptionIfFileDoesNotExist()
    {
        $this->expectException(FileNotFoundException::class);
        $this->expectExceptionMessage("File with id 1234 not found");

        $filesApi = Mockery::mock('Catalytic\SDK\Api\FilesApi');
        $filesApi->shouldReceive('getFile')
        ->andThrow(new ApiException(null, 404));

        $filesClient = new Files('1234', $filesApi);
        $filesClient->get('1234');
    }

    public function testGetFile_ItShouldThrowUnauthorizedExceptionIfFileDoesNotExist()
    {
        $this->expectException(UnauthorizedException::class);
        $this->expectExceptionMessage("Unauthorized");

        $filesApi = Mockery::mock('Catalytic\SDK\Api\FilesApi');
        $filesApi->shouldReceive('getFile')
        ->andThrow(new ApiException(null, 401));

        $filesClient = new Files('1234', $filesApi);
        $filesClient->get('alice@catalytic.com');
    }

    public function testGetFile_ItShouldThrowUInternalErrorExceptionIfFileDoesNotExist()
    {
        $this->expectException(InternalErrorException::class);
        $this->expectExceptionMessage("Unable to get File");

        $filesApi = Mockery::mock('Catalytic\SDK\Api\FilesApi');
        $filesApi->shouldReceive('getFile')
        ->andThrow(new ApiException(null, 500));

        $filesClient = new Files('1234', $filesApi);
        $filesClient->get('alice@catalytic.com');
    }

    public function testGetFile_ItShouldGetAFile()
    {
        $file = new \Catalytic\SDK\Model\FileMetadata(
            array(
                'id' => '7c4cfdcc-2964-4f1f-8d56-ac8a260e91bd',
                'name' => 'Example file',
                'contentType' => 'text/html',
                'teamName' => 'example',
                'sizeInBytes' => '6024',
                'displaySize' => '100',
                'isPublic' => true,
                'md5Hash' => 'asdfasd',
                'referenceName' => 'example-file'
            )
        );
        $filesApi = Mockery::mock('Catalytic\SDK\Api\FilesApi');
        $filesApi->shouldReceive('getFile')
        ->andReturn($file);

        $filesClient = new Files('1234', $filesApi);
        $file = $filesClient->get('alice@catalytic.com');
        $this->assertInstanceOf(File::class, $file);
    }

    public function testDownloadFile_ItShouldReturnAccessTokenNotFoundException()
    {
        $this->expectException(AccessTokenNotFoundException::class);
        $this->expectExceptionMessage('Access Token not found. Instantiate CatalyticClient with one of the authentication options or call CatalyticClient->setToken()');

        $filesClient = new Files(null);
        $filesClient->download('1234');
    }

    public function testDownloadFile_itShouldThrowUnauthorizedException() {
        $this->expectException(UnauthorizedException::class);
        $this->expectExceptionMessage("Unauthorized");

        $filesApi = Mockery::mock('Catalytic\SDK\Api\FilesApi');
        $filesApi->shouldReceive('downloadFile')
        ->andThrow(new ApiException(null, 401));

        $filesClient = new Files('1234', $filesApi);
        $filesClient->download('1234');
    }

    public function testDownloadFile_itShouldThrowFileNotFoundException() {
        $this->expectException(FileNotFoundException::class);
        $this->expectExceptionMessage("File with id 1234 not found");

        $filesApi = Mockery::mock('Catalytic\SDK\Api\FilesApi');
        $filesApi->shouldReceive('downloadFile')
        ->andThrow(new ApiException(null, 404));

        $filesClient = new Files('1234', $filesApi);
        $filesClient->download('1234');
    }

    public function testDownloadFile_itShouldThrowInternalErrorException() {
        $this->expectException(InternalErrorException::class);
        $this->expectExceptionMessage("Unable to download File");

        $filesApi = Mockery::mock('Catalytic\SDK\Api\FilesApi');
        $filesApi->shouldReceive('downloadFile')
        ->andThrow(new ApiException(null, 500));

        $filesClient = new Files('1234', $filesApi);
        $filesClient->download('1234', 'csv');
    }

    public function testDownloadFile_itShouldDownloadFile() {
        $file = new SplFileObject('foobar', 'w');
        $filesApi = Mockery::mock('Catalytic\SDK\Api\FilesApi');
        $filesApi->shouldReceive('downloadFile')
        ->andReturn($file);

        $filesClient = new Files('1234', $filesApi);
        $file = $filesClient->download('7c4cfdcc-2964-4f1f-8d56-ac8a260e91bd');
        $this->assertInstanceOf(SplFileObject::class, $file);
    }

    public function testUploadFile_ItShouldReturnAccessTokenNotFoundException()
    {
        $this->expectException(AccessTokenNotFoundException::class);
        $this->expectExceptionMessage('Access Token not found. Instantiate CatalyticClient with one of the authentication options or call CatalyticClient->setToken()');

        $filesClient = new Files(null);
        $filesClient->upload('1234');
    }

    public function testUploadFile_itShouldThrowUnauthorizedException()
    {
        $this->expectException(UnauthorizedException::class);
        $this->expectExceptionMessage("Unauthorized");

        $filesApi = Mockery::mock('Catalytic\SDK\Api\FilesApi');
        $filesApi->shouldReceive('uploadFiles')->andThrow(new ApiException(null, 401));
        $fileFile = new SplFileObject('foobar', 'w');

        $filesClient = new Files('1234', $filesApi);
        $filesClient->upload($fileFile);
    }

    public function testUploadFile_itShouldThrowInternalErrorException()
    {
        $this->expectException(InternalErrorException::class);
        $this->expectExceptionMessage("Unable to upload File");

        $filesApi = Mockery::mock('Catalytic\SDK\Api\FilesApi');
        $filesApi->shouldReceive('uploadFiles')->andThrow(new ApiException(null, 500));
        $fileFile = new SplFileObject('foobar', 'w');

        $filesClient = new Files('1234', $filesApi);
        $filesClient->upload($fileFile);
    }

    public function testUploadFile_itShouldUploadFile()
    {
        $internalFile = new \Catalytic\SDK\Model\FileMetadata(
            array(
                'id' => '7c4cfdcc-2964-4f1f-8d56-ac8a260e91bd',
                'name' => 'Example file',
                'contentType' => 'text/html',
                'teamName' => 'example',
                'sizeInBytes' => '6024',
                'displaySize' => '100',
                'isPublic' => true,
                'md5Hash' => 'asdfasd',
                'referenceName' => 'example-file'
            )
        );
        $fileMetadataPage = new \Catalytic\SDK\Model\FileMetadataPage(
            array(
                'files' => array($internalFile),
                'nextPageToken' => null,
                'count' => 1
            )
        );
        $fileFile = new SplFileObject('foobar', 'w');
        $filesApi = Mockery::mock('Catalytic\SDK\Api\FilesApi');
        $filesApi->shouldReceive('uploadFiles')->andReturn($fileMetadataPage);

        $filesClient = new Files('1234', $filesApi);
        $file = $filesClient->upload($fileFile);
        $this->assertInstanceOf(File::class, $file);
    }
}
