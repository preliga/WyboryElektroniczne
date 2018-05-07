'use strict';
define(
    [
        '/scripts/app/js/action/Base.js',
        '/scripts/lib/PigOrmJS/DataTemplate.js'
    ],
    function (Base, DateTemplate) {

        let currentPage = 1;
        let currentWhere = {};
        let pageSize = 5;

        return class results extends Base {

            initAction() {
            }

            afterRender() {
                super.afterRender();

                events();
                generateTable();
            }
        };

        function events() {
            $('.search-button').on('click', function () {
                let token = $("#token").val();

                currentPage = 1;

                currentWhere = {};
                if (token !== "") {
                    currentWhere = {'token like ?': "%" + token + "%"};
                }

                generateTable();
            });

            $("#token").on('keydown', function (event) {
                if (event.keyCode === 13) {
                    $('.search-button').click();
                }
            });


            $(".pagination").on('click', 'li', function () {
                // console.log($(this).attr('page'));
                currentPage = $(this).attr('page');
                generateTable();
            });
        }

        function generateTable() {

            $(".votesList tbody>tr").remove();
            $(".pagination li").remove();
            $(".loader").show();

            let voteTemplate = new DateTemplate('templates\\vote\\VoteJoinCandidate');

            voteTemplate.count("*", currentWhere).then(function (amountRecords) {

                let amountPage = amountRecords / pageSize;

                if (amountRecords % pageSize !== 0) {
                    amountPage++;
                }

                for (let i = 1; i < amountPage; i++) {
                    let li = "<li page='{page}'><a href='#'>{page}</a></li>";

                    li = li
                        .replace('{page}', i)
                        .replace('{page}', i);

                    $('.pagination').append(li);
                }


                voteTemplate
                    .find(currentWhere, null, null, pageSize, (currentPage - 1) * pageSize)
                    .then(function (votes) {

                        $(".loader").hide();

                        if (votes.collection.length !== 0) {
                            votes.collection.forEach(function (item, index) {

                                let tr = "<tr><td>{lp}</td></td><td>{token}</td><td>{candidate}</td><td>{committee}</td></tr>";

                                tr = tr
                                    .replace('{lp}', (currentPage - 1) * pageSize + index + 1)
                                    .replace('{token}', item.token)
                                    .replace('{candidate}', item.name + " " + item.lastName)
                                    .replace('{committee}', item.electionCommittee);

                                $('.votesList').append(tr);
                            });
                        } else {
                            let tr = "<tr><td colspan='4'>Brak szukanego tokenu</td></tr>";
                            $('.votesList').append(tr);
                        }
                    });
            });


        }
    }
);