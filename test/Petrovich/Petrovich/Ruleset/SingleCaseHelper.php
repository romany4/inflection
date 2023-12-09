<?php
namespace StaticallTest\inflection\inflection\ruleset;

use PHPUnit\Framework\TestCase;

use romany4\inflection\inflection\Ruleset;

class SingleCaseHelper extends TestCase
{
    public function getMods(array $overwrite = [])
    {
        $default = [
            '--ьва',
            '--ьву',
            '--ъва',
            '--ьвом',
            '--ьве',
        ];

        return $default + $overwrite;
    }

    public function runTestNoExceptionsNoSuffixes(
        string $input,
        string $expected,
        int $case,
        string $gender
    )
    {
        $ruleset = new Ruleset([], false);

        static::assertSame(
            $expected,

            $ruleset->inflect(
                $input,
                $case,
                $gender,

                [
                ]
            )
        );
    }

    public function runTestHasExceptionsGenderWrong1NoSuffixes(
        string $input,
        string $expected,
        int $case,
        string $gender,
        array $additionalMods = []
    )
    {
        $ruleset = new Ruleset([], false);

        $genders = [];

        foreach (Ruleset::getAvailableGenders() as $availableGender) {
            if ($availableGender === $gender) {
                continue;
            }

            $genders[] = $availableGender;
        }

        $testableGender = array_shift($genders);

        static::assertSame(
            $expected,

            $ruleset->inflect(
                $input,
                $case,
                $gender,

                [
                    Ruleset::SECOND_KEY_EXCEPTIONS => [
                        [
                            Ruleset::VALUE_KEY_GENDER => $testableGender,
                            Ruleset::VALUE_KEY_TEST   => [mb_strtolower($input)],
                            Ruleset::VALUE_KEY_MODS   => $this->getMods($additionalMods),
                        ],
                    ],
                ]
            )
        );
    }

    public function runTestHasExceptionsGenderWrong2NoSuffixes(
        string $input,
        string $expected,
        int $case,
        string $gender,
        array $additionalMods = []
    )
    {
        $ruleset = new Ruleset([], false);

        $genders = [];

        foreach (Ruleset::getAvailableGenders() as $availableGender) {
            if ($availableGender === $gender) {
                continue;
            }

            $genders[] = $availableGender;
        }

        $testableGender = array_pop($genders);

        static::assertSame(
            $expected,

            $ruleset->inflect(
                $input,
                $case,
                $gender,

                [
                    Ruleset::SECOND_KEY_EXCEPTIONS => [
                        [
                            Ruleset::VALUE_KEY_GENDER => $testableGender,
                            Ruleset::VALUE_KEY_TEST   => [mb_strtolower($input)],
                            Ruleset::VALUE_KEY_MODS   => $this->getMods($additionalMods),
                        ],
                    ],
                ]
            )
        );
    }

    public function runTestHasExceptionsCorrectGenderNoSuffixes(
        string $input,
        string $expected,
        int $case,
        string $gender,
        array $additionalMods = []
    )
    {
        $ruleset = new Ruleset([], false);

        static::assertSame(
            $expected,

            $ruleset->inflect(
                $input,
                $case,
                $gender,

                [
                    Ruleset::SECOND_KEY_EXCEPTIONS => [
                        [
                            Ruleset::VALUE_KEY_GENDER => $gender,
                            Ruleset::VALUE_KEY_TEST   => [mb_strtolower($input)],
                            Ruleset::VALUE_KEY_MODS   => $this->getMods($additionalMods),
                        ],
                    ],
                ]
            )
        );
    }

    public function runTestHasExceptionsCorrectGenderAfterIncorrectNoSuffixes(
        string $input,
        string $expected,
        int $case,
        string $gender,
        array $additionalMods = []
    )
    {
        $ruleset = new Ruleset([], false);

        $exceptions = [];

        foreach (Ruleset::getAvailableGenders() as $i => $availableGender) {
            if ($availableGender === $gender) {
                continue;
            }

            $exceptions[] = [
                Ruleset::VALUE_KEY_GENDER => $availableGender,
                Ruleset::VALUE_KEY_TEST   => [mb_strtolower($input)],
                Ruleset::VALUE_KEY_MODS   => ['--ьва' . $i, '--ьву' . $i, '--ьва' . $i, '--ьвом' . $i, '--ьве' . $i],
            ];
        }

        $exceptions[] = [
            Ruleset::VALUE_KEY_GENDER => $gender,
            Ruleset::VALUE_KEY_TEST   => [mb_strtolower($input)],
            Ruleset::VALUE_KEY_MODS   => $this->getMods($additionalMods),
        ];

        static::assertSame(
            $expected,

            $ruleset->inflect(
                $input,
                $case,
                $gender,

                [
                    Ruleset::SECOND_KEY_EXCEPTIONS => $exceptions,
                ]
            )
        );
    }

