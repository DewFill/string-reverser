<?php
namespace artemy\src;
/**
 * Принимает на вход строку и меняет порядок букв в каждом слове на обратный:
 * - с сохранением регистра (например, 'Cat' -> 'Tac', 'Мышь' -> 'Ьшым', 'houSe' -> 'esuOh', 'домИК' -> 'кимОД', 'elEpHant' -> 'tnAhPele' - регистр сохраняется в соответствии с позицией прописных и строчных букв в первоначальном слове);
 * - с сохранением пунктуации (например, 'cat,' -> 'tac,', 'Зима:' -> 'Амиз:', "is 'cold' now" -> "si 'dloc' won", 'это «Так» "просто"' -> 'отэ «Кат» "отсорп"' - знаки препинания остаются на своих местах).
 *
 * Обрати внимание: составные слова, содержащие дефис(ы) и/или апостроф(ы), считаются отдельными словами с символами-разделителями между ними (например, 'third-part' -> 'driht-trap', 'can`t' -> 'nac`t'). Могут использоваться буквы из любых языков, не только английского.
 */
readonly class  StringReverser
{
    public function __construct(private string $str)
    {
    }

    public function reverse()
    {
        // find non punctuation characters

        return mb_ereg_replace_callback("\p{L}+", function ($str) {
//            var_dump($str);
            return $this->mb_strrev_preverse_case($str[0]);
        }, $this->str);

    }


    private function mb_strrev_preverse_case(string $string, string $encoding = null): string
    {
        $chars = mb_str_split($string, 1, $encoding ?: mb_internal_encoding());
        $reversed = array_reverse($chars);


        foreach ($reversed as $key => &$value) {
            if ($chars[$key] === mb_strtoupper($chars[$key])) {
//                var_dump($chars[$key]);
                $value = mb_strtoupper($value);
            } else {
                $value = mb_strtolower($value);
            }
        }
        return implode('', $reversed);
    }
}