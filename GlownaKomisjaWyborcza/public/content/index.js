'use strict';
define(
    [
        '/scripts/app/js/action/Base.js',
        '/scripts/lib/PigOrmJS/DataTemplate.js',
        '/scripts/app/js/model/ORMConfig.js'
    ],
    function (Base, DateTemplate, ORMConfig) {
        return class index extends Base {

            initAction() {

            }

            afterRender() {
                super.afterRender();

                // console.log(ORMConfig);
                // console.log(ORMConfig.Movie);

                let movieTemplate = new DateTemplate('Movie');

                // movieTemplate.find()
                //     .then(function (collection) {
                //         // console.log(collection);
                //
                //         collection.reload()
                //             .then(function () {
                //                 console.log(collection);
                //             });
                //
                //         console.log(collection.collection[0]);
                //     });

                movieTemplate.find({'m.id = ?': 4})
                    .then(function (collection1) {

                        movieTemplate.find({'m.id = ?': 6})
                            .then(function (collection2) {
                                console.log(collection2);


                                collection1.marge(collection2);

                            });

                        console.log(collection1);
                    });
                //
                // movieTemplate.findOne()
                //     .then(function (record) {
                //         console.log(record);
                //     });
                //
                // movieTemplate.get(4)
                //     .then(function (record) {
                //         console.log(record);
                //     });
                //
                // movieTemplate.sum('m.id')
                //     .then(function (amount) {
                //         console.log(amount);
                //     });
                //
                // movieTemplate.exists({'m.id = ?': 4})
                //     .then(function (exists) {
                //         console.log(exists);
                //     });
            }
        };
    }
);