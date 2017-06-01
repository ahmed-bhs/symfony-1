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

namespace Medooch\Components\Helper\Router;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Route;

/**
 * Interface RouterHelperInterface
 * @package Medooch\Components\Helper\Router
 */
interface RouterHelperInterface
{
    public function getCurrentAction(): string;
    
    public function getRouterRequestContext(): RequestContext;
    
    public function redirectTo(string $route, array $routeParams = []): RedirectResponse;
    
    public function redirectToAction(string $action, array $params = []): RedirectResponse;
    
    public function redirectToUrl(string $url, int $status = 302): RedirectResponse;
    
    public function getActionForCurrentController(string $action): string;
    
    public function getRedirectToActionUrl(string $action, array $params = []): string;
    
    public function generateUrl(string $routeName, array $params = [], int $referenceType = UrlGeneratorInterface::ABSOLUTE_URL): string;
    
    public function getCurrentRoute(): Route;
    
    public function getCurrentRouteName(): string;
}
