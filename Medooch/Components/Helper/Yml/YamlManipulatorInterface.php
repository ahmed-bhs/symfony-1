<?php
/**
 * This file is part of the MedoochPackages.
 * Created by trimechmehdi.
 * Date: 5/16/17
 * Time: 09:22
 * @author: Trimech Mehdi <trimechmehdi11@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Medooch\Components\Helper\Yml;

/**
 * Interface YamlManipulatorInterface
 * @package Medooch\Components\Helper
 */
interface YamlManipulatorInterface
{
    /**
     * ---------------------------------------
     * @author: Trimech Mehdi <trimechmehdi11@gmail.com>
     * ---------------------------------------
     * **************** Function documentation: ****************
     * Return array of yaml file
     * ---------------------------------------
     * **************** Function input: ****************
     * @param $filename
     * @param string $key
     * ---------------------------------------
     * **************** Function output: ****************
     * @return array|mixed
     * ---------------------------------------
     */
    public static function getParameters($filename, $key = 'services');

    /**
     * ---------------------------------------
     * @author: Trimech Mehdi <trimechmehdi11@gmail.com>
     * ---------------------------------------
     * **************** Function documentation: ****************
     * return the file contents of $filename
     * ---------------------------------------
     * **************** Function input: ****************
     * @param $filename
     * ---------------------------------------
     * **************** Function output: ****************
     * @return mixed|null
     * ---------------------------------------
     */
    public static function getFileContents($filename);
    
    /**
     * ---------------------------------------
     * @author: Trimech Mehdi <trimechmehdi11@gmail.com>
     * ---------------------------------------
     * **************** Function documentation: ****************
     * Dump array @param to the target filename
     * ---------------------------------------
     * **************** Function input: ****************
     * @param $filename
     * @param array $parameters
     * ---------------------------------------
     */
    public static function updateParameters($filename, array $parameters = array());
}