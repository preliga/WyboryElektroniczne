'use strict';
define(
    [
        '/scripts/lib/PigFrameworkJS/Action.js'
    ],
    function (Action) {
        return class Base extends Action {

            afterRender() {
                datePickerInit();

                baseEvents();
            }
        };

        function baseEvents() {
            $('.home-link').on('click', function(){
                window.location = '/';
            });
        }

        function datePickerInit() {
            /**
             * Datepicker init
             */
            $('.datetimepicker').datetimepicker({
                format: 'Y-m-d H:i'
            });
        }
    });