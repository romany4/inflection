<?php
namespace StaticallTest\inflection\inflection\ruleset;

use PHPUnit\Framework\TestCase;

use romany4\inflection\inflection\Ruleset;

class ValidateValueKeyGenderTest extends TestCase
{
    public function testNoSuchKey()
    {
        $validator = new ruleset\Validator;

        static::assertTrue($validator->validateValueKeyGender([]));
    }

    public function testRuleIsInvalidType()
    {
        $validator = new ruleset\Validator;

        static::assertFalse(
            $validator->validateValueKeyGender(
                [
                    Ruleset::VALUE_KEY_GENDER => [],
                ]
            )
        );
    }

    public function testRuleIsValidValue()
    {
        $validator = new ruleset\Validator;

        foreach (Ruleset::getAvailableGenders() as $gender) {
            static::assertTrue(
                $validator->validateValueKeyGender(
                    [
                        Ruleset::VALUE_KEY_GENDER => $gender,
                    ]
                )
            );
        }
    }

    public function testRuleUnknownValue()
    {
        $validator = new ruleset\Validator;

        static::assertFalse(
            $validator->validateValueKeyGender(
                [
                    Ruleset::VALUE_KEY_GENDER => 'unknownGender',
                ]
            )
        );
    }
}
