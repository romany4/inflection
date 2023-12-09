<?php
namespace StaticallTest\inflection\inflection\Loader;

use PHPUnit\Framework\TestCase;

use romany4\inflection\inflection\Loader;

class AvailablesTest extends TestCase
{
    public function testAvailableFileTypesShouldReturnCorrectAmount()
    {
        static::assertCount(2, Loader::getAvailableFileTypes());
    }
}
