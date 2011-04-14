<?php

namespace Versionable\Highway\Browser;

use Versionable\Highway\History\HistoryInterface;

use Versionable\Prospect\Client\ClientInterface;
use Versionable\Prospect\Request\RequestInterface;
use Versionable\Prospect\Response\ResponseInterface;

use Versionable\Highway\History\Entry;

class Browser implements BrowserInterface
{
  protected $client = null;
  
  protected $history = null;
  
  protected $session = null;

  public function __construct(ClientInterface $client, HistoryInterface $history)
  {
    $this->setClient($client);
    $this->setHistory($history);
  }
  
  public function get(RequestInterface $request, ResponseInterface $response)
  {
    $request->setMethod('GET');
    
    return $this->callAndAddToHistory($request, $response);
  }
  
  public function post(RequestInterface $request, ResponseInterface $response)
  {
    $request->setMethod('POST');
    
    return $this->callAndAddToHistory($request, $response);
  }
  
  public function put(RequestInterface $request, ResponseInterface $response)
  {
    $request->setMethod('PUT');
    
    return $this->callAndAddToHistory($request, $response);
  }
  
  public function delete(RequestInterface $request, ResponseInterface $response)
  {
    $request->setMethod('DELETE');
    
    return $this->callAndAddToHistory($request, $response);
  }
  
  public function call(RequestInterface $request, ResponseInterface $response)
  {   
    echo $request->getUrl()->toString() . "\n";
    
    return $this->getClient()->send($request, $response);
  }
  
  public function back()
  {
    $entry = $this->getHistory()->back();
    
    return $this->call($entry->getRequest(), $this->getNewResonseObject($entry->getResponse()));
  }
  
  public function forward()
  {
    $entry = $this->getHistory()->forward();
    
    return $this->call($entry->getRequest(), $this->getNewResonseObject($entry->getResponse()));
  }
  
  public function go($relative)
  {
    $entry = $this->getHistory()->go($relative);
    
    return $this->call($entry->getRequest(), $this->getNewResonseObject($entry->getResponse()));
  }
  
  public function reload()
  {
    return $this->go(0);
  }


  public function getClient()
  {
    return $this->client;
  }

  public function setClient(ClientInterface $client)
  {
    $this->client = $client;
  }

  public function getHistory()
  {
    return $this->history;
  }

  public function setHistory(HistoryInterface $history)
  {
    $this->history = $history;
  }
  
  /*public function getSession()
  {
    return $this->session;
  }

  public function setSession($session) 
  {
    $this->session = $session;
  }*/
  
  protected function callAndAddToHistory(RequestInterface $request, ResponseInterface $response)
  {
    $this->history->add(new Entry($request, $response));
    
    return $this->call($request, $response);    
  }
  
  protected function getNewResonseObject(ResponseInterface $response)
  {
    $class = \get_class($response);
    
    return new $class();
  }
}
