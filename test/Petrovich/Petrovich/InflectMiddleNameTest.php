<?php
namespace StaticallTest\inflection\inflection;

use PHPUnit\Framework\TestCase;

use romany4\inflection\Inflection;

class InflectMiddleNameTest extends TestCase
{
    public function testWithoutMiddleNameRules()
    {
        $ruleset = inflection\Loader::load(inflection\Loader::getVendorRulesFilePath());

        $rules = $ruleset->getRules();

        unset($rules[inflection\Ruleset::ROOT_KEY_MIDDLENAME]);

        $ruleset->setRules($rules, false);

        $petrovich = new Inflection($ruleset);

        $name = 'Афанасьевич';

        $this->expectException(inflection\RuntimeException::class);
        $this->expectExceptionMessage('Missing key "' . inflection\Ruleset::ROOT_KEY_MIDDLENAME . '" for inflection');

        $petrovich->inflectMiddleName($name, inflection\Ruleset::CASE_NOMENATIVE, inflection\Ruleset::GENDER_MALE);
    }

    public function testMale()
    {
        $petrovich = new Inflection(inflection\Loader::load(inflection\Loader::getVendorRulesFilePath()));

        $names = [
            'Алексеевич' => [
                inflection\Ruleset::CASE_NOMENATIVE    => 'Алексеевич',
                inflection\Ruleset::CASE_GENITIVE      => 'Алексеевича',
                inflection\Ruleset::CASE_DATIVE        => 'Алексеевичу',
                inflection\Ruleset::CASE_ACCUSATIVE    => 'Алексеевича',
                inflection\Ruleset::CASE_INSTRUMENTAL  => 'Алексеевичем',
                inflection\Ruleset::CASE_PREPOSITIONAL => 'Алексеевиче',
            ],

        ];

        foreach ($names as $input => $name) {
            foreach (inflection\Ruleset::getAvailableCases() as $case) {
                static::assertSame(
                    $name[$case],
                    $petrovich->inflectMiddleName($input, $case, inflection\Ruleset::GENDER_MALE),
                    'Invalid casing of "' . $input . '" for "' . $case . '" case, expecting "' . $name[$case] . '"'
                );
            }
        }
    }

    public function testFemale()
    {
        $petrovich = new Inflection(inflection\Loader::load(inflection\Loader::getVendorRulesFilePath()));

        $names = [
            'Сергеевна' => [
                inflection\Ruleset::CASE_NOMENATIVE    => 'Сергеевна',
                inflection\Ruleset::CASE_GENITIVE      => 'Сергеевны',
                inflection\Ruleset::CASE_DATIVE        => 'Сергеевне',
                inflection\Ruleset::CASE_ACCUSATIVE    => 'Сергеевну',
                inflection\Ruleset::CASE_INSTRUMENTAL  => 'Сергеевной',
                inflection\Ruleset::CASE_PREPOSITIONAL => 'Сергеевне',
            ],
        ];

        foreach ($names as $input => $name) {
            foreach (inflection\Ruleset::getAvailableCases() as $case) {
                static::assertSame(
                    $name[$case],
                    $petrovich->inflectMiddleName($input, $case, inflection\Ruleset::GENDER_FEMALE),
                    'Invalid casing of "' . $input . '" for "' . $case . '" case, expecting "' . $name[$case] . '"'
                );
            }
        }
    }

    public function testAndrogynous()
    {
        $petrovich = new Inflection(inflection\Loader::load(inflection\Loader::getVendorRulesFilePath()));

        $names = [
            'Борух' => [
                inflection\Ruleset::CASE_NOMENATIVE    => 'Борух',
                inflection\Ruleset::CASE_GENITIVE      => 'Борух',
                inflection\Ruleset::CASE_DATIVE        => 'Борух',
                inflection\Ruleset::CASE_ACCUSATIVE    => 'Борух',
                inflection\Ruleset::CASE_INSTRUMENTAL  => 'Борух',
                inflection\Ruleset::CASE_PREPOSITIONAL => 'Борух',
            ],
        ];

        foreach ($names as $input => $name) {
            foreach (inflection\Ruleset::getAvailableCases() as $case) {
                static::assertSame(
                    $name[$case],
                    $petrovich->inflectMiddleName($input, $case, inflection\Ruleset::GENDER_ANDROGYNOUS),
                    'Invalid casing of "' . $input . '" for "' . $case . '" case, expecting "' . $name[$case] . '"'
                );
            }
        }
    }

    public function testShouldCallDetectGenderOnlyIfNotProvided()
    {
        $petrovich = new Inflection(inflection\Loader::load(inflection\Loader::getVendorRulesFilePath()));

        $names = [
            'Сергеевич' => [
                inflection\Ruleset::CASE_NOMENATIVE    => 'Сергеевич',
                inflection\Ruleset::CASE_GENITIVE      => 'Сергеевич',
                inflection\Ruleset::CASE_DATIVE        => 'Сергеевич',
                inflection\Ruleset::CASE_ACCUSATIVE    => 'Сергеевич',
                inflection\Ruleset::CASE_INSTRUMENTAL  => 'Сергеевич',
                inflection\Ruleset::CASE_PREPOSITIONAL => 'Сергеевич',
            ],
            'Сергеевна' => [
                inflection\Ruleset::CASE_NOMENATIVE    => 'Сергеевна',
                inflection\Ruleset::CASE_GENITIVE      => 'Сергеевны',
                inflection\Ruleset::CASE_DATIVE        => 'Сергеевне',
                inflection\Ruleset::CASE_ACCUSATIVE    => 'Сергеевну',
                inflection\Ruleset::CASE_INSTRUMENTAL  => 'Сергеевной',
                inflection\Ruleset::CASE_PREPOSITIONAL => 'Сергеевне',
            ],
        ];

        foreach ($names as $input => $name) {
            foreach (inflection\Ruleset::getAvailableCases() as $case) {
                static::assertSame(
                    $name[$case],
                    $petrovich->inflectMiddleName($input, $case, inflection\Ruleset::GENDER_FEMALE),
                    'Invalid casing of "' . $input . '" for "' . $case . '" case, expecting "' . $name[$case] . '"'
                );
            }
        }
    }
}
