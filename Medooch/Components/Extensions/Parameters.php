<?php

/**
 * @Mobelite: Custom extension
 */
namespace Medooch\Components\Extensions;

use FOS\UserBundle\Model\UserInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class Parameters extends \Twig_Extension
{
    private $container, $translator, $route;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->translator = $this->container->get('translator');
    }

    /**
     * List of available functions
     *
     * @return array
     */
    public function getFilters()
    {
        return array();
    }

    /**
     * List of available functions
     *
     * @return array
     */
    public function getFunctions()
    {
        return array(
            'get_params' => new \Twig_Function_Method($this, 'getParameters'),
            'session_params' => new \Twig_Function_Method($this, 'sessionParams'),
            'is_prod' => new \Twig_Function_Method($this, 'isProd'),
            'get_slug' => new \Twig_Function_Method($this, 'getSlug'),
            'tree_structure' => new \Twig_Function_Method($this, 'treeStructure'),
            'asset_v' => new \Twig_Function_Method($this, 'assetV'),

        );
    }


    /**
     * @param  [string] $param ['Parameter key to search']
     * @return [string]        [Return the parameter value if exist]
     * @Mobelite: Search a parameter by key in the file "app/config/parameters.yml"
     */
    public function getParameters($param)
    {
        $value = $this->container->getParameter($param);

        return $value;
    }

    public function sessionParams($params)
    {
        if ($this->container->get('session')->has($params)) {
            return $this->container->get('session')->get($params);
        }

        return false;
    }

    /**
     * @return [boolean]        [Test if the environnement is prod ?]
     * @Mobelite: [This function called in Twig Layout, return true if the environment isProd, else return false]
     */
    public function isProd()
    {
        $environnment = $this->container->get('kernel')->getEnvironment();
        if ($environnment === 'prod') {
            return true;
        }
        return false;
    }

    public function getSlug($str)
    {
        # special accents
        $a = array('À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Æ', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ð', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ø', 'Ù', 'Ú', 'Û', 'Ü', 'Ý', 'ß', 'à', 'á', 'â', 'ã', 'ä', 'å', 'æ', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ø', 'ù', 'ú', 'û', 'ü', 'ý', 'ÿ', 'A', 'a', 'A', 'a', 'A', 'a', 'C', 'c', 'C', 'c', 'C', 'c', 'C', 'c', 'D', 'd', 'Ð', 'd', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'G', 'g', 'G', 'g', 'G', 'g', 'G', 'g', 'H', 'h', 'H', 'h', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', '?', '?', 'J', 'j', 'K', 'k', 'L', 'l', 'L', 'l', 'L', 'l', '?', '?', 'L', 'l', 'N', 'n', 'N', 'n', 'N', 'n', '?', 'O', 'o', 'O', 'o', 'O', 'o', 'Œ', 'œ', 'R', 'r', 'R', 'r', 'R', 'r', 'S', 's', 'S', 's', 'S', 's', 'Š', 'š', 'T', 't', 'T', 't', 'T', 't', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'W', 'w', 'Y', 'y', 'Ÿ', 'Z', 'z', 'Z', 'z', 'Ž', 'ž', '?', 'ƒ', 'O', 'o', 'U', 'u', 'A', 'a', 'I', 'i', 'O', 'o', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', '?', '?', '?', '?', '?', '?');
        $b = array('A', 'A', 'A', 'A', 'A', 'A', 'AE', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'D', 'N', 'O', 'O', 'O', 'O', 'O', 'O', 'U', 'U', 'U', 'U', 'Y', 's', 'a', 'a', 'a', 'a', 'a', 'a', 'ae', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'n', 'o', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u', 'y', 'y', 'A', 'a', 'A', 'a', 'A', 'a', 'C', 'c', 'C', 'c', 'C', 'c', 'C', 'c', 'D', 'd', 'D', 'd', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'G', 'g', 'G', 'g', 'G', 'g', 'G', 'g', 'H', 'h', 'H', 'h', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'IJ', 'ij', 'J', 'j', 'K', 'k', 'L', 'l', 'L', 'l', 'L', 'l', 'L', 'l', 'l', 'l', 'N', 'n', 'N', 'n', 'N', 'n', 'n', 'O', 'o', 'O', 'o', 'O', 'o', 'OE', 'oe', 'R', 'r', 'R', 'r', 'R', 'r', 'S', 's', 'S', 's', 'S', 's', 'S', 's', 'T', 't', 'T', 't', 'T', 't', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'W', 'w', 'Y', 'y', 'Y', 'Z', 'z', 'Z', 'z', 'Z', 'z', 's', 'f', 'O', 'o', 'U', 'u', 'A', 'a', 'I', 'i', 'O', 'o', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'A', 'a', 'AE', 'ae', 'O', 'o');
        return strtolower(preg_replace(array('/[^a-zA-Z0-9 -]/', '/[ -]+/', '/^-|-$/'), array('', '-', ''), str_replace($a, $b, $str)));

    }

    /**
     * ---------------------------------------
     * @author: Trimech Mehdi <trimechmehdi11@gmail.com>
     * ---------------------------------------
     * **************** Function documentation: ****************
     * Return Tree View
     * ---------------------------------------
     * **************** Function input: ****************
     * @param $entities
     * @param $id = 'order_nestable_list' => Change it from the view if you want.
     * ---------------------------------------
     * **************** Function output: ****************
     * @return string
     * ---------------------------------------
     */
    public function treeStructure($entities, $id = 'order_nestable_list')
    {
        $output = '<ol class="dd-list" id="'.$id.'">';
        if (count($entities)){
            $current_level = 0;
            foreach ($entities as $row) {
                if ($row->getLevel() > $current_level) {
                    $output .= '<ol><li id="list_' . $row->getId() . '" class="dd-item dd-item-alt">' . '<div class="dd-handle"></div><div class="dd-content">' . $row->__toString() . '</div>';
                }
                if ($row->getLevel() < $current_level) {
                    $output .= str_repeat('</li></ol>  ', ($current_level - $row->getLevel())) . '</li>  <li id="list_' . $row->getId() . '" class="dd-item dd-item-alt">' . '<div class="dd-handle"></div><div class="dd-content">' . $row->__toString() . '</div>';
                }
                if ($row->getLevel() == $current_level) {
                    $output .= '</li> <li id="list_' . $row->getId() . '" class="dd-item dd-item-alt">' . '<div class="dd-handle"></div><div class="dd-content">' . $row->__toString() . '</div>';
                }
                $current_level = $row->getLevel();
            }

            $output .= str_repeat("</li></ol>  ", ($row->getLevel()));
            $output .= "</li></ol>";
        }

        return $output;
    }

    /**
     * ---------------------------------------
     * @author: Trimech Mehdi <trimechmehdi11@gmail.com>
     * ---------------------------------------
     * **************** Function documentation: ****************
     * Versionning assets with version variable.
     * ---------------------------------------
     * **************** Function input: ****************
     * @param $path
     * ---------------------------------------
     * **************** Function output: ****************
     * @return string
     * ---------------------------------------
     */
    public function assetV($path)
    {
        return $this->container->get('assets.packages')->getUrl($path, $packageName = null).'?v='.$this->container->getParameter('app_version');
    }
}