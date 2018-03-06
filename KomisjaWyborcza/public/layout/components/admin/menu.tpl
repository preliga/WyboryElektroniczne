<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item {if $path[2] == 'index'} active {/if}">
                <a class="nav-link" href="/admin/index"> Home  </a>
            </li>
            <li class="nav-item {if $path[2] == 'revokingElector'} active {/if}">
                <a class="nav-link" href="/admin/revokingElector">Unieważnij Wyborcę </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/admin/logout">Wyloguj </a>
            </li>
        </ul>
    </div>
</nav>