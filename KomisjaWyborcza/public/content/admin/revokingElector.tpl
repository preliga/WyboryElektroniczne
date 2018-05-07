<form action="" method="post">
    <div class="row">
        <div class="col">
            <input type="text" class="form-control" name='pesel' placeholder="PESEL"
                   value="{if !empty($post['pesel'])} {$post['pesel']} {/if}">
        </div>
        <div class="col">
            <button type="submit" class="btn btn-danger">Unieważnij Wyborcę</button>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col">
            <input type="text" class="form-control" name='login_one' placeholder="login pierwszy"
                   value="{if !empty($post['login_one'])} {$post['login_one']} {/if}">
            <input type="password" class="form-control" name='password_one' placeholder="hasło pierwszy"
                   value="{if !empty($post['password_one'])} {$post['password_one']} {/if}">
        </div>
        <div class="col">
            <input type="text" class="form-control" name='login_two' placeholder="login drugi"
                   value="{if !empty($post['login_two'])} {$post['login_two']} {/if}">
            <input type="password" class="form-control" name='password_two' placeholder="hasło drugi"
                   value="{if !empty($post['password_two'])} {$post['password_two']} {/if}">
        </div>
        <div class="col">
            <input type="text" class="form-control" name='login_three' placeholder="login trzeci"
                   value="{if !empty($post['login_three'])} {$post['login_three']} {/if}">
            <input type="password" class="form-control" name='password_three' placeholder="hasło trzeci"
                   value="{if !empty($post['password_three'])} {$post['password_three']} {/if}">
        </div>
    </div>
</form>