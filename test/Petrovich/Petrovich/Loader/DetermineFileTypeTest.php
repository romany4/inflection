<?php
namespace StaticallTest\inflection\inflection\Loader;

use PHPUnit\Framework\TestCase;

use romany4\inflection\inflection\Loader;

class DetermineFileTypeTest extends TestCase
{
    public function testAvailableFileTypes()
    {
        foreach (Loader::getAvailableFileTypes() as $availableFileType) {
            $filePath = 'test.' . $availableFileType;

            static::assertSame($availableFileType, Loader::determineFileType($filePath));
        }
    }

    public function testAvailableFileTypesWithPath()
    {
        foreach (Loader::getAvailableFileTypes() as $availableFileType) {
            $filePath = __DIR__ . '/test.' . $availableFileType;

            static::assertSame($availableFileType, Loader::determineFileType($filePath));
        }
    }

    public function testEmptyExceptionShouldReturnDefault()
    {
        static::assertSame(Loader::DEFAULT_FILE_TYPE, Loader::determineFileType(''));
        static::assertSame(Loader::DEFAULT_FILE_TYPE, Loader::determineFileType('test'));
        static::assertSame(Loader::DEFAULT_FILE_TYPE, Loader::determineFileType(__DIR__ . '/test'));
    }

    public function testUnknownExceptionShouldReturnDefault()
    {
        static::assertSame(Loader::DEFAULT_FILE_TYPE, Loader::determineFileType('test.unknown'));
        static::assertSame(Loader::DEFAULT_FILE_TYPE, Loader::determineFileType(__DIR__ . '/test.unknown'));
    }
}
