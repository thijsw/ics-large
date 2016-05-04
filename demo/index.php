<?php

require '../vendor/autoload.php';

date_default_timezone_set('Europe/Amsterdam');

use ICS_Large\Model\Calendar;
use ICS_Large\Model\CalendarEventList;
use ICS_Large\CalendarStream;
use Jsvrcek\ICS\CalendarExport;
use Jsvrcek\ICS\Utility\Formatter;

$closure = function($offset, $size) {
  // Build array of CalendarEvent objects

  switch ($offset) {
    case 0:
      $items = [];

      $event = new \Jsvrcek\ICS\Model\CalendarEvent();
      $event->setSummary('Bla bla bla');
      $event->setStart(new DateTime());
      $event->setEnd((new DateTime())->modify('+2 hours'));

      $items[] = $event;
      return $items;
  }

  return [];
};

$calendar = new Calendar();
$calendar->setEvents(new CalendarEventList($closure));

$export = new CalendarExport(new CalendarStream(), new Formatter());
$export->addCalendar($calendar);
echo $export->getStream();