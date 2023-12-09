<?php
namespace StaticallTest\inflection;

use PHPUnit\Framework\TestCase;

use romany4\inflection\Inflection;

class RulesetAndConstructTest extends TestCase
{
    public function testConstructShouldStoreRuleset()
    {
        $ruleset = new inflection\Ruleset([], false);

        $petrovich = new Inflection($ruleset);

        static::assertSame($ruleset, $petrovich->getRuleset());
    }

    public function testSetterShouldStoreRuleset()
    {
        $rulesetConstruct = new inflection\Ruleset([], false);
        $rulesetSetter    = new inflection\Ruleset([], false);

        $petrovich = new Inflection($rulesetConstruct);

        static::assertNotSame($rulesetSetter, $rulesetConstruct);

        $petrovich->setRuleset($rulesetSetter);

        static::assertSame($rulesetSetter, $petrovich->getRuleset());
    }
}
