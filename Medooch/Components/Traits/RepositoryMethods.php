<?php
/**
 * This file is part of the Final-Safe.
 * Created by trimechmehdi.
 * Date: 5/18/17
 * Time: 14:16
 * @author: Mobelite <http://www.mobelite.fr/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Components\Traits;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\ClassMetadata;
/**
 * Trait RepositoryMethods
 * @package Components\Traits
 */
trait RepositoryMethods
{
    /**
     * AbstractRepository constructor.
     * @param EntityManager $em
     * @param ClassMetadata $class
     */
    public function __construct(EntityManager $em, $class)
    {
        parent::__construct($em, new ClassMetadata($class));
    }

    /**
     * ---------------------------------------
     * @author: Mobelite <www.mobelite.fr>
     * ---------------------------------------
     * **************** Function documentation: ****************
     * return an array of object for the $this->_class MetaDataClass data for the current repository
     * ---------------------------------------
     * **************** Function input/output: ****************
     * @return array
     * ---------------------------------------
     */
    public function all()
    {
        return $this->findAll();
    }

    /**
     * ---------------------------------------
     * @author: Mobelite <www.mobelite.fr>
     * ---------------------------------------
     * **************** Function documentation: ****************
     * return one object by unique identifier for the current $this->_class MetaDataClass
     * ---------------------------------------
     * **************** Function input/output: ****************
     * @param $id
     * @return null|object
     * ---------------------------------------
     */
    public function one($id)
    {
        return $this->find($id);
    }

    /**
     * ---------------------------------------
     * @author: Mobelite <www.mobelite.fr>
     * ---------------------------------------
     * **************** Function documentation: ****************
     * return array of $this->_class MetaDataClass by $criteria
     * ---------------------------------------
     * **************** Function input/output: ****************
     * @param array $criteria (conditions query parameters)
     * @param array|null $orderBy (OrderBy query parameters)
     * @param null $limit (limit query = setMaxResults($limit)
     * @param null $offset
     * @return array
     * ---------------------------------------
     */
    public function by(array $criteria, array $orderBy = null, $limit = null, $offset = null)
    {
        return parent::findBy($criteria, $orderBy, $limit, $offset);
    }

    /**
     * ---------------------------------------
     * @author: Mobelite <www.mobelite.fr>
     * ---------------------------------------
     * **************** Function documentation: ****************
     * return one object for $this->_class MetaDataClass or null result
     * ---------------------------------------
     * **************** Function input/output: ****************
     * @param array $criteria (conditions query parameters)
     * @param array|null $orderBy (OrderBy query parameters)
     * @return null|object
     * ---------------------------------------
     */
    public function oneBy(array $criteria, array $orderBy = null)
    {
        return parent::findOneBy($criteria, $orderBy);
    }


    /**
     * ---------------------------------------
     * @author: Mobelite <www.mobelite.fr>
     * ---------------------------------------
     * **************** Function documentation: ****************
     * return active or inactive data for the $this->_class
     * ---------------------------------------
     * **************** Function input/output: ****************
     * @param array $criteria
     * @param string $field
     * @param bool $status
     * @param array|null $orderBy
     * @param null $limit
     * @return array
     * @throws \Exception
     * ---------------------------------------
     */
    public function statusRecording(array $criteria = array(), $field = 'isActive', $status = true, array $orderBy = null, $limit = null)
    {
        if (!$this->_class->hasField($field)) {
            throw new \Exception("Entity '" . $this->_entityName . "' has no field '" . $field . "'. ");
        }
        $criteria = array_merge($criteria, [$field => $status]);
        return $this->by($criteria, $orderBy, $orderBy);
    }

    /**
     * ---------------------------------------
     * @author: contact[at]mobelite.fr
     * ---------------------------------------
     * **************** Function documentation: ****************
     * Find one object by token
     * ---------------------------------------
     * **************** Function input: ****************
     * @param $token
     * ---------------------------------------
     * **************** Function output: ****************
     * @return null|object
     * ---------------------------------------
     */
    public function byToken($token)
    {
        return $this->findOneBy(['token' => $token]);
    }

    /**
     * ---------------------------------------
     * @author: Mobelite <www.mobelite.fr>
     * ---------------------------------------
     * **************** Function documentation: ****************
     * return a query builder for $this->_class MetaDataClass
     * ---------------------------------------
     * **************** Function input/output: ****************
     * @return \Doctrine\ORM\QueryBuilder
     * ---------------------------------------
     */
    public function queryBuilder()
    {
        return $this->createQueryBuilder('e');
    }

    /**
     * ---------------------------------------
     * @author: Mobelite <www.mobelite.fr>
     * ---------------------------------------
     * **************** Function documentation: ****************
     * Return EntityManager
     * ---------------------------------------
     * **************** Function output: ****************
     * @return EntityManager
     * ---------------------------------------
     */
    public function getEntityManager()
    {
        return $this->_em;
    }
}