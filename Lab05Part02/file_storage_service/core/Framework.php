<?php

namespace Core;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Controller\ArgumentResolver;
use Symfony\Component\HttpKernel\Controller\ControllerResolver;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\Matcher\UrlMatcher;

class Framework
{
    public function __construct(
        private UrlMatcher $matcher,
        private ControllerResolver $controllerResolver,
        private ArgumentResolver $argumentResolver,
    ) {
    }

    public function handle(Request $request): Response
    {
        $this->matcher->getContext()->fromRequest($request);

        try {
            $request->attributes->add($this->matcher->match($request->getPathInfo()));

            $controller = $this->controllerResolver->getController($request);
            $arguments = $this->argumentResolver->getArguments($request, $controller);

            return call_user_func_array($controller, $arguments);
        } catch (ResourceNotFoundException) {
            return new Response('Not Found', 404);
        } catch (\Exception $e) {
            return new Response('An error occurred: ' . $e->getMessage() . '.' . $e->getTraceAsString(), 500);
        }
    }
}