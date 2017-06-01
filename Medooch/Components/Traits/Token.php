<?php
/**
 * This file is part of the backoffice.
 * Created by trimechmehdi.
 * Date: 5/15/17
 * Time: 19:38
 * @author: Mobelite <http://www.mobelite.fr/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Medooch\Components\Traits;
use Components\Helper\Helper;

/**
 * Class Token
 * @package Medooch\Components\Traits
 */
trait Token
{
    /**
     * Token constructor.
     */
    public function setToken()
    {
        $this->token = Helper::generateToken();
    }

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     */
    private $token;

    /**
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }
}