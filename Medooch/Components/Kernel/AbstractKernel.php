<?php

namespace Components\Kernel;
use Shared\DBRBundle\DBRBundle;

/**
 * This file is part of the Final-Safe.
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
            // external bundles
            new \Stof\DoctrineExtensionsBundle\StofDoctrineExtensionsBundle(),
            new \Knp\Bundle\TimeBundle\KnpTimeBundle(),
            new \FOS\UserBundle\FOSUserBundle(),
            new \Liip\ImagineBundle\LiipImagineBundle(),
            new \A2lix\I18nDoctrineBundle\A2lixI18nDoctrineBundle(),
            // shared bundles
            new \AppWeb\Core\UserBundle\UserBundle(),
            new DBRBundle(),
        ];

        if ($this->debug) {
            $bundles[] = new \Symfony\Bundle\DebugBundle\DebugBundle();
            $bundles[] = new \Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
            $bundles[] = new \Sensio\Bundle\DistributionBundle\SensioDistributionBundle();
            $bundles[] = new \Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle();
            if (in_array($this->name, array('local', 'web'))) {
                /** dev bundles */
                $bundles[] = new \Doctrine\Bundle\FixturesBundle\DoctrineFixturesBundle();
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