<?php
/**
 * Copyright (c) 2017.
 */

namespace Medooch\Bundles\MedoochI18nBundle\Lib\Reverso;

/**
 * Interface SpellingInterface
 * @package Lib\Reverso
 */
interface SpellingInterface
{
    /**
     * ---------------------------------------
     * @author: Trimech Mehdi
     * ---------------------------------------
     * **************** Function input: ****************
     * @param $txt
     * @param string $language
     * ---------------------------------------
     * **************** Function output: ****************
     * @return mixed
     * ---------------------------------------
     */
    public static function correctionText($txt, $language = 'fra');
}