<?php
namespace StaticallTest\inflection\inflection\ruleset;

use PHPUnit\Framework\TestCase;

use romany4\inflection\inflection\Ruleset;

class ValidateValueKeyTestTest extends TestCase
{
    public function testNoSuchKey()
    {
        $validator = new ruleset\Validator;

        static::assertTrue($validator->validateValueKeyTest([]));
    }

    public function testRuleIsInvalidType()
    {
        $validator = new ruleset\Validator;

        static::assertFalse(
            $validator->validateValueKeyTest(
                [
                    Ruleset::VALUE_KEY_TEST => 'test',
                ]
            )
        );
    }

    public function testRuleIsValidType()
    {
        $validator = new ruleset\Validator;

        static::assertTrue(
            $validator->validateValueKeyTest(
                [
                    Ruleset::VALUE_KEY_TEST => [
                        'test',
                    ],
                ]
            )
        );
    }
}
