<?php

namespace ICS_Large;

/**
 * CalendarStreams that will output every item as
 * soon at it is being added in order to save memory
 *
 * @package ICS_Large
 */
class CalendarStream extends \Jsvrcek\ICS\CalendarStream
{

  /**
   * @param string $item
   * @return void
   */
  public function addItem($item)
  {
    parent::addItem($item);
    echo $this;
    $this->reset();
    return $this;
  }

}