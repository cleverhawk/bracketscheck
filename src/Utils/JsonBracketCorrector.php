<?php

namespace SmartHawk\Utils;

use SmartHawk\Exceptions\InvalidArgumentException;

class JsonBracketCorrector
{
    /**
     * @param string $brackets
     * @return bool
     * @throws InvalidArgumentException
     */
    public static function check(string $brackets): bool
    {
        if (!$brackets) {
            return true;
        }

        $newBrackets = preg_replace('/[^\(\)\s]/ui', '', $brackets);
        if (strlen($newBrackets) !== strlen($brackets)) {
            throw new InvalidArgumentException();
        }

        $newBrackets = preg_replace('/[^\(\)]/ui', '', $newBrackets);

        if (strlen($newBrackets) % 2 !== 0) {
            return false;
        }

        $openBracket = 0;
        $newBrackets = str_split($newBrackets);
        
        foreach ($newBrackets as $bracket) {

            if ($bracket === '(') {
                $openBracket += 1;
            }

            if ($bracket === ')') {
                $openBracket -= 1;
            }

            if ($openBracket < 0) {
                return false;
            }
        }

        return $openBracket === 0;
    }
}