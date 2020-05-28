<?php

// use Catalytic\SDK\CatalyticClient;
// use Catalytic\SDK\Entities\File;
// use Catalytic\SDK\Exceptions\FileNotFoundException;
// use Catalytic\SDK\Search\Where;
// use PHPUnit\Framework\TestCase;

// class FilesTest extends TestCase
// {
//     public function testItShouldThrowAnExceptionIfFileDoesNotExist()
//     {
//         $this->expectException(FileNotFoundException::class);
//         $this->expectExceptionMessage("Unable to find file with id 1234");
//         $catalytic = new CatalyticClient();
//         $catalytic->files()->get('1234');
//     }

//     public function testItShouldGetFile()
//     {
//         $catalytic = new CatalyticClient();
//         $file = $catalytic->files()->get('924cd388-addb-42f7-913e-24c9beb17635');
//         $this->assertInstanceOf(File::class, $file);
//     }

//     // TODO: Need to figure out why this test is failing with memory issues
//     // public function testItShouldThrowAnExceptionIfFileDoesNotExistWhenTryingToDownload()
//     // {
//     //     $this->expectException(FileNotFoundException::class);
//     //     $this->expectExceptionMessage("File with id 00000000-0000-0000-0000-000000000000 not found");
//     //     $catalytic = new CatalyticClient();
//     //     $file = $catalytic->files()->download('00000000-0000-0000-0000-000000000000');
//     //     $this->assertInstanceOf(File::class, $file);
//     // }

//     public function testItShouldDownloadFile()
//     {
//         $catalytic = new CatalyticClient();
//         $file = $catalytic->files()->download('924cd388-addb-42f7-913e-24c9beb17635');
//         $this->assertInstanceOf(SplFileObject::class, $file);
//     }

//     public function testItShouldUploadFile()
//     {
//         $catalytic = new CatalyticClient();
//         $file = new SplFileObject('/Users/tomcaflisch/Downloads/testing-php-sdk-export.catalytic');
//         $file = $catalytic->files()->upload($file);
//         $this->assertInstanceOf(File::class, $file);
//     }
// }
