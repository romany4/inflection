<?php
namespace StaticallTest\inflection\inflection\Loader;

use PHPUnit\Framework\TestCase;

use romany4\inflection\inflection\Loader;
use romany4\inflection\inflection\IOException;
use romany4\inflection\inflection\RuntimeException;

class LoadTest extends TestCase
{
    public function testUnknownExtension()
    {
        $filePath = realpath(__DIR__ . '/../../../files/file.unknown');

        static::expectException(RuntimeException::class);
        static::expectExceptionMessage('File has invalid format');

        Loader::load($filePath, 'unknown');
    }

    public function testInvalidFile()
    {
        $filePath = realpath(__DIR__ . '/../../../files/file.not-exists');

        static::expectException(IOException::class);
        static::expectExceptionMessage('File "' . $filePath . '" doesn\'t exist or is not readable');

        Loader::load($filePath);
    }
}
