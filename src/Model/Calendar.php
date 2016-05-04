<?php

namespace ICS_Large\Model;

class Calendar extends \Jsvrcek\ICS\Model\Calendar {

  /**
   * @var CalendarEventList
   */
  private $events_list;

  /**
   * Provide an Iterator that yields Jsvrcek\ICS\Model\CalendarEvent objects
   *
   * @param CalendarEventList $events_list
   * @return static
   */
  public function setEvents(CalendarEventList $events_list) {
    $this->events_list = $events_list;
    return $this;
  }

  /**
   * Return events using Iterator
   *
   * Note: this changes signature of parent method
   *
   * @return CalendarEventList
   */
  public function getEvents()
  {
    return $this->events_list;
  }

}