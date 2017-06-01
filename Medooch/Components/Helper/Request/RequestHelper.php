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

namespace Medooch\Components\Helper\Request;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;

/**
 * Class RequestHelper
 * @package Medooch\Components\Helper\Request
 */
final class RequestHelper implements RequestHelperInterface
{
    /**
     * @var RequestStack
     */
    private $requestStack;
    
    /**
     * @var null|Request
     */
    private $request;
    
    /**
     * @var string
     */
    private $fallbackLocale;
    
    /**
     * RequestHelper constructor.
     *
     * @param RequestStack $requestStack
     * @param string       $fallbackLocale
     */
    public function __construct(RequestStack $requestStack, string $fallbackLocale)
    {
        $this->requestStack   = $requestStack;
        $this->fallbackLocale = $fallbackLocale;
    }
    
    /**
     * {@inheritdoc}
     */
    public function getCurrentRequest()
    {
        if (null === $this->request) {
            $this->request = $this->requestStack->getMasterRequest();
        }
        
        return $this->request;
    }
    
    /**
     * {@inheritdoc}
     */
    public function getCurrentHost()
    {
        if (!$this->getCurrentRequest() instanceof Request) {
            return null;
        }
        
        return $this->getCurrentRequest()->getHost();
    }
    
    /**
     * {@inheritdoc}
     */
    public function getSessionAttribute(string $name, $default = null)
    {
        if (null !== $this->getCurrentRequest() && $this->request->hasSession()) {
            return $this->request->getSession()->get($name, $default);
        }
        
        return $default;
    }
    
    /**
     * {@inheritdoc}
     */
    public function setSessionAttribute(string $name, $value)
    {
        if (null === $this->getCurrentRequest() || false === $this->request->hasSession()) {
            throw new \LogicException('Cannot set session attributes without valid session.');
        }
        
        return $this->request->getSession()->set($name, $value);
    }
    
    /**
     * {@inheritdoc}
     */
    public function hasSessionAttribute(string $name): bool
    {
        if (null !== $this->getCurrentRequest() && $this->request->hasSession()) {
            return $this->request->getSession()->has($name);
        }
        
        return false;
    }
    
    /**
     * {@inheritdoc}
     */
    public function getSessionId(): string
    {
        if (null !== $this->getCurrentRequest() && $this->request->hasSession()) {
            return $this->request->getSession()->getId();
        }
        
        return '';
    }
    
    /**
     * {@inheritdoc}
     */
    public function getSessionName(): string
    {
        if (null !== $this->getCurrentRequest() && $this->request->hasSession()) {
            return $this->request->getSession()->getName();
        }
        
        return '';
    }
    
    /**
     * {@inheritdoc}
     */
    public function hasRequestBagParam(string $name): bool
    {
        if ($this->getCurrentRequest() instanceof Request) {
            return $this->request->request->has($name);
        }
        
        return false;
    }
    
    /**
     * {@inheritdoc}
     */
    public function hasRequestBagParams(array $params = []): bool
    {
        foreach ($params as $param) {
            if (!$this->hasRequestBagParam($param)) {
                return false;
            }
        }
        
        return true;
    }
    
    /**
     * {@inheritdoc}
     */
    public function getRequestBagParam(string $name, $default = null, int $filter = FILTER_SANITIZE_SPECIAL_CHARS)
    {
        if (false === $this->hasRequestBagParam($name)) {
            return $default;
        }
        
        return $this->request->request->filter($name, $default, $filter);
    }
    
    /**
     * {@inheritdoc}
     */
    public function getQueryBagParam(string $name, $default = null, int $filter = FILTER_SANITIZE_SPECIAL_CHARS)
    {
        if (null === $this->getCurrentRequest() || false === $this->request->query->has($name)) {
            return $default;
        }
        
        return $this->request->query->filter($name, $default, $filter);
    }
    
    /**
     * {@inheritdoc}
     */
    public function hasAttributesBagParam(string $name): bool
    {
        if ($this->getCurrentRequest() instanceof Request) {
            return $this->request->attributes->has($name);
        }
        
        return false;
    }
    
    /**
     * {@inheritdoc}
     */
    public function hasAttributesBagParams(array $params = []): bool
    {
        foreach ($params as $param) {
            if (!$this->hasAttributesBagParam($param)) {
                return false;
            }
        }
        
        return true;
    }
    
    /**
     * {@inheritdoc}
     */
    public function getAttributesBagParam(string $name, $default = null, int $filter = FILTER_SANITIZE_SPECIAL_CHARS)
    {
        if (false === $this->hasAttributesBagParam($name)) {
            return $default;
        }
        
        return $this->request->attributes->filter($name, $default, $filter);
    }
    
    /**
     * {@inheritdoc}
     */
    public function getCurrentLocale(): string
    {
        if (null !== $this->getCurrentRequest()) {
            return $this->getCurrentRequest()->getLocale();
        }
        
        return $this->fallbackLocale;
    }
    
    /**
     * {@inheritdoc}
     */
    public function getCurrentCurrency(): string
    {
        return $this->getSessionAttribute('_currency', '');
    }
}
