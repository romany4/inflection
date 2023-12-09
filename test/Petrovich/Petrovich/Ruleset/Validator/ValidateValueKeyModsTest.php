<?php
namespace StaticallTest\inflection\inflection\ruleset;

use PHPUnit\Framework\TestCase;

use romany4\inflection\inflection\Ruleset;

class ValidateValueKeyModsTest extends TestCase
{
    public function testNoSuchKey()
    {
        $validator = new ruleset\Validator;

        static::assertTrue($validator->validateValueKeyMods([]));
    }

    public function testRuleIsInvalidType()
    {
        $validator = new ruleset\Validator;

        static::assertFalse(
            $validator->validateValueKeyMods(
                [
                    Ruleset::VALUE_KEY_MODS => 'test',
                ]
            )
        );
    }

    public function testRuleIsValidType()
    {
        $validator = new ruleset\Validator;

        static::assertTrue(
            $validator->validateValueKeyMods(
                [
                    Ruleset::VALUE_KEY_MODS => [
                        'test',
                    ],
                ]
            )
        );
    }
}
