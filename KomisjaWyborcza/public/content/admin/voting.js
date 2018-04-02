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

                $('.toggle-on').on('click', function () {
                    let settingsTemplate = new DateTemplate('templates\\Settings');
                    settingsTemplate.call('setSettings', {
                        'alias': 'votingEnable', 'value': 0
                    }).then(function () {
                        $('.download-valid-tokens').show();
                    });
                });

                $('.toggle-off').on('click', function () {
                    let settingsTemplate = new DateTemplate('templates\\Settings');
                    settingsTemplate.call('setSettings', {'alias': 'votingEnable', 'value': 1})
                        .then(function () {
                            settingsTemplate.call('setSettings', {
                                'alias': 'importTokenList',
                                'value': 0
                            }).then(function () {
                                settingsTemplate.call('setSettings', {
                                    'alias': 'decryptVote',
                                    'value': 0
                                }).then(function () {
                                    settingsTemplate.call('setSettings', {
                                        'alias': 'publicResult',
                                        'value': 0
                                    }).then(function () {
                                        $('.buttons').hide();
                                    });
                                });
                            });
                        });


                });
            }
        };
    }
);