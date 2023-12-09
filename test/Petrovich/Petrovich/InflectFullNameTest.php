<?php
namespace StaticallTest\inflection\inflection;

use PHPUnit\Framework\TestCase;

use romany4\inflection\Inflection;

class InflectFullNameTest extends TestCase
{
    public function testWithoutMiddleNameRules()
    {
        $ruleset = inflection\Loader::load(inflection\Loader::getVendorRulesFilePath());

        $rules = $ruleset->getRules();

        unset($rules[inflection\Ruleset::ROOT_KEY_MIDDLENAME]);

        $ruleset->setRules($rules, false);

        $petrovich = new Inflection($ruleset);

        $name = 'Барбарисов Сигизмунд Петрович';

        $this->expectException(inflection\RuntimeException::class);
        $this->expectExceptionMessage('Missing key "' . inflection\Ruleset::ROOT_KEY_MIDDLENAME . '" for inflection');

        $petrovich->inflectFullName($name, inflection\Ruleset::CASE_NOMENATIVE, inflection\Ruleset::GENDER_MALE);
    }

    public function testWithoutFirstNameRules()
    {
        $ruleset = inflection\Loader::load(inflection\Loader::getVendorRulesFilePath());

        $rules = $ruleset->getRules();

        unset($rules[inflection\Ruleset::ROOT_KEY_FIRSTNAME]);

        $ruleset->setRules($rules, false);

        $petrovich = new Inflection($ruleset);

        $name = 'Барбарисов Сигизмунд Петрович';

        $this->expectException(inflection\RuntimeException::class);
        $this->expectExceptionMessage('Missing key "' . inflection\Ruleset::ROOT_KEY_FIRSTNAME . '" for inflection');

        $petrovich->inflectFullName($name, inflection\Ruleset::CASE_NOMENATIVE, inflection\Ruleset::GENDER_MALE);
    }

    public function testWithoutLastNameRules()
    {
        $ruleset = inflection\Loader::load(inflection\Loader::getVendorRulesFilePath());

        $rules = $ruleset->getRules();

        unset($rules[inflection\Ruleset::ROOT_KEY_LASTNAME]);

        $ruleset->setRules($rules, false);

        $petrovich = new Inflection($ruleset);

        $name = 'Барбарисов Сигизмунд Петрович';

        $this->expectException(inflection\RuntimeException::class);
        $this->expectExceptionMessage('Missing key "' . inflection\Ruleset::ROOT_KEY_LASTNAME . '" for inflection');

        $petrovich->inflectFullName($name, inflection\Ruleset::CASE_NOMENATIVE, inflection\Ruleset::GENDER_MALE);
    }

    public function testMale()
    {
        $petrovich = new Inflection(inflection\Loader::load(inflection\Loader::getVendorRulesFilePath()));

        $names = [
            'Петров Полиграф Афанасьевич' => [
                inflection\Ruleset::CASE_NOMENATIVE    => 'Петров Полиграф Афанасьевич',
                inflection\Ruleset::CASE_GENITIVE      => 'Петрова Полиграфа Афанасьевича',
                inflection\Ruleset::CASE_DATIVE        => 'Петрову Полиграфу Афанасьевичу',
                inflection\Ruleset::CASE_ACCUSATIVE    => 'Петрова Полиграфа Афанасьевича',
                inflection\Ruleset::CASE_INSTRUMENTAL  => 'Петровым Полиграфом Афанасьевичем',
                inflection\Ruleset::CASE_PREPOSITIONAL => 'Петрове Полиграфе Афанасьевиче',
            ],

            'Петров Полиграф' => [
                inflection\Ruleset::CASE_NOMENATIVE    => 'Петров Полиграф',
                inflection\Ruleset::CASE_GENITIVE      => 'Петрова Полиграфа',
                inflection\Ruleset::CASE_DATIVE        => 'Петрову Полиграфу',
                inflection\Ruleset::CASE_ACCUSATIVE    => 'Петрова Полиграфа',
                inflection\Ruleset::CASE_INSTRUMENTAL  => 'Петровым Полиграфом',
                inflection\Ruleset::CASE_PREPOSITIONAL => 'Петрове Полиграфе',
            ],
        ];

        foreach ($names as $input => $name) {
            foreach (inflection\Ruleset::getAvailableCases() as $case) {
                static::assertSame(
                    $name[$case],
                    $petrovich->inflectFullName($input, $case, inflection\Ruleset::GENDER_MALE),
                    'Invalid casing of "' . $input . '" for "' . $case . '" case, expecting "' . $name[$case] . '"'
                );
            }
        }
    }

