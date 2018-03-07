'use strict';
define(
    [
        '/scripts/app/js/action/Base.js',
        '/scripts/lib/PigOrmJS/DataTemplate.js'
    ],
    function (Base, DateTemplate) {
        return class voting extends Base {

            initAction() {
            }

            afterRender() {
                super.afterRender();

                $('.toggle-on').on('click', function(){
                    let settingsTemplate = new DateTemplate('templates\\Settings');
                    settingsTemplate.call('setSettings', {'alias': 'votingEnable', 'value': 0});
                });

                $('.toggle-off').on('click', function(){
                    let settingsTemplate = new DateTemplate('templates\\Settings');
                    settingsTemplate.call('setSettings', {'alias': 'votingEnable', 'value': 1});
                });


            }
        };
    }
);