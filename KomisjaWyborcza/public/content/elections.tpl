<form action="vote?sessionToken={$sessionToken}" method="post">

    {foreach from=$candidates item=candidate name=loop}

        {if $smarty.foreach.loop.index % 2 == 0}
            <div class="row">
        {/if}
        <div class="col">
            <div class="form-check bg-faded p-4 my-4">
                <input class="form-check-input vertical-center" name="candidateId" value="{$candidate->id}" type="radio" id="radio_{$candidate->id}">
                <label class="form-check-label" for="radio_{$candidate->id}">
                    <div class="row">
                        <div class="col-4">
                            <img src="/images/candidate_photo/{$candidate->photo}" height="100"/>
                        </div>
                        <div class="col-8 text-center">
                            {$candidate->name} {$candidate->secondName} <strong> {$candidate->lastName} </strong>
                            <br>
                            <div class="text-center"> [ {$candidate->electionCommittee} ] </div>
                        </div>
                    </div>
                </label>
            </div>
        </div>
        {if $smarty.foreach.loop.index % 2 == 1}
            </div>
        {/if}
    {/foreach}

        <div class="col">
            <div class="form-check bg-faded p-4 my-4">
                <input class="form-check-input vertical-center" name="candidateId" value="0" type="radio" id="radio_0">
                <label class="form-check-label" for="radio_0">
                    <div class="row">
                        <div class="col-4">
                            <img src="/images/candidate_photo/empty.jpg" height="100" width="100"/>
                        </div>
                        <div class="col-8 text-center">
                            Nieważny głos
                        </div>
                    </div>
                </label>
            </div>
        </div>
    </div>

    <div class="text-center">
        <button class="btn btn-primary" type="submit">Wyślij głos</button>
    </div>
</form>