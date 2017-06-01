<?php
/**
 * This file is part of the Final-Safe.
 * Created by trimechmehdi.
 * Date: 5/16/17
 * Time: 12:16
 * @author: Trimech Mehdi <trimechmehdi11@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Medooch\Components\Traits;

/**
 * Class IsDeleted
 * @package Medooch\Components\Traits
 */
trait IsDeleted
{
    /**
     * @var boolean
     * @ORM\Column(type="boolean")
     */
    private $isDeleted = false;

    /**
     * @return boolean
     */
    public function getIsDeleted()    {
        return $this->isDeleted;
    }

    /**
     * @param string $isDeleted
     */
    public function setIsDeleted($isDeleted)
    {
        $this->isDeleted = $isDeleted;
    }
}