<?php

/**
 * @package forall.events
 * @author Avaq <aldwin.vlasblom@gmail.com>
 */
namespace forall\events;

use forall\core\core\AbstractCore;
use \forall\core\singleton\SingletonTraits;

/**
 * Events class.
 */
class Events extends AbstractCore implements EventDispatcherInterface
{
  
  use EventDispatcherTraits;
  use SingletonTraits;
  
  public function init(){}
  
}
