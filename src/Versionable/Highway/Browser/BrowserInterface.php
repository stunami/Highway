<?php

namespace Versionable\Highway\Browser;

use Versionable\Prospect\Client\ClientInterface;
use Versionable\Prospect\Request\RequestInterface;
use Versionable\Prospect\Response\ResponseInterface;
use Versionable\Highway\History\HistoryInterface;

interface BrowserInterface
{
  public function get(RequestInterface $request, ResponseInterface $response);
  
  public function post(RequestInterface $request, ResponseInterface $response);
  
  public function put(RequestInterface $request, ResponseInterface $response);
  
  public function delete(RequestInterface $request, ResponseInterface $response);
  
  public function call(RequestInterface $request, ResponseInterface $response);
  
  public function back();
  
  public function forward();
  
  public function go($relative);
  
  public function reload();
  
  public function getClient();
  
  public function setClient(ClientInterface $client);
  
  public function getHistory();

  public function setHistory(HistoryInterface $history);
  
  /*public function getSession();
  
  public function setSession();*/
}
