<?php

require '../vendor/autoload.php';

date_default_timezone_set('Europe/Amsterdam');

use ICS_Large\Model\Calendar;
use ICS_Large\Model\CalendarEventList;
use ICS_Large\CalendarStream;
use Jsvrcek\ICS\CalendarExport;
use Jsvrcek\ICS\Utility\Formatter;

define('NUMBER_OF_DUMMY_ITEMS', 250);

/**
 * Generate dummy list of CalendarEvents
 *
 * @return \Jsvrcek\ICS\Model\CalendarEvent[]
 */
function build_dummy_events($offset, $size) {
  $num = min($size, NUMBER_OF_DUMMY_ITEMS - $offset);
  return array_fill(0, $num, (new \Jsvrcek\ICS\Model\CalendarEvent())
    ->setSummary('Item summary')
    ->setStart(new \DateTime())
    ->setEnd((new \DateTime())->modify('+2 hours'))
  );
};

$closure = function($offset, $size) {

  // Real scenario might look like:

  // 1. Query for events, e.g.:
  // SELECT * FROM events WHERE ... LIMIT {$size} OFFSET {$offset}

  // 2. Build array of CalendarEvent objects
  // while ($row = next(...)) { }

  return build_dummy_events($offset, $size);
};

$calendar = new Calendar();
$calendar->setEvents(new CalendarEventList($closure));

$export = new CalendarExport(new CalendarStream(), new Formatter());
$export->addCalendar($calendar);
echo $export->getStream();