<?php
namespace StaticallTest\inflection\inflection\ruleset\SingleCase;

use StaticallTest\inflection\inflection\ruleset\SingleCaseHelper;

use romany4\inflection\inflection\Ruleset;

class InstrumentalFemaleTest extends SingleCaseHelper
{
    const THIS_CASE   = Ruleset::CASE_INSTRUMENTAL;
    const THIS_GENDER = Ruleset::GENDER_FEMALE;

    public function testNoExceptionsNoSuffixes()
    {
        $this->runTestNoExceptionsNoSuffixes(
            'Тест',
            'Тест',
            static::THIS_CASE,
            static::THIS_GENDER
        );
    }

    public function testHasExceptionsGenderWrong1NoSuffixes()
    {
        $this->runTestHasExceptionsGenderWrong1NoSuffixes(
            'Тест',
            'Тест',
            static::THIS_CASE,
            static::THIS_GENDER
        );
    }

    public function testHasExceptionsGenderWrong2NoSuffixes()
    {
        $this->runTestHasExceptionsGenderWrong2NoSuffixes(
            'Тест',
            'Тест',
            static::THIS_CASE,
            static::THIS_GENDER
        );
    }

    public function testHasExceptionsCorrectGenderNoSuffixes()
    {
        $this->runTestHasExceptionsCorrectGenderNoSuffixes(
            'Тест',
            'Теьвом',
            static::THIS_CASE,
            static::THIS_GENDER
        );
    }

    public function testHasExceptionsCorrectGenderAfterIncorrectNoSuffixes()
    {
        $this->runTestHasExceptionsCorrectGenderAfterIncorrectNoSuffixes(
            'Тест',
            'Теьвом',
            static::THIS_CASE,
            static::THIS_GENDER
        );
    }

    public function testHasExceptionsAndSuffixes()
    {
        $this->runTestHasExceptionsAndSuffixes(
            'Тест',
            'Теьвом',
            static::THIS_CASE,
            static::THIS_GENDER
        );
    }

    public function testHasExceptionsAndSuffixesReverseOrder()
    {
        $this->runTestHasExceptionsAndSuffixesReverseOrder(
            'Тест',
            'Теьвом',
            static::THIS_CASE,
            static::THIS_GENDER
        );
    }

    public function testNoExceptionsHasSuffixes()
    {
        $this->runTestNoExceptionsHasSuffixes(
            'Тест',
            'Теьвом',
            static::THIS_CASE,
            static::THIS_GENDER
        );
    }

    public function testNoExceptionsHasSuffixesDotMod()
    {
        $this->runTestNoExceptionsHasSuffixesDotMod(
            'Тест',
            'Тест',
            static::THIS_CASE,
            static::THIS_GENDER
        );
    }

    public function testIncorrectInputShouldReturnInput()
    {
        $this->runTestIncorrectInputShouldReturnInput(
            'Неизвестно',
            'Тест',
            'Неизвестно',
            static::THIS_CASE,
            static::THIS_GENDER
        );
    }
}
