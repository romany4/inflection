<?php
namespace StaticallTest\inflection\inflection\ruleset;

use PHPUnit\Framework\TestCase;

use romany4\inflection\inflection\Ruleset;

class ValidateTest extends TestCase
{
    public function testOnlyAvailableRootKeys()
    {
        $ruleset = new Ruleset([], false);

        $rules = [];

        foreach (Ruleset::getAvailableRootKeys() as $availableRootKey) {
            $rules[$availableRootKey] = [];
        }

        static::assertTrue($ruleset->validate($rules));
    }

    public function testUnknownRootKey()
    {
        $ruleset = new Ruleset([], false);

        $rules = [
            'unknownRootKey' => [],
        ];

        static::assertFalse($ruleset->validate($rules));
    }

    public function testMixedBothKnownAndUnknownRootKeys()
    {
        $ruleset = new Ruleset([], false);

        $rules = [
            Ruleset::ROOT_KEY_FIRSTNAME => [],
        ];

        static::assertTrue($ruleset->validate($rules));

        $rules = [
            'unknownRootKey' => [],
        ];

        static::assertFalse($ruleset->validate($rules));

        $rules = [
            Ruleset::ROOT_KEY_FIRSTNAME => [],
            'unknownRootKey'            => [],
        ];

        static::assertFalse($ruleset->validate($rules));
    }
}
