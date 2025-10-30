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

require(__DIR__ . '/../../config.php');

require_login();

$context = context_system::instance();
require_capability('moodle/site:config', $context);

$PAGE->set_context($context);
$PAGE->set_url(new moodle_url('/local/transactionobliterator/index.php'));
$PAGE->set_pagelayout('admin');
$PAGE->set_title(get_string('pluginname', 'local_transactionobliterator'));
$PAGE->set_heading(get_string('pageheading', 'local_transactionobliterator'));

$PAGE->requires->js_call_amd('local_transactionobliterator/demo', 'init');

echo $OUTPUT->header();

echo $OUTPUT->heading(get_string('pageheading', 'local_transactionobliterator'));
echo html_writer::tag('p', get_string('description', 'local_transactionobliterator'));

$button = html_writer::tag('button', get_string('triggerbutton', 'local_transactionobliterator'), [
    'type' => 'button',
    'id' => 'local-transactionobliterator-trigger',
    'class' => 'btn btn-primary'
]);

echo html_writer::div($button);
echo html_writer::div('', '', ['id' => 'local-transactionobliterator-response']);

echo $OUTPUT->footer();
