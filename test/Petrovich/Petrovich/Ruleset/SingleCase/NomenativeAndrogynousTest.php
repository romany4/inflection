<?php
namespace StaticallTest\inflection\inflection\ruleset\SingleCase;

use StaticallTest\inflection\inflection\ruleset\SingleCaseHelper;

use romany4\inflection\inflection\Ruleset;

class NomenativeAndrogynousTest extends SingleCaseHelper
{
    const THIS_CASE   = Ruleset::CASE_NOMENATIVE;
    const THIS_GENDER = Ruleset::GENDER_ANDROGYNOUS;

    public function testNoExceptionsNoSuffixes()
    {
        $this->runTestNoExceptionsNoSuffixes('Тест', 'Тест', static::THIS_CASE, static::THIS_GENDER);
    }

    public function testHasExceptionsGenderWrong1NoSuffixes()
    {
        $this->runTestHasExceptionsGenderWrong1NoSuffixes('Тест', 'Тест', static::THIS_CASE, static::THIS_GENDER);
    }

    public function testHasExceptionsGenderWrong2NoSuffixes()
    {
        $this->runTestHasExceptionsGenderWrong2NoSuffixes('Тест', 'Тест', static::THIS_CASE, static::THIS_GENDER);
    }

    public function testHasExceptionsCorrectGenderNoSuffixes()
    {
        $this->runTestHasExceptionsCorrectGenderNoSuffixes('Тест', 'Тест', static::THIS_CASE, static::THIS_GENDER);
    }

    public function testHasExceptionsCorrectGenderAfterIncorrectNoSuffixes()
    {
        $this->runTestHasExceptionsCorrectGenderAfterIncorrectNoSuffixes(
            'Тест',
            'Тест',
            static::THIS_CASE,
            static::THIS_GENDER
        );
    }

    public function testHasExceptionsAndSuffixes()
    {
        $this->runTestHasExceptionsAndSuffixes('Тест', 'Тест', static::THIS_CASE, static::THIS_GENDER);
    }

    public function testHasExceptionsAndSuffixesReverseOrder()
    {
        $this->runTestHasExceptionsAndSuffixesReverseOrder('Тест', 'Тест', static::THIS_CASE, static::THIS_GENDER);
    }

    public function testNoExceptionsHasSuffixes()
    {
        $this->runTestNoExceptionsHasSuffixes('Тест', 'Тест', static::THIS_CASE, static::THIS_GENDER);
    }

    public function testNoExceptionsHasSuffixesDotMod()
    {
        $this->runTestNoExceptionsHasSuffixesDotMod('Тест', 'Тест', static::THIS_CASE, static::THIS_GENDER);
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
