<?php
/**
 * This file is part of the Final-Safe.
 * Created by trimechmehdi.
 * Date: 5/31/17
 * Time: 13:07
 * @author: Mobelite <http://www.mobelite.fr/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Components\Lib\Google\Translator;

/**
 * Interface GoogleTranslatorInterface
 * @package Components\Lib\Google\Translator
 */
interface GoogleTranslatorInterface
{
    /**
     * ---------------------------------------
     * @author: contact[at]mobelite.fr
     * ---------------------------------------
     * **************** Function documentation: ****************
     * Translate word from $source language to $target language
     * usage example : dump(GoogleTranslator::translate('bonjour', 'fr', 'en'));
     * ---------------------------------------
     * **************** Function input: ****************
     * @param string $word
     * @param string $source
     * @param string $target
     * ---------------------------------------
     * **************** Function output: ****************
     * @return string
     * ---------------------------------------
     */
    public static function translate(string $word, string $source, string $target):string;
}