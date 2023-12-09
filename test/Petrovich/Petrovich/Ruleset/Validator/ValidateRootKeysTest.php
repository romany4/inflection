<?php
namespace StaticallTest\inflection\inflection\ruleset;

use PHPUnit\Framework\TestCase;

use romany4\inflection\inflection\Ruleset;

class ValidateRootKeysTest extends TestCase
{
    public function testNoRootKeysFoundShouldLeadToFalse()
    {
        $rootKeys = Ruleset::getAvailableRootKeys();
        $rules    = [];

        $validator = new ruleset\Validator();

        static::assertFalse($validator->validateRootKeys($rules));
    }

    public function testNoAvailableRootKeysFoundShouldLeadToFalse()
    {
        $rootKeys = Ruleset::getAvailableRootKeys();
        $rules    = [];

        foreach ($rootKeys as $key) {
            $rules[$key . '_'] = [];
        }

        $validator = new ruleset\Validator();

        static::assertFalse($validator->validateRootKeys($rules));
    }

    public function testUnknownRootKeysFoundShouldLeadToFalse()
    {
        $rootKeys = Ruleset::getAvailableRootKeys();
        $rules    = [];

        foreach ($rootKeys as $key) {
            $rules[$key] = [];
            $rules[$key . '_'] = [];
        }

        $validator = new ruleset\Validator();

        static::assertFalse($validator->validateRootKeys($rules));
    }

    public function testSingleAvailableRootKeyFoundShouldLeadToTrue()
    {
        $rootKeys = Ruleset::getAvailableRootKeys();
        $rules    = [];

        foreach ($rootKeys as $key) {
            $rules[$key] = [];

            break;
        }

        $validator = new ruleset\Validator();

        static::assertTrue($validator->validateRootKeys($rules));
    }

    public function testAllAvailableRootKeyFoundShouldLeadToTrue()
    {
        $rootKeys = Ruleset::getAvailableRootKeys();
        $rules    = [];

        foreach ($rootKeys as $key) {
            $rules[$key] = [];
        }

        $validator = new ruleset\Validator();

        static::assertTrue($validator->validateRootKeys($rules));
    }
}
