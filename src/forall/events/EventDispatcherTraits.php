<?php

/**
 * @package forall.events
 * @author Avaq <aldwin.vlasblom@gmail.com>
 */
namespace forall\events;

use forall\debug\exceptions\InvalidArgumentException;

/**
 * Event dispatcher traits.
 */
trait EventDispatcherTraits
{
  
  /**
   * Contains all added event listeners.
   * @var array
   */
  protected $listeners = [];
  
  /**
   * Add an event listener.
   *
   * @param string $name The name of the event.
   * @param callable $listener The callback that will execute once the event is triggered.
   *
   * @return self Chaining enabled.
   */
  public function on($name, callable $listener)
  {
    
    //Must be string.
    if(!is_string($name)){
      throw new InvalidArgumentException('Expecting $name to be of type string. %s given.', uctype($name));
    }
    
    //Add a new container for this event name?
    if(!array_key_exists($name, $this->listeners)){
      $this->listeners[$name] = [];
    }
    
    //Add the new listener to the container.
    $this->listeners[$name][] = $listener;
    
    //Enable chaining.
    return $this;
    
  }
  
  /**
   * Add an event listener that will be removed after the first time it is triggered.
   *
   * @param string $name The name of the event.
   * @param callable $listener The callback that will execute once the event is triggered.
   *
   * @return self Chaining enabled.
   */
  public function once($name, callable & $listener)
  {
    
    //Store the old listener.
    $actual = $listener;
    
    //Create a new listener that will only fire once.
    $listener = function()use(&$listener, $name, $actual){
      $this->no($name, $listener);
      return call_user_func_array($actual, func_get_args());
    };
    
    //Register the new listener.
    $this->on($name, $listener);
    
    //Enable chaining.
    return $this;
    
  }
  
  /**
   * Trigger an event, causing the callbacks listening to it to be executed.
   *
   * #TODO: Explain the propagation.
   *
   * @param string $name The name of the event.
   * @param array $arguments The arguments to pass to every listener.
   *
   * @return self Chaining enabled.
   */
  public function trigger($name, array $arguments = [])
  {
    
    //Must be string.
    if(!is_string($name)){
      throw new InvalidArgumentException('Expecting $name to be of type string. %s given.', uctype($name));
    }
    
    //Create the event object for this trigger.
    $event = new Event($name, $this);
    
    //Break the name into levels.
    $levels = explode(':', $name);
    
    //Iterate the levels in reverse.
    for($i = count($levels); $i > 0; $i--)
    {
      
      //Build a name for this level.
      $lname = implode(':', array_slice($levels, 0, $i));
      
      //Get listeners by this name.
      $listeners = array_reverse($this->listeners[$lname]);
      
      //Iterate listeners.
      foreach($listeners as $listener)
      {
        
        //Make arguments and call the listener with them. Send to return value to the event.
        $event->setReturnValue(call_user_func_array($listener, array_merge([$event], $arguments)));
        
        //Stop?
        if($event->isImmediatePropagationStopped()){
          break;
        }
        
      }
      
      //Stop?
      if($event->isPropagationStopped()){
        break;
      }
      
    }
    
    //Enable chaining.
    return $this;
    
  }
  
  /**
   * Return all listeners, optionally filtered by event name.
   *
   * @param string $name The optional name to filter the results.
   * @param boolean $includeSubListeners Whether to include sub-events of the given event filter.
   *
   * @return callable[]
   */
  public function listeners($name = null, $includeSubListeners = false)
  {
    
    //Create an output array.
    $result = [];
    
    //Iterate listeners.
    foreach($this->listeners as $key => $listeners)
    {
      
      //No filter?
      if(is_null($name)){
        array_merge($result, $listeners);
      }
      
      //The name matches the key?
      elseif(!$includeSubListeners && $name === $key){
        array_merge($result, $listeners);
      }
      
      //The name matches the first portion of the key?
      elseif(strpos($key, $name) === 0){
        array_merge($result, $listeners);
      }
      
    }
    
    //Return the result.
    return $result;
    
  }
  
  /**
   * Removes listeners.
   *
   * Any of the parameters can be given to filter the matching events. You could for
   * for instance only give a listener, in which case all event listeners that use that
   * particular callable would be removed.
   *
   * @param string $name Optionally remove events only with the given name.
   * @param callable $listener Optionally remove events only with the given listener.
   * @param boolean $includeSubListeners Optionally remove all sub-events of the given event name.
   *
   * @return self Chaining enabled.
   */
  public function no($name = null, callable $listener = null, $includeSubListeners = false)
  {
    
    //Iterate listeners.
    foreach($this->listeners as $key => $listeners)
    {
      
      //Break on a mismatch in name?
      if(!is_null($name) && ($includeSubListeners ? strpos($key, $name) !== 0 : $name !== $key)){
        continue;
      }
      
      //Break on a mismatch in listener?
      if(!is_null($listener) && ($index = array_search($listener, $listeners)) === false){
        continue;
      }
      
      //Break on non-existent key?
      if(!array_key_exists($this->listeners, $key)){
        continue;
      }
      
      //Unset specific listener?
      if(isset($index)){
        unset($this->listeners[$key][$index]);
        continue;
      }
      
      //Unset entire container.
      unset($this->listeners[$key]);
      
    }
    
    //Enable chaining.
    return $this;
    
  }
  
}
