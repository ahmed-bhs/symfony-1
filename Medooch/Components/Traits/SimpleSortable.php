<?php
/**
 * This file is part of the Final-Safe.
 * Created by trimechmehdi.
 * Date: 5/18/17
 * Time: 13:07
 * @author: Mobelite <http://www.mobelite.fr/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Medooch\Components\Traits;

/**
 * Trait SimpleSortable
 * @package Medooch\Components\Traits
 */
trait SimpleSortable
{

    /**
     * @var int
     * @Gedmo\SortablePosition
     * @ORM\Column(name="rank", type="integer")
     */
    private $rank;

    /**
     * @return int
     */
    public function getRank(): int
    {
        return $this->rank;
    }

    /**
     * @param int $rank
     */
    public function setRank(int $rank)
    {
        $this->rank = $rank;
    }
}