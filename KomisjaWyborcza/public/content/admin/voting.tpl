<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

<div class="row">
    <div class="checkbox col-sm-6">
        <label style="margin-left: 20px;">
            <input {if {$votingEnable} == 1} checked {/if} data-toggle="toggle" data-onstyle="success" data-offstyle="danger" type="checkbox">
            Wybory
        </label>
    </div>

    <div class="checkbox col-sm-6">
        <label style="margin-left: 20px;">

            <a class="btn btn-danger" href="/admin/downloadValidTokens">Eksportuj nieważne głosy</a>
        </label>
    </div>
</div>

