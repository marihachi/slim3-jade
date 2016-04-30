<?php

namespace Slim\Views;

use \Psr\Http\Message\ResponseInterface;

class JadeRenderer
{
	public function __construct($path = './views')
    {
		$this->internalRenderer = new \Tale\Jade\Renderer();
		$this->addPath($path);
    }

	private $internalRenderer;

	public function addPath($dirPath)
	{
		$this->internalRenderer->addPath($dirPath);
	}

	public function fetch($templateName, array $data = [])
	{
		$source = $this->internalRenderer->render($templateName, $data);
		
		return $source;
	}

	public function render(ResponseInterface $response, $templateName, array $data = [])
	{
		$source = $this->fetch($templateName, $data);

		$body = $response->getBody();
		$body->write($source);
		
		return $response->withBody($body);
	}
}
