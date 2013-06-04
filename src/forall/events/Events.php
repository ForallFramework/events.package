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
class Events extends AbstractCore implements EventEmitterInterface
{
  
  use EventEmitterTraits;
  
  //Noop.
  public function init()
  {
  }
  
}