    public function runTestHasExceptionsAndSuffixes(
        string $input,
        string $expected,
        int $case,
        string $gender,
        array $additionalMods = []
    )
    {
        $ruleset = new Ruleset([], false);

        static::assertSame(
            $expected,

            $ruleset->inflect(
                $input,
                $case,
                $gender,

                [
                    Ruleset::SECOND_KEY_EXCEPTIONS => [
                        [
                            Ruleset::VALUE_KEY_GENDER => $gender,
                            Ruleset::VALUE_KEY_TEST   => [mb_strtolower($input)],
                            Ruleset::VALUE_KEY_MODS   => $this->getMods($additionalMods),
                        ],
                    ],
                    Ruleset::SECOND_KEY_SUFFIXES   => [
                        [
                            Ruleset::VALUE_KEY_GENDER => $gender,
                            Ruleset::VALUE_KEY_TEST   => [mb_strtolower($input)],
                            Ruleset::VALUE_KEY_MODS   => $this->getMods($additionalMods),
                        ],
                    ],
                ]
            )
        );
    }

    public function runTestHasExceptionsAndSuffixesReverseOrder(
        string $input,
        string $expected,
        int $case,
        string $gender,
        array $additionalMods = []
    )
    {
        $ruleset = new Ruleset([], false);

        static::assertSame(
            $expected,

            $ruleset->inflect(
                $input,
                $case,
                $gender,

                [
                    Ruleset::SECOND_KEY_SUFFIXES   => [
                        [
                            Ruleset::VALUE_KEY_GENDER => $gender,
                            Ruleset::VALUE_KEY_TEST   => [mb_strtolower($input)],
                            Ruleset::VALUE_KEY_MODS   => $this->getMods($additionalMods),
                        ],
                    ],
                    Ruleset::SECOND_KEY_EXCEPTIONS => [
                        [
                            Ruleset::VALUE_KEY_GENDER => $gender,
                            Ruleset::VALUE_KEY_TEST   => [mb_strtolower($input)],
                            Ruleset::VALUE_KEY_MODS   => $this->getMods($additionalMods),
                        ],
                    ],
                ]
            )
        );
    }

    public function runTestNoExceptionsHasSuffixes(
        string $input,
        string $expected,
        int $case,
        string $gender,
        array $additionalMods = []
    )
    {
        $ruleset = new Ruleset([], false);

        static::assertSame(
            $expected,

            $ruleset->inflect(
                $input,
                $case,
                $gender,

                [
                    Ruleset::SECOND_KEY_SUFFIXES => [
                        [
                            Ruleset::VALUE_KEY_GENDER => $gender,
                            Ruleset::VALUE_KEY_TEST   => [mb_strtolower($input)],
                            Ruleset::VALUE_KEY_MODS   => $this->getMods($additionalMods),
                        ],
                    ],
                ],

                true
            )
        );
    }

    public function runTestNoExceptionsHasSuffixesDotMod(
        string $input,
        string $expected,
        int $case,
        string $gender
    )
    {
        $ruleset = new Ruleset([], false);

        static::assertSame(
            $expected,

            $ruleset->inflect(
                $input,
                $case,
                $gender,

                [
                    Ruleset::SECOND_KEY_SUFFIXES => [
                        [
                            Ruleset::VALUE_KEY_GENDER => $gender,
                            Ruleset::VALUE_KEY_TEST   => [mb_strtolower($input)],
                            Ruleset::VALUE_KEY_MODS   => [
                                Ruleset::MOD_INITIAL,
                                Ruleset::MOD_INITIAL,
                                Ruleset::MOD_INITIAL,
                                Ruleset::MOD_INITIAL,
                                Ruleset::MOD_INITIAL,
                            ],
                        ],
                    ],
                ]
            )
        );
    }

    public function runTestIncorrectInputShouldReturnInput(
        string $input,
        string $ruleInput,
        string $expected,
        int $case,
        string $gender
    )
    {
        $ruleset = new Ruleset([], false);

        static::assertSame(
            $expected,

            $ruleset->inflect(
                $input,
                $case,
                $gender,

                [
                    Ruleset::SECOND_KEY_SUFFIXES => [
                        [
                            Ruleset::VALUE_KEY_GENDER => $gender,
                            Ruleset::VALUE_KEY_TEST   => [mb_strtolower($ruleInput)],
                            Ruleset::VALUE_KEY_MODS   => [
                                Ruleset::MOD_INITIAL,
                                Ruleset::MOD_INITIAL,
                                Ruleset::MOD_INITIAL,
                                Ruleset::MOD_INITIAL,
                                Ruleset::MOD_INITIAL,
                            ],
                        ],
                    ],
                ]
            )
        );
    }
}
