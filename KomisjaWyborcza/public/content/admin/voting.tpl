<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

<div class="checkbox" style="margin-left: 10px;">
    <label>
        <input {if {$votingEnable} == 1} checked {/if} data-toggle="toggle" data-onstyle="success" data-offstyle="danger" type="checkbox">
        Wybory
    </label>
</div>