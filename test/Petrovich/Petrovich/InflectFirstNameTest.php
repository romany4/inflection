<?php
namespace StaticallTest\inflection\inflection;

use PHPUnit\Framework\TestCase;

use romany4\inflection\Inflection;

class InflectFirstNameTest extends TestCase
{
    public function testWithoutFirstNameRules()
    {
        $ruleset = inflection\Loader::load(inflection\Loader::getVendorRulesFilePath());

        $rules = $ruleset->getRules();

        unset($rules[inflection\Ruleset::ROOT_KEY_FIRSTNAME]);

        $ruleset->setRules($rules, false);

        $petrovich = new Inflection($ruleset);

        $name = 'Павел';

        $this->expectException(inflection\RuntimeException::class);
        $this->expectExceptionMessage('Missing key "' . inflection\Ruleset::ROOT_KEY_FIRSTNAME . '" for inflection');

        $petrovich->inflectFirstName($name, inflection\Ruleset::CASE_NOMENATIVE, inflection\Ruleset::GENDER_MALE);
    }

    public function testMale()
    {
        $petrovich = new Inflection(inflection\Loader::load(inflection\Loader::getVendorRulesFilePath()));

        $names = [
            'Алексей' => [
                inflection\Ruleset::CASE_NOMENATIVE    => 'Алексей',
                inflection\Ruleset::CASE_GENITIVE      => 'Алексея',
                inflection\Ruleset::CASE_DATIVE        => 'Алексею',
                inflection\Ruleset::CASE_ACCUSATIVE    => 'Алексея',
                inflection\Ruleset::CASE_INSTRUMENTAL  => 'Алексеем',
                inflection\Ruleset::CASE_PREPOSITIONAL => 'Алексее',
            ],

            'Михаил' => [
                inflection\Ruleset::CASE_NOMENATIVE    => 'Михаил',
                inflection\Ruleset::CASE_GENITIVE      => 'Михаила',
                inflection\Ruleset::CASE_DATIVE        => 'Михаилу',
                inflection\Ruleset::CASE_ACCUSATIVE    => 'Михаила',
                inflection\Ruleset::CASE_INSTRUMENTAL  => 'Михаилом',
                inflection\Ruleset::CASE_PREPOSITIONAL => 'Михаиле',
            ],

            'Александр' => [
                inflection\Ruleset::CASE_NOMENATIVE    => 'Александр',
                inflection\Ruleset::CASE_GENITIVE      => 'Александра',
                inflection\Ruleset::CASE_DATIVE        => 'Александру',
                inflection\Ruleset::CASE_ACCUSATIVE    => 'Александра',
                inflection\Ruleset::CASE_INSTRUMENTAL  => 'Александром',
                inflection\Ruleset::CASE_PREPOSITIONAL => 'Александре',
            ],

            'Валентин' => [
                inflection\Ruleset::CASE_NOMENATIVE    => 'Валентин',
                inflection\Ruleset::CASE_GENITIVE      => 'Валентина',
                inflection\Ruleset::CASE_DATIVE        => 'Валентину',
                inflection\Ruleset::CASE_ACCUSATIVE    => 'Валентина',
                inflection\Ruleset::CASE_INSTRUMENTAL  => 'Валентином',
                inflection\Ruleset::CASE_PREPOSITIONAL => 'Валентине',
            ],

            'Олесь' => [
                inflection\Ruleset::CASE_NOMENATIVE    => 'Олесь',
                inflection\Ruleset::CASE_GENITIVE      => 'Олеся',
                inflection\Ruleset::CASE_DATIVE        => 'Олесю',
                inflection\Ruleset::CASE_ACCUSATIVE    => 'Олеся',
                inflection\Ruleset::CASE_INSTRUMENTAL  => 'Олесем',
                inflection\Ruleset::CASE_PREPOSITIONAL => 'Олесе',
            ],

            // Weird, "Никита" have issues
            /*'Никита' => [
                inflection\ruleset::CASE_NOMENATIVE    => 'Никита',
                inflection\ruleset::CASE_GENITIVE      => 'Никиты',
                inflection\ruleset::CASE_DATIVE        => 'Никите',
                inflection\ruleset::CASE_ACCUSATIVE    => 'Никиту',
                inflection\ruleset::CASE_INSTRUMENTAL  => 'Никитой',
                inflection\ruleset::CASE_PREPOSITIONAL => 'Никите',
            ],*/

            'Илья' => [
                inflection\Ruleset::CASE_NOMENATIVE    => 'Илья',
                inflection\Ruleset::CASE_GENITIVE      => 'Ильи',
                inflection\Ruleset::CASE_DATIVE        => 'Илье',
                inflection\Ruleset::CASE_ACCUSATIVE    => 'Илью',
                inflection\Ruleset::CASE_INSTRUMENTAL  => 'Ильёй',
                inflection\Ruleset::CASE_PREPOSITIONAL => 'Илье',
            ],

            'Ромео' => [
                inflection\Ruleset::CASE_NOMENATIVE    => 'Ромео',
                inflection\Ruleset::CASE_GENITIVE      => 'Ромео',
                inflection\Ruleset::CASE_DATIVE        => 'Ромео',
                inflection\Ruleset::CASE_ACCUSATIVE    => 'Ромео',
                inflection\Ruleset::CASE_INSTRUMENTAL  => 'Ромео',
                inflection\Ruleset::CASE_PREPOSITIONAL => 'Ромео',
            ],

            'Алим-Паша' => [
                inflection\Ruleset::CASE_NOMENATIVE    => 'Алим-Паша',
                inflection\Ruleset::CASE_GENITIVE      => 'Алима-Паши',
                inflection\Ruleset::CASE_DATIVE        => 'Алиму-Паше',
                inflection\Ruleset::CASE_ACCUSATIVE    => 'Алима-Пашу',
                inflection\Ruleset::CASE_INSTRUMENTAL  => 'Алимом-Пашей',
                inflection\Ruleset::CASE_PREPOSITIONAL => 'Алиме-Паше',
            ],

            'Даша' => [ // Yes, some people are weird
                inflection\Ruleset::CASE_NOMENATIVE    => 'Даша',
                inflection\Ruleset::CASE_GENITIVE      => 'Даши',
                inflection\Ruleset::CASE_DATIVE        => 'Даше',
                inflection\Ruleset::CASE_ACCUSATIVE    => 'Дашу',
                inflection\Ruleset::CASE_INSTRUMENTAL  => 'Дашей',
                inflection\Ruleset::CASE_PREPOSITIONAL => 'Даше',
            ],

            'Феликс' => [
                inflection\Ruleset::CASE_NOMENATIVE    => 'Феликс',
                inflection\Ruleset::CASE_GENITIVE      => 'Феликса',
                inflection\Ruleset::CASE_DATIVE        => 'Феликсу',
                inflection\Ruleset::CASE_ACCUSATIVE    => 'Феликса',
                inflection\Ruleset::CASE_INSTRUMENTAL  => 'Феликсом',
                inflection\Ruleset::CASE_PREPOSITIONAL => 'Феликсе',
            ],

            'Гюнтер' => [
                inflection\Ruleset::CASE_NOMENATIVE    => 'Гюнтер',
                inflection\Ruleset::CASE_GENITIVE      => 'Гюнтера',
                inflection\Ruleset::CASE_DATIVE        => 'Гюнтеру',
                inflection\Ruleset::CASE_ACCUSATIVE    => 'Гюнтера',
                inflection\Ruleset::CASE_INSTRUMENTAL  => 'Гюнтером',
                inflection\Ruleset::CASE_PREPOSITIONAL => 'Гюнтере',
            ],

            'Уве' => [
                inflection\Ruleset::CASE_NOMENATIVE    => 'Уве',
                inflection\Ruleset::CASE_GENITIVE      => 'Уве',
                inflection\Ruleset::CASE_DATIVE        => 'Уве',
                inflection\Ruleset::CASE_ACCUSATIVE    => 'Уве',
                inflection\Ruleset::CASE_INSTRUMENTAL  => 'Уве',
                inflection\Ruleset::CASE_PREPOSITIONAL => 'Уве',
            ],

            'Лоренц' => [
                inflection\Ruleset::CASE_NOMENATIVE    => 'Лоренц',
                inflection\Ruleset::CASE_GENITIVE      => 'Лоренца',
                inflection\Ruleset::CASE_DATIVE        => 'Лоренцу',
                inflection\Ruleset::CASE_ACCUSATIVE    => 'Лоренца',
                inflection\Ruleset::CASE_INSTRUMENTAL  => 'Лоренцом',
                inflection\Ruleset::CASE_PREPOSITIONAL => 'Лоренце',
            ],

            'Лев' => [
                inflection\Ruleset::CASE_NOMENATIVE    => 'Лев',
                inflection\Ruleset::CASE_GENITIVE      => 'Льва',
                inflection\Ruleset::CASE_DATIVE        => 'Льву',
                inflection\Ruleset::CASE_ACCUSATIVE    => 'Льва',
                inflection\Ruleset::CASE_INSTRUMENTAL  => 'Львом',
                inflection\Ruleset::CASE_PREPOSITIONAL => 'Льве',
            ],

            'Пётр' => [
                inflection\Ruleset::CASE_NOMENATIVE    => 'Пётр',
                inflection\Ruleset::CASE_GENITIVE      => 'Петра',
                inflection\Ruleset::CASE_DATIVE        => 'Петру',
                inflection\Ruleset::CASE_ACCUSATIVE    => 'Петра',
                inflection\Ruleset::CASE_INSTRUMENTAL  => 'Петром',
                inflection\Ruleset::CASE_PREPOSITIONAL => 'Петре',
            ],

            'Павел' => [
                inflection\Ruleset::CASE_NOMENATIVE    => 'Павел',
                inflection\Ruleset::CASE_GENITIVE      => 'Павла',
                inflection\Ruleset::CASE_DATIVE        => 'Павлу',
                inflection\Ruleset::CASE_ACCUSATIVE    => 'Павла',
                inflection\Ruleset::CASE_INSTRUMENTAL  => 'Павлом',
                inflection\Ruleset::CASE_PREPOSITIONAL => 'Павле',
            ],

            'Яша' => [
                inflection\Ruleset::CASE_NOMENATIVE    => 'Яша',
                inflection\Ruleset::CASE_GENITIVE      => 'Яши',
                inflection\Ruleset::CASE_DATIVE        => 'Яше',
                inflection\Ruleset::CASE_ACCUSATIVE    => 'Яшу',
                inflection\Ruleset::CASE_INSTRUMENTAL  => 'Яшей',
                inflection\Ruleset::CASE_PREPOSITIONAL => 'Яше',
            ],

            'Шота' => [
                inflection\Ruleset::CASE_NOMENATIVE    => 'Шота',
                inflection\Ruleset::CASE_GENITIVE      => 'Шота',
                inflection\Ruleset::CASE_DATIVE        => 'Шота',
                inflection\Ruleset::CASE_ACCUSATIVE    => 'Шота',
                inflection\Ruleset::CASE_INSTRUMENTAL  => 'Шота',
                inflection\Ruleset::CASE_PREPOSITIONAL => 'Шота',
            ],
        ];

        foreach ($names as $input => $name) {
            foreach (inflection\Ruleset::getAvailableCases() as $case) {
                static::assertSame(
                    $name[$case],
                    $petrovich->inflectFirstName($input, $case, inflection\Ruleset::GENDER_MALE),
                    'Invalid casing of "' . $input . '" for "' . $case . '" case, expecting "' . $name[$case] . '"'
                );
            }
        }
    }

