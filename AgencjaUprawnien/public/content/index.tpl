<div class="text-center">
    <form action="/saveUser?choseToken={$choseToken}" method="post">
        <div class="row justify-content-md-center">
            <div class="col col-lg-4">
                <img src="/images/epuap2.png"/>
            </div>
        </div>
        <br>
        <div class="row justify-content-md-center">
            <div class="col col-lg-4">
                <input type="text" class="form-control" name='name' placeholder="Imię" {*required*}>
            </div>
        </div>
        <br>
        <div class="row justify-content-md-center">
            <div class="col col-lg-4">
                <input type="text" class="form-control" name='lastName' placeholder="Nazwisko" {*required*}>
            </div>
        </div>
        <br>
        <div class="row justify-content-md-center">
            <div class="col col-lg-4">
                <input type="text" class="form-control" name='pesel' placeholder="PESEL" required>
            </div>
        </div>
        <br>
        <div class="row justify-content-md-center">
            <div class="col col-lg-4">
                <button type="submit" class="btn btn-success">Zaloguj</button>
            </div>
        </div>
    </form>
</div>
