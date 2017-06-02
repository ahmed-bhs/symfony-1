<?php

namespace Medooch\Components\Kernel;
use Medooch\Bundles\ExportBundle\ExportBundle;
use Medooch\Bundles\MedoochI18nBundle\MedoochI18nBundle;

/**
 * This file is part of the MedoochPackages.
 * Created by trimechmehdi.
 * Date: 5/12/17
 * Time: 17:04
 * @author: Trimech Mahdi <http://www.trimech-mahdi.fr/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * Class AbstractKernel
 */
abstract class AbstractKernel extends \Symfony\Component\HttpKernel\Kernel
{
    /**
     * ---------------------------------------
     * @author: Trimech Mehdi
     * ---------------------------------------
     * **************** Function output: ****************
     * @return array
     * ---------------------------------------
     */
    public function registerBundles()
    {
        $bundles = [
            new \Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new \Symfony\Bundle\SecurityBundle\SecurityBundle(),
            new \Symfony\Bundle\TwigBundle\TwigBundle(),
            new \Symfony\Bundle\MonologBundle\MonologBundle(),
            new \Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),
            new \Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
            new \Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),
            new ExportBundle(),
        ];

        if ($this->debug) {
            $bundles[] = new \Symfony\Bundle\DebugBundle\DebugBundle();
            $bundles[] = new \Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
            $bundles[] = new \Sensio\Bundle\DistributionBundle\SensioDistributionBundle();
            $bundles[] = new \Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle();
            if (in_array($this->name, array('dev', 'test'))) {
                /** dev bundles */
                $bundles[] = new MedoochI18nBundle();
            }
        }

        return $bundles;
    }

    /**
     * ---------------------------------------
     * @author: Trimech Mehdi
     * ---------------------------------------
     * **************** Function output: ****************
     * @return string
     * ---------------------------------------
     */
    public function getRootDir()
    {
        return __DIR__.'/../../../app';
    }
}