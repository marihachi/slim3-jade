<?php

namespace Slim\Views;

use \Psr\Http\Message\ResponseInterface;

class Jade
{
	public function __construct($templatePath = null)
    {
		$this->internalRenderer = new \Tale\Jade\Renderer();
		
		if (isset($templatePath))
			$this->addPath($templatePath);
    }

	private $internalRenderer;

	public function addPath($dirPath)
	{
		$this->internalRenderer->addPath($dirPath);
	}

	public function render(ResponseInterface $response, $templateName, array $data = [])
	{
		$output = $this->internalRenderer->render($templateName, $data);

		$body = $response->getBody();
		$body->write($output);
		return $response->withBody($body);
	}
}