    public function testFemale()
    {
        $petrovich = new Inflection(inflection\Loader::load(inflection\Loader::getVendorRulesFilePath()));

        $names = [
            'Марина' => [
                inflection\Ruleset::CASE_NOMENATIVE    => 'Марина',
                inflection\Ruleset::CASE_GENITIVE      => 'Марины',
                inflection\Ruleset::CASE_DATIVE        => 'Марине',
                inflection\Ruleset::CASE_ACCUSATIVE    => 'Марину',
                inflection\Ruleset::CASE_INSTRUMENTAL  => 'Мариной',
                inflection\Ruleset::CASE_PREPOSITIONAL => 'Марине',
            ],

            'Ирен' => [
                inflection\Ruleset::CASE_NOMENATIVE    => 'Ирен',
                inflection\Ruleset::CASE_GENITIVE      => 'Ирен',
                inflection\Ruleset::CASE_DATIVE        => 'Ирен',
                inflection\Ruleset::CASE_ACCUSATIVE    => 'Ирен',
                inflection\Ruleset::CASE_INSTRUMENTAL  => 'Ирен',
                inflection\Ruleset::CASE_PREPOSITIONAL => 'Ирен',
            ],

            'Катрин' => [
                inflection\Ruleset::CASE_NOMENATIVE    => 'Катрин',
                inflection\Ruleset::CASE_GENITIVE      => 'Катрин',
                inflection\Ruleset::CASE_DATIVE        => 'Катрин',
                inflection\Ruleset::CASE_ACCUSATIVE    => 'Катрин',
                inflection\Ruleset::CASE_INSTRUMENTAL  => 'Катрин',
                inflection\Ruleset::CASE_PREPOSITIONAL => 'Катрин',
            ],

            'Зульфия' => [
                inflection\Ruleset::CASE_NOMENATIVE    => 'Зульфия',
                inflection\Ruleset::CASE_GENITIVE      => 'Зульфии',
                inflection\Ruleset::CASE_DATIVE        => 'Зульфии',
                inflection\Ruleset::CASE_ACCUSATIVE    => 'Зульфию',
                inflection\Ruleset::CASE_INSTRUMENTAL  => 'Зульфией',
                inflection\Ruleset::CASE_PREPOSITIONAL => 'Зульфии',
            ],

            'Мария' => [
                inflection\Ruleset::CASE_NOMENATIVE    => 'Мария',
                inflection\Ruleset::CASE_GENITIVE      => 'Марии',
                inflection\Ruleset::CASE_DATIVE        => 'Марии',
                inflection\Ruleset::CASE_ACCUSATIVE    => 'Марию',
                inflection\Ruleset::CASE_INSTRUMENTAL  => 'Марией',
                inflection\Ruleset::CASE_PREPOSITIONAL => 'Марии',
            ],

            'Марьям' => [
                inflection\Ruleset::CASE_NOMENATIVE    => 'Марьям',
                inflection\Ruleset::CASE_GENITIVE      => 'Марьям',
                inflection\Ruleset::CASE_DATIVE        => 'Марьям',
                inflection\Ruleset::CASE_ACCUSATIVE    => 'Марьям',
                inflection\Ruleset::CASE_INSTRUMENTAL  => 'Марьям',
                inflection\Ruleset::CASE_PREPOSITIONAL => 'Марьям',
            ],

            'Элизабет' => [
                inflection\Ruleset::CASE_NOMENATIVE    => 'Элизабет',
                inflection\Ruleset::CASE_GENITIVE      => 'Элизабет',
                inflection\Ruleset::CASE_DATIVE        => 'Элизабет',
                inflection\Ruleset::CASE_ACCUSATIVE    => 'Элизабет',
                inflection\Ruleset::CASE_INSTRUMENTAL  => 'Элизабет',
                inflection\Ruleset::CASE_PREPOSITIONAL => 'Элизабет',
            ],

            'Даша' => [
                inflection\Ruleset::CASE_NOMENATIVE    => 'Даша',
                inflection\Ruleset::CASE_GENITIVE      => 'Даши',
                inflection\Ruleset::CASE_DATIVE        => 'Даше',
                inflection\Ruleset::CASE_ACCUSATIVE    => 'Дашу',
                inflection\Ruleset::CASE_INSTRUMENTAL  => 'Дашей',
                inflection\Ruleset::CASE_PREPOSITIONAL => 'Даше',
            ],

            'Стефани' => [
                inflection\Ruleset::CASE_NOMENATIVE    => 'Стефани',
                inflection\Ruleset::CASE_GENITIVE      => 'Стефани',
                inflection\Ruleset::CASE_DATIVE        => 'Стефани',
                inflection\Ruleset::CASE_ACCUSATIVE    => 'Стефани',
                inflection\Ruleset::CASE_INSTRUMENTAL  => 'Стефани',
                inflection\Ruleset::CASE_PREPOSITIONAL => 'Стефани',
            ],

            'Любовь' => [
                inflection\Ruleset::CASE_NOMENATIVE    => 'Любовь',
                inflection\Ruleset::CASE_GENITIVE      => 'Любови',
                inflection\Ruleset::CASE_DATIVE        => 'Любови',
                inflection\Ruleset::CASE_ACCUSATIVE    => 'Любовь',
                inflection\Ruleset::CASE_INSTRUMENTAL  => 'Любовью',
                inflection\Ruleset::CASE_PREPOSITIONAL => 'Любови',
            ],
        ];

        foreach ($names as $input => $name) {
            foreach (inflection\Ruleset::getAvailableCases() as $case) {
                static::assertSame(
                    $name[$case],
                    $petrovich->inflectFirstName($input, $case, inflection\Ruleset::GENDER_FEMALE),
                    'Invalid casing of "' . $input . '" for "' . $case . '" case, expecting "' . $name[$case] . '"'
                );
            }
        }
    }

    public function testAndrogynous()
    {
        $petrovich = new Inflection(inflection\Loader::load(inflection\Loader::getVendorRulesFilePath()));

        $names = [
            'Луи' => [
                inflection\Ruleset::CASE_NOMENATIVE    => 'Луи',
                inflection\Ruleset::CASE_GENITIVE      => 'Луи',
                inflection\Ruleset::CASE_DATIVE        => 'Луи',
                inflection\Ruleset::CASE_ACCUSATIVE    => 'Луи',
                inflection\Ruleset::CASE_INSTRUMENTAL  => 'Луи',
                inflection\Ruleset::CASE_PREPOSITIONAL => 'Луи',
            ],
        ];

        foreach ($names as $input => $name) {
            foreach (inflection\Ruleset::getAvailableCases() as $case) {
                static::assertSame(
                    $name[$case],
                    $petrovich->inflectFirstName($input, $case, inflection\Ruleset::GENDER_ANDROGYNOUS),
                    'Invalid casing of "' . $input . '" for "' . $case . '" case, expecting "' . $name[$case] . '"'
                );
            }
        }
    }
}
