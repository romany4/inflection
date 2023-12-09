<?php
namespace StaticallTest\inflection\inflection\ruleset;

use PHPUnit\Framework\TestCase;

use romany4\inflection\inflection\Ruleset;

class ValidateValueKeyTagsTest extends TestCase
{
    public function testNoSuchKey()
    {
        $validator = new ruleset\Validator;

        static::assertTrue($validator->validateValueKeyTags([]));
    }

    public function testRuleIsInvalidType()
    {
        $validator = new ruleset\Validator;

        static::assertFalse(
            $validator->validateValueKeyTags(
                [
                    Ruleset::VALUE_KEY_TAGS => 'test',
                ]
            )
        );
    }

    public function testRuleIsValidType()
    {
        $validator = new ruleset\Validator;

        static::assertTrue(
            $validator->validateValueKeyTags(
                [
                    Ruleset::VALUE_KEY_TAGS => [
                        'test',
                    ],
                ]
            )
        );
    }
}
