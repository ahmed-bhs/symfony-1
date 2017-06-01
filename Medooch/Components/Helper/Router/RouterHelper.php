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

namespace Components\Helper\Router;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouterInterface;
use Components\Helper\Request\RequestHelperInterface;

/**
 * Class RouterHelper
 * @package Components\Helper\Router
 */
final class RouterHelper implements RouterHelperInterface
{
    /**
     * @var RouterInterface
     */
    private $router;

    /**
     * @var RequestHelperInterface
     */
    private $requestHelper;

    /**
     * RouterHelper constructor.
     *
     * @param RouterInterface $router
     * @param RequestHelperInterface $requestHelper
     */
    public function __construct(RouterInterface $router, RequestHelperInterface $requestHelper)
    {
        $this->router = $router;
        $this->requestHelper = $requestHelper;
    }

    /**
     * ---------------------------------------
     * @author: contact[at]mobelite.fr
     * ---------------------------------------
     * **************** Function output: ****************
     * @return string
     * ---------------------------------------
     */
    public function getCurrentAction(): string
    {
        $currentPath = $this->getRouterRequestContext()->getPathInfo();
        $currentRoute = $this->router->match($currentPath);
        list(, $action) = explode(':', $currentRoute['_controller']);

        return $action;
    }

    /**
     * ---------------------------------------
     * @author: contact[at]mobelite.fr
     * ---------------------------------------
     * **************** Function input: ****************
     * ---------------------------------------
     * **************** Function output: ****************
     * @return RequestContext
     * ---------------------------------------
     */
    public function getRouterRequestContext(): RequestContext
    {
        return $this->router->getContext();
    }

    /**
     * ---------------------------------------
     * @author: contact[at]mobelite.fr
     * ---------------------------------------
     * **************** Function input: ****************
     * @param string $action
     * @param array $params
     * ---------------------------------------
     * **************** Function output: ****************
     * @return RedirectResponse
     * ---------------------------------------
     */
    public function redirectToAction(string $action, array $params = []): RedirectResponse
    {
        $route = $this->getActionForCurrentController($action);

        return $this->redirectTo($route, $params);
    }

    /**
     * ---------------------------------------
     * @author: contact[at]mobelite.fr
     * ---------------------------------------
     * **************** Function input: ****************
     * @param string $action
     * @param array $params
     * ---------------------------------------
     * **************** Function output: ****************
     * @return string
     * ---------------------------------------
     */
    public function getRedirectToActionUrl(string $action, array $params = []): string
    {
        $route = $this->getActionForCurrentController($action);

        return $this->router->generate($route, $params);
    }

    /**
     * ---------------------------------------
     * @author: contact[at]mobelite.fr
     * ---------------------------------------
     * **************** Function input: ****************
     * @param string $action
     * ---------------------------------------
     * **************** Function output: ****************
     * @return string
     * ---------------------------------------
     */
    public function getActionForCurrentController(string $action): string
    {
        $currentPath = $this->getRouterRequestContext()->getPathInfo();
        $currentRoute = $this->router->match($currentPath);
        list($mode, $controller) = explode('.', $currentRoute['_route'], 3);

        $route = sprintf('%s.%s.%s', $mode, $controller, $action);

        return $route;
    }

    /**
     * ---------------------------------------
     * @author: contact[at]mobelite.fr
     * ---------------------------------------
     * **************** Function input: ****************
     * @param string $routeName
     * @param array $params
     * @param int $referenceType
     * ---------------------------------------
     * **************** Function output: ****************
     * @return string
     * ---------------------------------------
     */
    public function generateUrl(string $routeName, array $params = [], int $referenceType = UrlGeneratorInterface::ABSOLUTE_URL): string
    {
        return $this->router->generate($routeName, $params, $referenceType);
    }

    /**
     * ---------------------------------------
     * @author: contact[at]mobelite.fr
     * ---------------------------------------
     * **************** Function input: ****************
     * @param string $route
     * @param array $routeParams
     * ---------------------------------------
     * **************** Function output: ****************
     * @return RedirectResponse
     * ---------------------------------------
     */
    public function redirectTo(string $route, array $routeParams = []): RedirectResponse
    {
        $url = $this->router->generate($route, $routeParams, true);
        $response = new RedirectResponse($url);
        $response->setContent(
            sprintf(
                '<!DOCTYPE html><html><head></head><script>window.location.href = "%s";</script></html>',
                htmlspecialchars($url, ENT_QUOTES, 'UTF-8')
            )
        );

        return $response;
    }

    /**
     * ---------------------------------------
     * @author: contact[at]mobelite.fr
     * ---------------------------------------
     * **************** Function input: ****************
     * @param string $url
     * @param int $status
     * ---------------------------------------
     * **************** Function output: ****************
     * @return RedirectResponse
     * ---------------------------------------
     */
    public function redirectToUrl(string $url, int $status = 302): RedirectResponse
    {
        return new RedirectResponse($url, $status);
    }

    /**
     * ---------------------------------------
     * @author: contact[at]mobelite.fr
     * ---------------------------------------
     * **************** Function output: ****************
     * @return Route
     * ---------------------------------------
     */
    public function getCurrentRoute(): Route
    {
        $routeName = $this->getCurrentRouteName();
        $route = $this->router->getRouteCollection()->get($routeName);

        if (null === $route) {
            throw new NotFoundHttpException('Cannot determine current route from request');
        }

        return $route;
    }

    /**
     * ---------------------------------------
     * @author: contact[at]mobelite.fr
     * ---------------------------------------
     * **************** Function output: ****************
     * @return string
     * ---------------------------------------
     */
    public function getCurrentRouteName(): string
    {
        return (string)$this->requestHelper->getAttributesBagParam('_route');
    }

    /**
     * ---------------------------------------
     * @author: contact[at]mobelite.fr
     * ---------------------------------------
     * **************** Function output: ****************
     * @return array
     * ---------------------------------------
     */
    public function getPermissionActions()
    {
        $actions = [];

        /**
         * @var $route \Symfony\Component\Routing\Route
         */
        foreach ($this->router->getRouteCollection()->all() as $name => $route) {
            if ($route->hasOption('require_admin_permission')) {
                $options = explode('.', $route->getOption('require_admin_permission'));
                if (!array_key_exists($options[0], $actions))
                    $actions[$options[0]] = [];
                if (!in_array($options[1], $actions[$options[0]]))
                    $actions[$options[0]][] = $options[1];
            }
        }

        ksort($actions);

        return $actions;
    }
}
