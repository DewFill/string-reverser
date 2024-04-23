<?php
require __DIR__ . "/../vendor/autoload.php";
require __DIR__ . "/../src/StringReverser.php";

use artemy\src\StringReverser;
use PHPUnit\Framework\TestCase;

class StringReverserTest extends TestCase
{
    function testCasePreserve()
    {
        $array = [
            ["Cat", "Tac"],
            ["Мышь", "Ьшым"],
            ["houSe", "esuOh"],
            ["домИК", "кимОД"],
            ["elEpHant", "tnAhPele"],
        ];


        foreach ($array as $value) {
            $initialString = $value[0];
            $expectedString = $value[1];

            $reversedString = (new StringReverser($initialString))->reverse();
            $this->assertEquals($expectedString, $reversedString);
        }
    }

    function testPunctuationPreserve()
    {
        $array = [
            ["cat,", "tac,"],
            ["Зима:", "Амиз:"],
            ["is 'cold' now", "si 'dloc' won"],
            ['это «Так» "просто"', 'отэ «Кат» "отсорп"'],
            ["third-part", "driht-trap"],
            ["can`t", "nac`t"],
        ];


        foreach ($array as $value) {
            $initialString = $value[0];
            $expectedString = $value[1];

            $reversedString = (new StringReverser($initialString))->reverse();
            $this->assertEquals($expectedString, $reversedString);
        }
    }
}