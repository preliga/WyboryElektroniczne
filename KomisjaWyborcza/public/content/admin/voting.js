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

                        $.notify({
                            message: "Wybory zostały wyłączone"
                        },{
                            type: 'danger'
                        });
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

                                        $.notify({
                                            message: "Wybory zostały włączone"
                                        },{
                                            type: 'success'
                                        });
                                    });
                                });
                            });
                        });
                });

                $('.public-vote-button').on('click', function () {

                    let button = $(this);
                    let settingsTemplate = new DateTemplate('templates\\Settings');
                    settingsTemplate.call('setSettings', {
                        'alias': 'publicResult',
                        'value': 1
                    }).then(function () {
                        button.attr('disabled', true);

                        $.notify({
                            message: "Wyniki zostały opublikowane"
                        },{
                            type: 'success'
                        });
                    });
                })
            }
        };
    }
);