<?php

/**
 * @package forall.events
 * @author Avaq <aldwin.vlasblom@gmail.com>
 */
namespace forall\events;

/**
 * Event class.
 *
 * An instance of this class is created for every event that is fired, and bubbles along
 * the event propagation.
 */
class Event
{
  
  //Defines levels of propagation.
  const PROPAGATE_NONE = 0;
  const PROPAGATE_IMMEDIATE = 1;
  const PROPAGATE_LEVELS = 2;
  const PROPAGATE_STATIC = 3;
  
  /**
   * Holds the name of the event.
   * @var string
   */
  protected $name;
  
  /**
   * Contains the dispatcher that fired this event.
   * @var EventDispatcherInterface
   */
  protected $dispatcher;
  
  /**
   * Contains the currently used propagation level.
   *
   * Possible values are: `Event::PROPAGATE_NONE`, `Event::PROPAGATE_IMMEDIATE`,
   * `Event::PROPAGATE_LEVELS` and `Event::PROPAGATE_STATIC`.
   *
   * @var integer
   */
  protected $propagation = self::PROPAGATE_LEVELS;
  
  /**
   * @param string $name The name of the event.
   * @param EventDispatcherInterface $dispatcher The dispatcher that fired the event.
   * @param integer $propagation Optionally set the propagation level. Defaults to levels.
   */
  public function __construct(
    $name, EventDispatcherInterface $dispatcher, $propagation = self::PROPAGATE_LEVELS
  ){
    
    $this->name = $name;
    $this->dispatcher = $dispatcher;
    $this->propagation = $propagation;
    
  }
  
  /**
   * Return the name of this event.
   *
   * @return string
   */
  public function getName()
  {
    
    return $this->name;
    
  }
  
  /**
   * Return the dispatcher that fired this event.
   *
   * @return EventDispatcherInterface
   */
  public function getDispatcher()
  {
    
    return $this->dispatcher;
    
  }
  
  /**
   * Prevents any further propagation.
   *
   * @return self Chaining enabled.
   */
  public function stopImmediatePropagation()
  {
    
    //Don't propagate any more.
    $this->propagation = self::PROPAGATE_NONE;
    
    //Enable chaining.
    return $this;
    
  }
  
  /**
   * Prevent propagation through to the next event-level.
   *
   * @return self Chaining enabled.
   */
  public function stopPropagation()
  {
    
    //No higher than immediate propagation.
    if($this->propagation > self::PROPAGATE_IMMEDIATE){
      $this->propagation = self::PROPAGATE_IMMEDIATE;
    }
    
    //Enable chaining.
    return $this;
    
  }
  
  /**
   * Prevent propagation through to the static class.
   *
   * @return self Chaining enabled.
   */
  public function stopStaticPropagation()
  {
    
    //No higher than instance propagation.
    if($this->propagation > self::PROPAGATE_LEVELS){
      $this->propagation = self::PROPAGATE_LEVELS;
    }
    
    //Enable chaining.
    return $this;
    
  }
  
  /**
   * Returns true if all propagation is stopped.
   *
   * @return boolean
   */
  public function isImmediatePropagationStopped()
  {
    
    return $this->propagation == self::PROPAGATE_NONE;
    
  }
  
  /**
   * Returns true if propagation level is no higher than immediate.
   *
   * @return boolean
   */
  public function isPropagationStopped()
  {
    
    return $this->propagation <= self::PROPAGATE_IMMEDIATE;
    
  }
  
  /**
   * Returns true if propagation level is no higher than instance.
   *
   * @return boolean
   */
  public function isStaticPropagationStopped()
  {
    
    return $this->propagation <= self::PROPAGATE_LEVELS;
    
  }
  
}
