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

use Components\Traits\RepositoryMethods;
use Doctrine\ORM\EntityRepository;

/**
 * Class AbstractRepository
 * @package Medooch\Components\Repository
 */
class AbstractRepository extends EntityRepository implements AbstractRepositoryInterface
{
    use RepositoryMethods;
}
