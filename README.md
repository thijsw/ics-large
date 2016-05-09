# ics-large
Generate Calendar .ics-files (iCal) in PHP with a low memory footprint

This project uses [the library written by Justin Svrcek](https://github.com/jasvrcek/ICS).

This library is intended to be used if you're planning to generate large .ics-files
for which all the events cannot be stored in-memory. The library fetches the events
in batches and prints the resulting entries directly, in order to keep the memory
footprint to a minimum.

## Usage

```php
use ICS_Large\Model\Calendar;
use ICS_Large\Model\CalendarEventList;
use ICS_Large\CalendarStream;
use Jsvrcek\ICS\CalendarExport;
use Jsvrcek\ICS\Utility\Formatter;

$closure = function($offset, $size) {

  // (build array of CalendarEvent objects)

  return [];
};

$calendar = new Calendar();
$calendar->setEvents(new CalendarEventList($closure));

$export = new CalendarExport(new CalendarStream(), new Formatter());
$export->addCalendar($calendar);
echo $export->getStream();
```

## License

The MIT License (MIT)

Copyright (c) 2016 Thijs Wijnmaalen

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.