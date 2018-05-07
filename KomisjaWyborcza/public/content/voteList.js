'use strict';
define(
    [
        '/scripts/app/js/action/Base.js',
        '/scripts/lib/PigOrmJS/DataTemplate.js'
    ],
    function (Base, DateTemplate) {
        return class results extends Base {

            initAction() {
            }

            afterRender() {
                super.afterRender();

                events();

                generateTable({});
            }
        };

        function events() {
            $('.search-button').on('click', function () {
                let token = $("#token").val();
                let where = {};
                console.log(token);
                if (token !== "") {
                    where = {'token like ?': "%" + token + "%"};
                }

                generateTable(where);
            });
        }

        function generateTable(where) {

            $(".votesList tbody>tr").remove();

            let voteTemplate = new DateTemplate('templates\\vote\\VoteJoinCandidate');

            voteTemplate
                .find(where)
                .then(function (votes) {
                    votes.collection.forEach(function (item, index) {

                        let tr = "<tr><td>{token}</td><td>{candidate}</td><td>{committee}</td></tr>";

                        tr = tr
                            .replace('{token}', item.token)
                            .replace('{candidate}', item.name + " " + item.lastName)
                            .replace('{committee}', item.electionCommittee);

                        $('.votesList').append(tr);
                    });
                });
        }
    }
);