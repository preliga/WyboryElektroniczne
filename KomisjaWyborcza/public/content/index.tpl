
<div class="row text-center">

    <div class="col-sm-3"></div>

    {if $votingEnable == 1}
        <div class="col-sm-6 div-box" link="/elections">
            <img src="/images/wybory.jpg" width="50%"/>
            <br>
            <span> Głosuj </span>
        </div>
    {else}
        <div class="col-sm-6 div-box" link="/results">
            <img src="/images/wyniki.jpg" width="50%"/>
            <br>
            <span> Wyniki </span>
        </div>
    {/if}

    <div class="col-sm-3"></div>
</div>