<?php
namespace StaticallTest\inflection\inflection\Loader;

use PHPUnit\Framework\TestCase;

use romany4\inflection\inflection\Loader;
use romany4\inflection\inflection\Ruleset;

class LoadRealTest extends TestCase
{
    public function testGetVendorShouldReturnSameRules()
    {
        $expected = $this->getRuleFilePath('rules.json');
        $testable = Loader::getVendorRulesFilePath(Loader::FILE_TYPE_JSON);

        static::assertSame(realpath($expected), realpath($testable));
    }

    public function testLoadCorrectJsonRules()
    {
        $filePath = $this->getRuleFilePath('rules.json');

        $loadJson     = Loader::loadJson($filePath, true);
        $load         = Loader::load($filePath, null, true);
        $loadWithType = Loader::load($filePath, Loader::FILE_TYPE_JSON, true);

        static::assertInstanceOf(Ruleset::class, $loadJson);
        static::assertInstanceOf(Ruleset::class, $load);
        static::assertInstanceOf(Ruleset::class, $loadWithType);

        static::assertSame($loadJson->getRules(), $load->getRules());
        static::assertSame($loadJson->getRules(), $loadWithType->getRules());
    }

    public function testLoadCorrectYamlRules()
    {
        $filePath = $this->getRuleFilePath('rules.yml');

        $loadYaml     = Loader::loadYml($filePath, true);
        $load         = Loader::load($filePath, null, true);
        $loadWithType = Loader::load($filePath, Loader::FILE_TYPE_YML, true);

        static::assertInstanceOf(Ruleset::class, $loadYaml);
        static::assertInstanceOf(Ruleset::class, $load);
        static::assertInstanceOf(Ruleset::class, $loadWithType);

        static::assertSame($loadYaml->getRules(), $load->getRules());
        static::assertSame($loadYaml->getRules(), $loadWithType->getRules());
    }

    public function getRuleFilePath(string $file)
    {
        return __DIR__ . '/../../../../vendor/cloudloyalty/petrovich-rules/' . $file;
    }
}
