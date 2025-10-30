<?php
// This file is part of Moodle - https://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <https://www.gnu.org/licenses/>.

defined('MOODLE_INTERNAL') || die();

$string['pluginname'] = 'Transaction Obliterator';
$string['pageheading'] = 'Transaction Obliterator reproduction';
$string['description'] = 'Demonstrates that AJAX web service calls do not roll back database transactions when an exception is thrown.';
$string['triggerbutton'] = 'Trigger failing AJAX web service call';
$string['intentionalerror'] = 'Intentional exception from local_transactionobliterator - it is only surfaced in WS response :(';
