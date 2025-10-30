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

namespace local_transactionobliterator\external;

use core_external\external_api;
use core_external\external_function_parameters;
use core_external\external_value;
use context_system;
use moodle_exception;

/**
 * External function that demonstrates the missing transaction rollback in ajax/service.php.
 */
class obliterate extends external_api {

    /**
     * No parameters required.
     *
     * @return external_function_parameters
     */
    public static function execute_parameters(): external_function_parameters {
        return new external_function_parameters([]);
    }

    /**
     * Start a delegated transaction, touch the database, and throw without rollback.
     *
     * @return string never actually returns because an exception is thrown.
     */
    public static function execute(): string {
        global $DB, $USER;

        self::validate_parameters(self::execute_parameters(), []);
        self::validate_context(context_system::instance());

        $transaction = $DB->start_delegated_transaction();

        // Touch the database so there is work to commit if the transaction is not rolled back.
        $DB->insert_record('user_preferences', (object) [
            'userid' => $USER->id,
            'name' => 'local_transactionobliterator_' . microtime(true),
            'value' => 'pending',
        ]);
        throw new moodle_exception('intentionalerror', 'local_transactionobliterator');
        $transaction->allow_commit();

        return '齐天大圣驾到！';
    }

    /**
     * Return structure definition.
     *
     * @return external_value
     */
    public static function execute_returns(): external_value {
        return new external_value(PARAM_TEXT, 'Never returned because the function always throws.');
    }
}
