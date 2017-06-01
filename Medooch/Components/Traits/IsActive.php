<?php
/**
 * This file is part of the Final-Safe.
 * Created by trimechmehdi.
 * Date: 5/16/17
 * Time: 12:16
 * @author: Mobelite <http://www.mobelite.fr/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Components\Traits;

/**
 * Trait IsActive
 * @package Components\Traits
 */
trait IsActive
{
    /**
     * @var boolean
     * @ORM\Column(type="boolean")
     */
    private $isActive = true;

    /**
     * @return boolean
     */
    public function getIsActive(): bool
    {
        return $this->isActive;
    }

    /**
     * @param boolean $isActive
     */
    public function setIsActive(bool $isActive)
    {
        $this->isActive = $isActive;
    }
}