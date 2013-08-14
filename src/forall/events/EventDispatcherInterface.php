<?php

/**
 * @package forall.events
 * @author Avaq <aldwin.vlasblom@gmail.com>
 */
namespace forall\events;

/**
 * Event dispatcher interface.
 */
interface EventDispatcherInterface
{
  
  /**
   * Add an event listener.
   *
   * @param string $event The name of the event.
   * @param callable $listener The callback that will execute once the event is triggered.
   *
   * @return self Chaining enabled.
   */
  public function on($event, callable $listener);
  
  /**
   * Add an event listener that will be removed after the first time it is triggered.
   *
   * @param string $event The name of the event.
   * @param callable $listener The callback that will execute once the event is triggered.
   *
   * @return self Chaining enabled.
   */
  public function once($event, callable $listener);
  
  /**
   * Trigger an event, causing the callbacks listening to it to be executed.
   *
   * @param string $event The name of the event.
   *
   * @return self Chaining enabled.
   */
  public function trigger($event);
  
  /**
   * Return all listeners, optionally filtered by event name.
   *
   * @param string $event The optional name to filter the results.
   * @param boolean $includeSubListeners Whether to include sub-events of the given event filter.
   *
   * @return callable[]
   */
  public function listeners($event = null, $includeSubListeners = false);
  
  /**
   * Removes listeners.
   * 
   * Any of the parameters can be given to filter the matching events. You could for
   * for instance only give a listener, in which case all event listeners that use that
   * particular callable would be removed.
   *
   * @param string $event Optionally remove events only with the given name.
   * @param callable $listener Optionally remove events only with the given listener.
   * @param boolean $includeSubListeners Optionally remove all sub-events of the given event name.
   *
   * @return self Chaining enabled.
   */
  public function no($event = null, callable $listener = null, $includeSubListeners = false);
  
}
