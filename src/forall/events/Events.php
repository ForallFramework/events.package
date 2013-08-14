<?php

/**
 * @package forall.events
 * @author Avaq <aldwin.vlasblom@gmail.com>
 */
namespace forall\events;

use forall\core\core\AbstractCore;

/**
 * Events class.
 */
class Events extends AbstractCore implements EventDispatcherInterface
{
  
  use EventDispatcherTraits;
  
  public function init(){}
  
}
