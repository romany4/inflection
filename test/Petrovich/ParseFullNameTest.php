<?php

namespace StaticallTest\inflection\inflection;

use PHPUnit\Framework\TestCase;

use romany4\inflection\Inflection;

class ParseFullNameTest extends TestCase
{
    public function testCorrectSplit()
    {
        $dataset = [
            'Тестов Тест Тестович' => [
                'lastName'   => 'Тестов',
                'firstName'  => 'Тест',
                'middleName' => 'Тестович',
            ],

            'Testov Test Testovich' => [
                'lastName'   => 'Testov',
                'firstName'  => 'Test',
                'middleName' => 'Testovich',
            ],

            'Гусев-Уткин Евграф Полиэстрович' => [
                'lastName'   => 'Гусев-Уткин',
                'firstName'  => 'Евграф',
                'middleName' => 'Полиэстрович',
            ],
        ];

        foreach ($dataset as $input => $expected) {
            static::assertSame($expected, Inflection::parseFullName($input));
        }
    }

    public function testDoubleName()
    {
        $dataset = [
            'Фамилия Адам - Борислав Отчество' => [
                'lastName'   => 'Фамилия',
                'firstName'  => 'Адам - Борислав',
                'middleName' => 'Отчество',
            ],

            'Фамилия Иосиф-Богдан Отчество' => [
                'lastName'   => 'Фамилия',
                'firstName'  => 'Иосиф-Богдан',
                'middleName' => 'Отчество',
            ],

            'Фамилия Финнеус Уолтер Отчество' => [
                'lastName'   => 'Фамилия',
                'firstName'  => 'Финнеус Уолтер',
                'middleName' => 'Отчество',
            ],

            'Фамилия Иосиф-и-Илья Отчество' => [
                'lastName'   => 'Фамилия',
                'firstName'  => 'Иосиф-и-Илья',
                'middleName' => 'Отчество',
            ],

            'Фамилия Иосиф и Илья Отчество' => [
                'lastName'   => 'Фамилия',
                'firstName'  => 'Иосиф и Илья',
                'middleName' => 'Отчество',
            ],

            'Фамилия Иосиф+Илья Отчество' => [
                'lastName'   => 'Фамилия',
                'firstName'  => 'Иосиф+Илья',
                'middleName' => 'Отчество',
            ],

            'Фамилия Иосиф + Илья Отчество' => [
                'lastName'   => 'Фамилия',
                'firstName'  => 'Иосиф + Илья',
                'middleName' => 'Отчество',
            ],
        ];

        foreach ($dataset as $input => $expected) {
            static::assertSame($expected, Inflection::parseFullName($input));
        }
    }

    public function testTripleNameBecausePeopleAreWeird()
    {
        $dataset = [
            'Фамилия Каспер - Валттери - Евгений Отчество' => [
                'lastName'   => 'Фамилия',
                'firstName'  => 'Каспер - Валттери - Евгений',
                'middleName' => 'Отчество',
            ],

            'Фамилия Каспер-Валттери-Евгений Отчество' => [
                'lastName'   => 'Фамилия',
                'firstName'  => 'Каспер-Валттери-Евгений',
                'middleName' => 'Отчество',
            ],

            'Фамилия Каспер Валттери Евгений Отчество' => [
                'lastName'   => 'Фамилия',
                'firstName'  => 'Каспер Валттери Евгений',
                'middleName' => 'Отчество',
            ],

            'Фамилия Каспер-и-Валттери-и-Евгений Отчество' => [
                'lastName'   => 'Фамилия',
                'firstName'  => 'Каспер-и-Валттери-и-Евгений',
                'middleName' => 'Отчество',
            ],

            'Фамилия Каспер и Валттери и Евгений Отчество' => [
                'lastName'   => 'Фамилия',
                'firstName'  => 'Каспер и Валттери и Евгений',
                'middleName' => 'Отчество',
            ],

            'Фамилия Каспер + Валттери + Евгений Отчество' => [
                'lastName'   => 'Фамилия',
                'firstName'  => 'Каспер + Валттери + Евгений',
                'middleName' => 'Отчество',
            ],

            'Фамилия Каспер+Валттери+Евгений Отчество' => [
                'lastName'   => 'Фамилия',
                'firstName'  => 'Каспер+Валттери+Евгений',
                'middleName' => 'Отчество',
            ],
        ];

        foreach ($dataset as $input => $expected) {
            static::assertSame($expected, Inflection::parseFullName($input));
        }
    }

    public function testNoMiddleName()
    {
        $dataset = [
            'Фамилия Имя' => [
                'lastName'   => 'Фамилия',
                'firstName'  => 'Имя',
                'middleName' => null,
            ],

            'Фамилия-Фамилия2 Имя' => [
                'lastName'   => 'Фамилия-Фамилия2',
                'firstName'  => 'Имя',
                'middleName' => null,
            ],
        ];

        foreach ($dataset as $input => $expected) {
            static::assertSame($expected, Inflection::parseFullName($input));
        }
    }
}
