<?php

namespace ICS_Large\Model;

/**
 * List of CalendarEvent items that is build using
 * batched retrieved by a specified Closure
 *
 * @package ICS_Large\Model
 */
class CalendarEventList implements \Iterator {

  /**
   * Default batch size
   */
  const BATCH_SIZE = 1000;

  /**
   * @var int
   */
  protected $batch_size;

  /**
   * @var int
   */
  protected $key = 0;

  /**
   * @var array
   */
  protected $batch = [];

  /**
   * @var \Closure
   */
  protected $provider;

  /**
   * Provide a \Closure that yields data for this \Iterator
   *
   * The \Closure will be called with $offset and $size arguments
   * and this \Iterator expects it to return an array of
   * CalendarEvent objects (or Iterator that can be converted to array)
   *
   * @param \Closure $provider
   * @param int $batch_size
   */
  public function __construct(\Closure $provider, $batch_size = self::BATCH_SIZE) {
    $this->provider = $provider;
    if (is_int($batch_size)) {
      $this->batch_size = $batch_size;
    }
  }

  public function current() {
    return current($this->batch);
  }

  public function key() {
    return $this->key;
  }

  public function next() {
    array_shift($this->batch);
    $this->key++;
  }

  public function rewind() {
    $this->key = 0;
    $this->batch = [];
  }

  public function valid() {
    if (count($this->batch) < 1) {
      $this->batch = $this->provider->__invoke($this->key, $this->batch_size);
      if ($this->batch && $this->batch instanceof \Traversable) {
        $this->batch = iterator_to_array($this->batch);
      }
    }
    return count($this->batch) > 0;
  }

}