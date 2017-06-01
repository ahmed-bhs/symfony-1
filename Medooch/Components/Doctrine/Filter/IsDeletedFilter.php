<?php
/**
 * This file is part of the Final-Safe.
 * Created by trimechmehdi.
 * Date: 5/22/17
 * Time: 11:48
 * @author: Mobelite <http://www.mobelite.fr/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Components\Doctrine\Filter;
use Doctrine\ORM\Mapping\ClassMetaData,
    Doctrine\ORM\Query\Filter\SQLFilter;

/**
 * Class IsDeletedFilter
 * @package Components\Doctrine\Filter
 */
class IsDeletedFilter extends SQLFilter
{
    /**
     * ---------------------------------------
     * @author: contact[at]mobelite.fr
     * ---------------------------------------
     * **************** Function documentation: ****************
     * Filter by is deleted
     * ---------------------------------------
     * **************** Function input: ****************
     * @param ClassMetaData $targetEntity
     * @param string $targetTableAlias
     * ---------------------------------------
     * **************** Function output: ****************
     * @return string
     * ---------------------------------------
     */
    public function addFilterConstraint(ClassMetaData $targetEntity, $targetTableAlias)
    {
        // Check if the entity implements the right interface
        if (!$targetEntity->reflClass->hasProperty('isDeleted')) {
            return "";
        }
        $filter = $targetTableAlias .'.is_deleted = false';

        return $filter;
    }

}