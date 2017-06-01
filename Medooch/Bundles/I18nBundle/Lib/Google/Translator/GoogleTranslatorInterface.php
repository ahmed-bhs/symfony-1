<?php
/**
 * Copyright (c) 2017.
 */

namespace Bundles\MedoochI18nBundle\Lib\Google\Translator;

/**
 * Interface GoogleTranslatorInterface
 * @package Lib\Google\Translator
 */
interface GoogleTranslatorInterface
{
    /**
     * ---------------------------------------
     * @author: Trimech Mehdi <trimechmehdi11@gmail.com> // url : http://trimech-mahdi.fr/
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