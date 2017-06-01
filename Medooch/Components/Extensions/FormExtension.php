<?php
/**
 * This file is part of the Final-Safe.
 * Created by trimechmehdi.
 * Date: 5/16/17
 * Time: 12:49
 * @author: Mobelite <http://www.mobelite.fr/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Medooch\Components\Extensions;

use Symfony\Bridge\Twig\Form\TwigRendererInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Form\FormView;

/**
 * Class FormExtension
 * @package Medooch\Components\Extensions
 */
class FormExtension extends \Twig_Extension
{
    /**
     * FormExtension constructor.
     * @param ContainerInterface $container
     * @param TwigRendererInterface $renderer
     */
    public function __construct(ContainerInterface $container, TwigRendererInterface $renderer)
    {
        $this->container = $container;
        $this->renderer = $renderer;
    }

    /**
     * {@inheritdoc}
     */
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('tags_expanded', array($this, 'tagsExpanded')),
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getFunctions()
    {
        return [
            'crud_javascript' => new \Twig_Function_Method($this, 'renderJavascript', array('is_safe' => array('html'))),
            'form_render' => new \Twig_Function_Method($this, 'formRender', array('is_safe' => array('html'))),
        ];
    }

    /**
     * @param FormView $view
     * @return string
     */
    public function renderJavascript(FormView $view)
    {
        return $this->renderer->searchAndRenderBlock($view, 'javascript');
    }

    /**
     * ---------------------------------------
     * @author: Trimech Mehdi <trimechmehdi11@gmail.com>
     * ---------------------------------------
     * **************** Function input: ****************
     * @param FormView $view
     * @param $url
     * @param string $label
     * @param string $tooltip
     *
     * ---------------------------------------
     * **************** Function output: ****************
     * @return string
     * ---------------------------------------
     */
    public function formRender(FormView $view, $url, $label = '', $tooltip = '')
    {
        return $this->renderer->searchAndRenderBlock($view, 'crud_render', [
            'url' => $url,
            'label' => $label,
            'tooltip' => $tooltip,
        ]);
    }
}