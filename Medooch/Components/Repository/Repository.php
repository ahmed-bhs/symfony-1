<?php
/**
 * This file is part of the api.
 * Created by trimechmehdi.
 * Date: 5/6/17
 * Time: 20:51
 * @author: Trimech Mahdi <http://www.trimech-mahdi.fr/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Medooch\Components\Repository;

use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class Repository
 * @package Medooch\Components\Repository
 */
final class Repository
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * Repository constructor.
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * ---------------------------------------
     * @author: Mobelite <www.mobelite.fr>
     * ---------------------------------------
     * **************** Function documentation: ****************
     * return entity repository for the specified $entity
     * ---------------------------------------
     * **************** Function input/output: ****************
     * @param $entity
     * @return object
     * @throws \Exception
     * ---------------------------------------
     */
    public function getRepository($entity)
    {
        if ($this->container->has($entity . '.repository')) {
            return $this->container->get($entity . '.repository');
        }

        throw new \Exception('The service ' . $entity . '.repository is not registred in the container. Check your services configuration.');
    }
}