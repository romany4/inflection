<?php
namespace StaticallTest\inflection\inflection;

use PHPUnit\Framework\TestCase;

use romany4\inflection\Inflection;

class InflectLastNameTest extends TestCase
{
    public function testWithoutLastNameRules()
    {
        $ruleset = inflection\Loader::load(inflection\Loader::getVendorRulesFilePath());

        $rules = $ruleset->getRules();

        unset($rules[inflection\Ruleset::ROOT_KEY_LASTNAME]);

        $ruleset->setRules($rules, false);

        $petrovich = new Inflection($ruleset);

        $name = 'Боровинский';

        $this->expectException(inflection\RuntimeException::class);
        $this->expectExceptionMessage('Missing key "' . inflection\Ruleset::ROOT_KEY_LASTNAME . '" for inflection');

        $petrovich->inflectLastName($name, inflection\Ruleset::CASE_NOMENATIVE, inflection\Ruleset::GENDER_MALE);
    }

    public function testMale()
    {
        $petrovich = new Inflection(inflection\Loader::load(inflection\Loader::getVendorRulesFilePath()));

        $names = [
            'Колесников' => [
                inflection\Ruleset::CASE_NOMENATIVE    => 'Колесников',
                inflection\Ruleset::CASE_GENITIVE      => 'Колесникова',
                inflection\Ruleset::CASE_DATIVE        => 'Колесникову',
                inflection\Ruleset::CASE_ACCUSATIVE    => 'Колесникова',
                inflection\Ruleset::CASE_INSTRUMENTAL  => 'Колесниковым',
                inflection\Ruleset::CASE_PREPOSITIONAL => 'Колесникове',
            ],

            'Шульц' => [
                inflection\Ruleset::CASE_NOMENATIVE    => 'Шульц',
                inflection\Ruleset::CASE_GENITIVE      => 'Шульца',
                inflection\Ruleset::CASE_DATIVE        => 'Шульцу',
                inflection\Ruleset::CASE_ACCUSATIVE    => 'Шульца',
                inflection\Ruleset::CASE_INSTRUMENTAL  => 'Шульцем',
                inflection\Ruleset::CASE_PREPOSITIONAL => 'Шульце',
            ],

            'Болл' => [
                inflection\Ruleset::CASE_NOMENATIVE    => 'Болл',
                inflection\Ruleset::CASE_GENITIVE      => 'Болла',
                inflection\Ruleset::CASE_DATIVE        => 'Боллу',
                inflection\Ruleset::CASE_ACCUSATIVE    => 'Болла',
                inflection\Ruleset::CASE_INSTRUMENTAL  => 'Боллом',
                inflection\Ruleset::CASE_PREPOSITIONAL => 'Болле',
            ],

            'Белоконь' => [
                inflection\Ruleset::CASE_NOMENATIVE    => 'Белоконь',
                inflection\Ruleset::CASE_GENITIVE      => 'Белоконя',
                inflection\Ruleset::CASE_DATIVE        => 'Белоконю',
                inflection\Ruleset::CASE_ACCUSATIVE    => 'Белоконя',
                inflection\Ruleset::CASE_INSTRUMENTAL  => 'Белоконем',
                inflection\Ruleset::CASE_PREPOSITIONAL => 'Белоконе',
            ],
        ];

        foreach ($names as $input => $name) {
            foreach (inflection\Ruleset::getAvailableCases() as $case) {
                static::assertSame(
                    $name[$case],
                    $petrovich->inflectLastName($input, $case, inflection\Ruleset::GENDER_MALE),
                    'Invalid casing of "' . $input . '" for "' . $case . '" case, expecting "' . $name[$case] . '"'
                );
            }
        }
    }

    public function testFemale()
    {
        $petrovich = new Inflection(inflection\Loader::load(inflection\Loader::getVendorRulesFilePath()));

        $names = [
            'Колесникова' => [
                inflection\Ruleset::CASE_NOMENATIVE    => 'Колесникова',
                inflection\Ruleset::CASE_GENITIVE      => 'Колесниковой',
                inflection\Ruleset::CASE_DATIVE        => 'Колесниковой',
                inflection\Ruleset::CASE_ACCUSATIVE    => 'Колесникову',
                inflection\Ruleset::CASE_INSTRUMENTAL  => 'Колесниковой',
                inflection\Ruleset::CASE_PREPOSITIONAL => 'Колесниковой',
            ],
        ];

        foreach ($names as $input => $name) {
            foreach (inflection\Ruleset::getAvailableCases() as $case) {
                static::assertSame(
                    $name[$case],
                    $petrovich->inflectLastName($input, $case, inflection\Ruleset::GENDER_FEMALE),
                    'Invalid casing of "' . $input . '" for "' . $case . '" case, expecting "' . $name[$case] . '"'
                );
            }
        }
    }

    public function testAndrogynous()
    {
        $petrovich = new Inflection(inflection\Loader::load(inflection\Loader::getVendorRulesFilePath()));

        $names = [
            'Фидря' => [
                inflection\Ruleset::CASE_NOMENATIVE    => 'Фидря',
                inflection\Ruleset::CASE_GENITIVE      => 'Фидри',
                inflection\Ruleset::CASE_DATIVE        => 'Фидре',
                inflection\Ruleset::CASE_ACCUSATIVE    => 'Фидрю',
                inflection\Ruleset::CASE_INSTRUMENTAL  => 'Фидрей',
                inflection\Ruleset::CASE_PREPOSITIONAL => 'Фидре',
            ],
        ];

        foreach ($names as $input => $name) {
            foreach (inflection\Ruleset::getAvailableCases() as $case) {
                static::assertSame(
                    $name[$case],
                    $petrovich->inflectLastName($input, $case, inflection\Ruleset::GENDER_ANDROGYNOUS),
                    'Invalid casing of "' . $input . '" for "' . $case . '" case, expecting "' . $name[$case] . '"'
                );
            }
        }
    }
}
