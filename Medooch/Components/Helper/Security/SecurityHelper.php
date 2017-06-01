<?php
/*
 * WellCommerce Open-Source E-Commerce Platform
 * 
 * This file is part of the WellCommerce package.
 *
 * (c) Adam Piotrowski <adam@wellcommerce.org>
 * 
 * For the full copyright and license information,
 * please view the LICENSE file that was distributed with this source code.
 */

namespace Medooch\Components\Helper\Security;

use AppWeb\Core\UserBundle\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Components\Helper\Request\RequestHelperInterface;

/**
 * Class SecurityHelper
 * @package Medooch\Components\Helper\Security
 */
final class SecurityHelper implements SecurityHelperInterface
{
    /**
     * @var TokenStorageInterface
     */
    private $tokenStorage;
    
    /**
     * @var RequestHelperInterface
     */
    private $requestHelper;
    
    /**
     * SecurityHelper constructor.
     *
     * @param TokenStorageInterface  $tokenStorage
     * @param RequestHelperInterface $requestHelper
     */
    public function __construct(TokenStorageInterface $tokenStorage, RequestHelperInterface $requestHelper)
    {
        $this->tokenStorage  = $tokenStorage;
        $this->requestHelper = $requestHelper;
    }

    /**
     * ---------------------------------------
     * @author: Trimech Mehdi <trimechmehdi11@gmail.com>
     * ---------------------------------------
     * **************** Function output: ****************
     * @return mixed|null
     * ---------------------------------------
     */
    public function getCurrentUser()
    {
        $token = $this->tokenStorage->getToken();
        if (null !== $token) {
            return $token->getUser();
        }
        
        return null;
    }

    /**
     * ---------------------------------------
     * @author: Trimech Mehdi <trimechmehdi11@gmail.com>
     * ---------------------------------------
     * **************** Function output: ****************
     * @return mixed|null|User
     * ---------------------------------------
     */
    public function getCurrentClient()
    {
        $user = $this->getCurrentUser();
        
        return $user instanceof User ? $user : null;
    }

    /**
     * ---------------------------------------
     * @author: Trimech Mehdi <trimechmehdi11@gmail.com>
     * ---------------------------------------
     * **************** Function output: ****************
     * @return mixed|null|User
     * ---------------------------------------
     */
    public function getCurrentAdmin()
    {
        $user = $this->getCurrentUser();
        
        return $user instanceof User ? $user : null;
    }

    /**
     * ---------------------------------------
     * @author: Trimech Mehdi <trimechmehdi11@gmail.com>
     * ---------------------------------------
     * **************** Function output: ****************
     * @return User
     * ---------------------------------------
     */
    public function getAuthenticatedClient(): User
    {
        return $this->getCurrentUser();
    }

    /**
     * ---------------------------------------
     * @author: Trimech Mehdi <trimechmehdi11@gmail.com>
     * ---------------------------------------
     * **************** Function output: ****************
     * @return User
     * ---------------------------------------
     */
    public function getAuthenticatedAdmin(): User
    {
        return $this->getCurrentUser();
    }

    /**
     * ---------------------------------------
     * @author: Trimech Mehdi <trimechmehdi11@gmail.com>
     * ---------------------------------------
     * **************** Function input: ****************
     * @param string $name
     * ---------------------------------------
     * **************** Function output: ****************
     * @return bool
     * ---------------------------------------
     */
    public function isActiveFirewall(string $name): bool
    {
        $request = $this->requestHelper->getCurrentRequest();
        
        return $name === $this->getFirewallNameForRequest($request);
    }

    /**
     * ---------------------------------------
     * @author: Trimech Mehdi <trimechmehdi11@gmail.com>
     * ---------------------------------------
     * **************** Function output: ****************
     * @return bool
     * ---------------------------------------
     */
    public function isActiveAdminFirewall(): bool
    {
        return $this->isActiveFirewall('admin');
    }

    /**
     * ---------------------------------------
     * @author: Trimech Mehdi <trimechmehdi11@gmail.com>
     * ---------------------------------------
     * **************** Function input: ****************
     * @param Request $request
     * ---------------------------------------
     * **************** Function output: ****************
     * @return string
     * ---------------------------------------
     */
    public function getFirewallNameForRequest(Request $request)
    {
        list($mode,) = explode('/', ltrim($request->getPathInfo(), '/'));
        
        return ($mode === 'admin') ? 'admin' : 'client';
    }

    /**
     * ---------------------------------------
     * @author: Trimech Mehdi <trimechmehdi11@gmail.com>
     * ---------------------------------------
     * **************** Function input: ****************
     * @param int $length
     * ---------------------------------------
     * **************** Function output: ****************
     * @return string
     * ---------------------------------------
     */
    public function generateRandomPassword(int $length = 8): string
    {
        $chars    = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_-=+;:,.?";
        $password = substr(str_shuffle($chars), 0, $length);
        
        return $password;
    }
}