    public function testFemale()
    {
        $petrovich = new Inflection(inflection\Loader::load(inflection\Loader::getVendorRulesFilePath()));

        $names = [
            'Петрова Анна Юрьевна' => [
                inflection\Ruleset::CASE_NOMENATIVE    => 'Петрова Анна Юрьевна',
                inflection\Ruleset::CASE_GENITIVE      => 'Петровой Анны Юрьевны',
                inflection\Ruleset::CASE_DATIVE        => 'Петровой Анне Юрьевне',
                inflection\Ruleset::CASE_ACCUSATIVE    => 'Петрову Анну Юрьевну',
                inflection\Ruleset::CASE_INSTRUMENTAL  => 'Петровой Анной Юрьевной',
                inflection\Ruleset::CASE_PREPOSITIONAL => 'Петровой Анне Юрьевне',
            ],

            'Петрова Анна' => [
                inflection\Ruleset::CASE_NOMENATIVE    => 'Петрова Анна',
                inflection\Ruleset::CASE_GENITIVE      => 'Петровой Анны',
                inflection\Ruleset::CASE_DATIVE        => 'Петровой Анне',
                inflection\Ruleset::CASE_ACCUSATIVE    => 'Петрову Анну',
                inflection\Ruleset::CASE_INSTRUMENTAL  => 'Петровой Анной',
                inflection\Ruleset::CASE_PREPOSITIONAL => 'Петровой Анне',
            ],
        ];

        foreach ($names as $input => $name) {
            foreach (inflection\Ruleset::getAvailableCases() as $case) {
                static::assertSame(
                    $name[$case],
                    $petrovich->inflectFullName($input, $case, inflection\Ruleset::GENDER_FEMALE),
                    'Invalid casing of "' . $input . '" for "' . $case . '" case, expecting "' . $name[$case] . '"'
                );
            }
        }
    }

    public function testWithDetectGender()
    {
        $petrovich = new Inflection(inflection\Loader::load(inflection\Loader::getVendorRulesFilePath()));

        $names = [
            'Петров Полиграф Афанасьевич' => [
                inflection\Ruleset::CASE_NOMENATIVE    => 'Петров Полиграф Афанасьевич',
                inflection\Ruleset::CASE_GENITIVE      => 'Петрова Полиграфа Афанасьевича',
                inflection\Ruleset::CASE_DATIVE        => 'Петрову Полиграфу Афанасьевичу',
                inflection\Ruleset::CASE_ACCUSATIVE    => 'Петрова Полиграфа Афанасьевича',
                inflection\Ruleset::CASE_INSTRUMENTAL  => 'Петровым Полиграфом Афанасьевичем',
                inflection\Ruleset::CASE_PREPOSITIONAL => 'Петрове Полиграфе Афанасьевиче',
            ],

            'Петрова Анна Юрьевна' => [
                inflection\Ruleset::CASE_NOMENATIVE    => 'Петрова Анна Юрьевна',
                inflection\Ruleset::CASE_GENITIVE      => 'Петровой Анны Юрьевны',
                inflection\Ruleset::CASE_DATIVE        => 'Петровой Анне Юрьевне',
                inflection\Ruleset::CASE_ACCUSATIVE    => 'Петрову Анну Юрьевну',
                inflection\Ruleset::CASE_INSTRUMENTAL  => 'Петровой Анной Юрьевной',
                inflection\Ruleset::CASE_PREPOSITIONAL => 'Петровой Анне Юрьевне',
            ],

            // Cases are weird, because no gender AND no middle name provided, hence it's assumed, that gender = GENDER_ANDROGYNOUS
            'Петров Полиграф' => [
                inflection\Ruleset::CASE_NOMENATIVE    => 'Петров Полиграф',
                inflection\Ruleset::CASE_GENITIVE      => 'Петров Полиграф',
                inflection\Ruleset::CASE_DATIVE        => 'Петров Полиграф',
                inflection\Ruleset::CASE_ACCUSATIVE    => 'Петров Полиграф',
                inflection\Ruleset::CASE_INSTRUMENTAL  => 'Петров Полиграф',
                inflection\Ruleset::CASE_PREPOSITIONAL => 'Петров Полиграф',
            ],

            'Петрова Анна' => [
                inflection\Ruleset::CASE_NOMENATIVE    => 'Петрова Анна',
                inflection\Ruleset::CASE_GENITIVE      => 'Петровы Анны',
                inflection\Ruleset::CASE_DATIVE        => 'Петрове Анне',
                inflection\Ruleset::CASE_ACCUSATIVE    => 'Петрову Анну',
                inflection\Ruleset::CASE_INSTRUMENTAL  => 'Петровой Анной',
                inflection\Ruleset::CASE_PREPOSITIONAL => 'Петрове Анне',
            ],
        ];

        foreach ($names as $input => $name) {
            foreach (inflection\Ruleset::getAvailableCases() as $case) {
                static::assertSame(
                    $name[$case],
                    $petrovich->inflectFullName($input, $case),
                    'Invalid casing of "' . $input . '" for "' . $case . '" case, expecting "' . $name[$case] . '"'
                );
            }
        }
    }
}
