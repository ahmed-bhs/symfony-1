<?php
/**
 * This file is part of the api.
 * Created by trimechmehdi.
 * Date: 5/6/17
 * Time: 20:32
 * @author: Trimech Mahdi <http://www.trimech-mahdi.fr/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Medooch\Components\Repository;


/**
 * Interface AbstractRepositoryInterface
 * @package Medooch\Components\Repository
 */
interface AbstractRepositoryInterface
{
    /**
     * ---------------------------------------
     * @author: Mobelite <www.mobelite.fr>
     * ---------------------------------------
     * **************** Function documentation: ****************
     * return an array of object for the $this->class MetaDataClass data for the current repository
     * ---------------------------------------
     * **************** Function input/output: ****************
     * @return array
     * ---------------------------------------
     */
    public function all();

    /**
     * ---------------------------------------
     * @author: Mobelite <www.mobelite.fr>
     * ---------------------------------------
     * **************** Function documentation: ****************
     * return one object by unique identifier for the current $this->class MetaDataClass
     * ---------------------------------------
     * **************** Function input/output: ****************
     * @param $id
     * @return null|object
     * ---------------------------------------
     */
    public function one($id);

    /**
     * ---------------------------------------
     * @author: Mobelite <www.mobelite.fr>
     * ---------------------------------------
     * **************** Function documentation: ****************
     * return array of $this->class MetaDataClass by $criteria
     * ---------------------------------------
     * **************** Function input/output: ****************
     * @param array $criteria (conditions query parameters)
     * @param array|null $orderBy (OrderBy query parameters)
     * @param null $limit (limit query = setMaxResults($limit)
     * @param null $offset
     * @return array
     * ---------------------------------------
     */
    public function by(array $criteria, array $orderBy = null, $limit = null, $offset = null);

    /**
     * ---------------------------------------
     * @author: Mobelite <www.mobelite.fr>
     * ---------------------------------------
     * **************** Function documentation: ****************
     * return one object for $this->class MetaDataClass or null result
     * ---------------------------------------
     * **************** Function input/output: ****************
     * @param array $criteria (conditions query parameters)
     * @param array|null $orderBy (OrderBy query parameters)
     * @return null|object
     * ---------------------------------------
     */
    public function oneBy(array $criteria, array $orderBy = null);

    /**
     * ---------------------------------------
     * @author: Mobelite <www.mobelite.fr>
     * ---------------------------------------
     * **************** Function documentation: ****************
     * return query builder
     * ---------------------------------------
     * **************** Function input/output: ****************
     * @return mixed
     * ---------------------------------------
     */
    public function queryBuilder();
}