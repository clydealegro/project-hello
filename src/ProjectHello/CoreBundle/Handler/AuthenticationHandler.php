<?php

namespace ProjectHello\CoreBundle\Handler;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Routing\Router;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationFailureHandlerInterface;

/**
 * This class handles the onAuthenticationSuccess and onAuthenticationFailure events of Symfony2 security
 *
 * @author Nherrisa Mae U. Celeste <nherrisa.celeste@goabroad.com>
 * @since  April 30, 2012
 */
class AuthenticationHandler implements AuthenticationSuccessHandlerInterface, AuthenticationFailureHandlerInterface
{
    private $router;
    private $security;

    /**
     * Instantiates the handler class
     *
     * @param Router          $router   Creates the Loader when the cache is empty
     * @param SecurityContext $security Gives access to the token representing the current user authentication
     */
    public function __construct(Router $router, SecurityContext $security)
    {
        $this->router = $router;
        $this->security = $security;
    }

    /**
     * This is called when an interactive authentication attempt succeeds
     *
     * @param Request        $request Represents an HTTP request
     * @param TokenInterface $token   The interface for the user authentication information
     *
     * @return Response or RedirectResponse
     */
    public function onAuthenticationSuccess(Request $request, TokenInterface $token)
    {
        $urlRoute = 'dashboard';

        $url = $this->router->generate($urlRoute);

        if ($request->isXmlHttpRequest()) {
            $response = new Response(json_encode(array('success' => true, 'url' => $url)));
            $response->headers->set('Content-Type', 'application/json');

            return $response;
        } else {
            return new RedirectResponse($url);
        }
    }

    /**
     * This is called when an interactive authentication attempt fails
     *
     * @param Request                 $request   Represents an HTTP request
     * @param AuthenticationException $exception The base class for all authentication exceptions
     *
     * @return Response or RedirectResponse
     */
    public function onAuthenticationFailure(Request $request, AuthenticationException $exception)
    {
        $error = $exception->getMessage();

        if ($request->isXmlHttpRequest()) {
            $response = new Response(json_encode(array('success' => false, 'error' => $error)));
            $response->headers->set('Content-Type', 'application/json');

            return $response;
        } else {
            $request->getSession()->setFlash('error', $error);
            $url = $this->router->generate('homepage');

            return new RedirectResponse($url);
        }
    }
}