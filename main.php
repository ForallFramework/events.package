<?php namespace forall\events;

use \forall\loader\AbstractLoader;

class Loader extends AbstractLoader
{
  
  /**
   * Return an array of packages that need to be loaded before this one.
   *
   * @return array
   */
  public static function getDependencies()
  {
    
    return [];
    
  }
  
  /**
   * Load the events package.
   *
   * @return void
   */
  public static function load()
  {
    
    //Get the core.
    $core = forall('core');
    
    //Get the events instance.
    $events = Events::getInstance();

    //Register the instance with the core.
    $core->registerInstance('events', $events);

    //Initialize the instance, calling it's `init` method.
    $core->initializeInstance($events);
    
  }
  
}
