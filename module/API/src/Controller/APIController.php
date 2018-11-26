<?php

namespace API\Controller;

use Zend\Json\Server\Response as JsonResponse;
use Zend\Json\Server\Server as JsonServer;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\ServiceManager\ServiceManager;

class APIController extends AbstractActionController
{
    protected $api;

    public function __construct(ServiceManager $serviceManager)
    {
        $request = $serviceManager->get("Request");
        $router = $serviceManager->get("Router");
        $routeMatch = $router->match($request);
        $api_class = $serviceManager->get($routeMatch->getParams()["api_class"]);
        $this->api = $api_class;
    }

    public function endpointAction()
    {
        $server = new JsonServer();
        $server
            ->setClass($this->api)
            ->setResponse(new JsonResponse())
            ->setReturnResponse();

        /** @var JsonResponse $jsonRpcResponse */
        $jsonRpcResponse = $server->handle();

        /** @var \Zend\Http\Response $response */
        $response = $this->getResponse();

        // Do we have an empty response?
        if (! $jsonRpcResponse->isError()
            && null === $jsonRpcResponse->getId()
        ) {
            $response->setStatusCode(204);
            return $response;
        }

        // Set the content-type
        $contentType = 'application/json-rpc';
        if (null !== ($smd = $jsonRpcResponse->getServiceMap())) {
            // SMD is being returned; use alternate content type, if present
            $contentType = $smd->getContentType() ?: $contentType;
        }

        // Set the headers and content
        $response->getHeaders()->addHeaderLine('Content-Type', $contentType);
        $response->setContent($jsonRpcResponse->toJson());
        return $response;
    }
}
