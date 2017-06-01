<?php
/**
 * This file is part of the MedoochPackages.
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
use Gedmo\Sortable\Entity\Repository\SortableRepository;

/**
 * Class AbstractRepositorySortable
 * @package Medooch\Components\Repository
 */
class AbstractRepositorySortable extends SortableRepository implements AbstractRepositoryInterface
{
    use RepositoryMethods;
}