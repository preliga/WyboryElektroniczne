<form class="needs-validation" novalidate>


    <!--Radio group-->
    <div class="form-check">
        <input class="form-check-input" name="group100" type="radio" id="radio100">
        <label class="form-check-label" for="radio100">Option 1</label>
    </div>

    <div class="form-check">
        <input class="form-check-input" name="group100" type="radio" id="radio101" checked>
        <label class="form-check-label" for="radio101">Option 2</label>
    </div>

    <div class="form-check">
        <input class="form-check-input" name="group100" type="radio" id="radio102">
        <label class="form-check-label" for="radio102">Option 3</label>
    </div>
    <!--Radio group-->


    <button class="btn btn-primary" type="submit">Submit form</button>
</form>


<style>
    .radio-green [type="radio"]:checked+label:after {
        border-color: #00C851;
        background-color: #00C851;
    }
    /*Gap*/

    .radio-green-gap [type="radio"].with-gap:checked+label:before {
        border-color: #00C851;
    }

    .radio-green-gap [type="radio"]:checked+label:after {
        border-color: #00C851;
        background-color: #00C851;
    }
</style>