<?php

namespace romany4\inflection\inflection\ruleset;

use romany4\inflection\Inflection;

class Validator
{
    /**
     * Performs basic validation over provided rules
     * Useful for testing and/or any format changes
     *
     * @param array $rules
     *
     * @return bool
     */
    public function validate(array $rules): bool
    {
        if ($this->validateRootKeys($rules) === false) {
            return false;
        }

        foreach ($rules as $rule) {
            if ($this->validateSecondKeys($rule) === false) {
                return false;
            }

            foreach ($rule as $item) {
                foreach ($item as $itemData) {
                    if (\is_array($itemData) === false) {
                        return false;
                    }

                    if ($this->validateValueKeys($itemData) === false) {
                        return false;
                    }
                }
            }
        }

        return true;
    }

    /**
     * Validates all available root keys
     *
     * @param array $rules
     *
     * @return bool
     */
    public function validateRootKeys(array $rules): bool
    {
        $availableKeys = inflection\Ruleset::getAvailableRootKeys();

        $isFoundAnyAvailableKeys = false;

        foreach (\array_keys($rules) as $key) {
            if (\in_array($key, $availableKeys, true) === false) {
                return false;
            }

            $isFoundAnyAvailableKeys = true;
        }

        if ($isFoundAnyAvailableKeys === false) {
            return false;
        }

        return true;
    }

    public function validateSecondKeys(array $rule): bool
    {
        $availableKeys = inflection\Ruleset::getAvailableSecondKeys();

        foreach (\array_keys($rule) as $ruleSecondKey) {
            if (\in_array($ruleSecondKey, $availableKeys, true) === false) {
                return false;
            }
        }

        return true;
    }

    public function validateValueKeys(array $rule): bool
    {
        $availableKeys = inflection\Ruleset::getAvailableValueKeys();

        foreach (\array_keys($rule) as $ruleValueKey) {
            if (\in_array($ruleValueKey, $availableKeys, true) === false) {
                return false;
            }
        }

        return
            $this->validateValueKeyTest($rule) === true
            &&
            $this->validateValueKeyMods($rule) === true
            &&
            $this->validateValueKeyTags($rule) === true
            &&
            $this->validateValueKeyGender($rule) === true;
    }

    public function validateValueKeyTest(array $rule): bool
    {
        if (\array_key_exists(inflection\Ruleset::VALUE_KEY_TEST, $rule) === false) {
            return true;
        }

        if (\is_array($rule[inflection\Ruleset::VALUE_KEY_TEST]) === false) {
            return false;
        }

        return true;
    }

    public function validateValueKeyMods(array $rule): bool
    {
        if (\array_key_exists(inflection\Ruleset::VALUE_KEY_MODS, $rule) === false) {
            return true;
        }

        if (\is_array($rule[inflection\Ruleset::VALUE_KEY_MODS]) === false) {
            return false;
        }

        return true;
    }

    public function validateValueKeyTags(array $rule): bool
    {
        if (\array_key_exists(inflection\Ruleset::VALUE_KEY_TAGS, $rule) === false) {
            return true;
        }

        if (\is_array($rule[inflection\Ruleset::VALUE_KEY_TAGS]) === false) {
            return false;
        }

        return true;
    }

    public function validateValueKeyGender(array $rule): bool
    {
        $availableGenders = inflection\Ruleset::getAvailableGenders();

        if (\array_key_exists(inflection\Ruleset::VALUE_KEY_GENDER, $rule) === false) {
            return true;
        }

        if (\is_string($rule[inflection\Ruleset::VALUE_KEY_GENDER]) === false) {
            return false;
        }

        if (\in_array($rule[inflection\Ruleset::VALUE_KEY_GENDER], $availableGenders) === false) {
            return false;
        }

        return true;
    }
}
