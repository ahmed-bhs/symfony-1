<?php
/**
 * This file is part of the Final-Safe.
 * Created by trimechmehdi.
 * Date: 5/18/17
 * Time: 14:15
 * @author: Trimech Mehdi <trimechmehdi11@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Medooch\Components\Repository;

use Components\Traits\RepositoryMethods;
use Gedmo\Tree\Entity\Repository\NestedTreeRepository;

/**
 * Class AbstractRepositoryTree
 * @package Medooch\Components\Repository
 */
class AbstractRepositoryTree extends NestedTreeRepository implements AbstractRepositoryInterface
{
    use RepositoryMethods;

    /**
     * ---------------------------------------
     * @author: Trimech Mehdi <trimechmehdi11@gmail.com>
     * ---------------------------------------
     * **************** Function output: ****************
     * @return \Doctrine\ORM\QueryBuilder
     * ---------------------------------------
     */
    public function tree()
    {
        return $this
            ->queryBuilder()
            ->orderBy("e.left", "ASC")
            ->where("e.level > :level")
            ->setParameters([
                'level' => 0,
            ])
            ->orderBy('e.left, e.level')
            ;
    }

    /**
     * ---------------------------------------
     * @author: Trimech Mehdi <trimechmehdi11@gmail.com>
     * ---------------------------------------
     * **************** Function documentation: ****************
     * Get the entityRoot element
     * ---------------------------------------
     * **************** Function output: ****************
     * @return mixed
     * ---------------------------------------
     */
    public function treeView()
    {
        return $this->tree()
            ->andWhere('e.isActive = :isActive')
            ->setParameter('isActive', true);
    }

    /**
     * ---------------------------------------
     * @author: Trimech Mehdi <trimechmehdi11@gmail.com>
     * ---------------------------------------
     * **************** Function documentation: ****************
     * Get the entityRoot element
     * ---------------------------------------
     * **************** Function output: ****************
     * @return mixed
     * ---------------------------------------
     */
    public function getEntityRoot()
    {
        return $this
            ->queryBuilder()
            ->orderBy("e.root, e.left", "ASC")
            ->where("e.level < 1")
            ->getQuery()
            ->getOneOrNullResult();
    }



    /**
     * @param null $node
     * @param bool $direct
     * @param array $options
     * @param bool $includeNode
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function getNodesHierarchyPersonnalized($node = null, $direct = false, array $options = array(), $includeNode = false)
    {
        return $this->getNodesHierarchyQueryBuilder($node, $direct, $options, $includeNode);
    }

    /**
     * @param null $node
     * @param bool $direct
     * @param array $options
     * @param bool $includeNode
     * @return array
     */
    public function allNodesHierarchy($node = null, $direct = false, array $options = array(), $includeNode = false){
        return $this->getNodesHierarchyPersonnalized($node, $direct, $options, $includeNode)->getQuery()->getArrayResult();
    }

    /**
     * @param null $node
     * @param bool $direct
     * @param array $options
     * @param bool $includeNode
     * @return mixed
     */
    public function countChildrensNode($node = null, $direct = false, array $options = array(), $includeNode = false){
        return $this->getNodesHierarchyPersonnalized($node, $direct, $options, $includeNode)
            ->select('count(node.id) as length')->getQuery()->getOneOrNullResult();
    }
}