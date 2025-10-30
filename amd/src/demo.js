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

define(['core/ajax', 'core/notification'], function(Ajax, Notification) {
    const triggerId = 'local-transactionobliterator-trigger';
    const responseId = 'local-transactionobliterator-response';

    const setResponse = function(text) {
        const container = document.getElementById(responseId);
        if (container) {
            container.textContent = text;
        }
    };

    const callService = function() {
        setResponse('Calling AJAX service...');

        Ajax.call([
            {
                methodname: 'local_transactionobliterator_obliterate',
                args: {}
            }
        ])[0]
            .done(function() {
                setResponse('Unexpected success: the service should have thrown an exception.');
            })
            .fail(function(ex) {
                Notification.exception(ex);
                setResponse('AJAX call failed as expected. Inspect the PHP error log to confirm that no transaction rollback was logged.');
            });
    };

    return {
        init: function() {
            const trigger = document.getElementById(triggerId);
            if (!trigger) {
                return;
            }
            trigger.addEventListener('click', callService);
        }
    };
});
