<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

<div class="row">
    <div class="checkbox col-sm-3">
        <label style="margin-left: 20px;">
            <input {if $settings->votingEnable == 1} checked {/if} data-toggle="toggle" data-onstyle="success" data-offstyle="danger" type="checkbox">
            Wybory
        </label>
    </div>

    <div class="download-valid-tokens buttons col-sm-3" {if $settings->votingEnable == 1} style="display: none;" {/if}>
        <label style="margin-left: 20px;">
            <a class="btn btn-warning" href="/admin/voting/downloadValidTokens">Eksportuj nieważne głosy</a>
        </label>
    </div>

    <div class="decrypt-vote buttons col-sm-3" {if $settings->importTokenList == 0} style="display: none;" {/if}>
        <label style="margin-left: 20px;">
            <a class="btn btn-warning" href="/admin/voting/decryptVotes">Odszyfruj głosy</a>
        </label>
    </div>

    <div class="public-vote buttons col-sm-3" {if $settings->decryptVote == 0} style="display: none;" {/if}>
        <label style="margin-left: 20px;">
            <button class="btn btn-success public-vote-button">Opublikuj wyniki</button>
        </label>
    </div>
</div>

