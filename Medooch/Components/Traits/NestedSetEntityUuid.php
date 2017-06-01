<?php
/**
 * This file is part of the Final-Safe.
 * Created by trimechmehdi.
 * Date: 5/25/17
 * Time: 16:30
 * @author: Trimech Mehdi <trimechmehdi11@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Medooch\Components\Traits;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Trait NestedSetEntityUuid
 * @package Medooch\Components\Traits
 */
trait NestedSetEntityUuid
{
    use \Gedmo\Tree\Traits\NestedSetEntity;

    /**
     * @var string
     * @Gedmo\TreeRoot
     * @ORM\Column(name="root", type="string", nullable=true)
     */
    private $root;

    /**
     * @return int
     */
    public function getLevel(): int
    {
        return $this->level;
    }

    /**
     * @param int $level
     */
    public function setLevel(int $level)
    {
        $this->level = $level;
    }

    /**
     * @return int
     */
    public function getLeft(): int
    {
        return $this->left;
    }

    /**
     * @param int $left
     */
    public function setLeft(int $left)
    {
        $this->left = $left;
    }

    /**
     * @return int
     */
    public function getRight(): int
    {
        return $this->right;
    }

    /**
     * @param int $right
     */
    public function setRight(int $right)
    {
        $this->right = $right;
    }

    /**
     * @return string
     */
    public function getRoot(): string
    {
        return $this->root;
    }

    /**
     * @param string $root
     */
    public function setRoot(string $root)
    {
        $this->root = $root;
    }
}