<?php
/*
 * WellCommerce Open-Source E-Commerce Platform
 *
 * This file is part of the WellCommerce package.
 *
 * (c) Adam Piotrowski <adam@wellcommerce.org>
 *
 * For the full copyright and license information,
 * please view the LICENSE file that was distributed with this source code.
 */

namespace Medooch\Components\Helper\Image;

use Liip\ImagineBundle\Imagine\Cache\CacheManager;
use Liip\ImagineBundle\Imagine\Filter\FilterConfiguration;

/**
 * Class ImageHelper
 * @package Medooch\Components\Helper\Image
 */
final class ImageHelper implements ImageHelperInterface
{
    /**
     * @var CacheManager
     */
    private $cacheManager;
    
    /**
     * @var FilterConfiguration
     */
    private $configuration;

    /**
     * ImageHelper constructor.
     * @param CacheManager $cacheManager
     * @param FilterConfiguration $configuration
     */
    public function __construct(CacheManager $cacheManager, FilterConfiguration $configuration)
    {
        $this->cacheManager  = $cacheManager;
        $this->configuration = $configuration;
    }

    /**
     * ---------------------------------------
     * @author: Trimech Mehdi <trimechmehdi11@gmail.com>
     * ---------------------------------------
     * **************** Function input: ****************
     * @param string|null $path
     * @param string $filter
     * @param array $config
     * ---------------------------------------
     * **************** Function output: ****************
     * @return string
     * ---------------------------------------
     */
    public function getImage(string $path = null, string $filter, array $config = []): string
    {
        if ('' === (string)$path) {
            return $this->getDefaultImage($filter);
        }
        
        return $this->cacheManager->getBrowserPath($path, $filter, $config);
    }

    /**
     * ---------------------------------------
     * @author: Trimech Mehdi <trimechmehdi11@gmail.com>
     * ---------------------------------------
     * **************** Function input: ****************
     * @param string $filter
     * ---------------------------------------
     * **************** Function output: ****************
     * @return string
     * ---------------------------------------
     */
    private function getDefaultImage(string $filter): string
    {
        $configuration = $this->configuration->get($filter);
        $size          = $configuration['filters']['thumbnail']['size'] ?? [300, 300];
        list($width, $height) = $size;
        
        return sprintf('http://placehold.it/%sx%s', $width, $height);
    }
}
