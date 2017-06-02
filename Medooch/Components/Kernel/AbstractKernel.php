<?php

namespace Medooch\Components\Kernel;

use Liip\ImagineBundle\LiipImagineBundle;
use Medooch\Bundles\ExportBundle\ExportBundle;
use Medooch\Bundles\MedoochTranslationBundle\MedoochTranslationBundle;
use Petkopara\CrudGeneratorBundle\PetkoparaCrudGeneratorBundle;
use Petkopara\MultiSearchBundle\PetkoparaMultiSearchBundle;

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
            new LiipImagineBundle(),
            new PetkoparaMultiSearchBundle(),
        ];

        if (in_array($this->environment, array('dev', 'test'))) {
            $bundles[] = new \Symfony\Bundle\DebugBundle\DebugBundle();
            $bundles[] = new \Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
            $bundles[] = new \Sensio\Bundle\DistributionBundle\SensioDistributionBundle();
            $bundles[] = new \Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle();
            $bundles[] = new MedoochTranslationBundle();
            $bundles[] = new PetkoparaCrudGeneratorBundle();
        }

        return $bundles;
    }
}