<?php
/**
 * This file is part of the MedoochPackages.
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
 * Trait IsActive
 * @package Medooch\Components\Traits
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