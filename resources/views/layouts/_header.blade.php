<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container ">
        <a class="navbar-brand" href="{{ route('home') }}">Weibo App</a>
        <ul class="navbar-nav justify-content-end">
            @if (Auth::check())
            <li class="nav-item"><a class="nav-link" href="{{route('users.index')}}">用户列表</a></li>

            <li class="nav-item">
             <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                {{ Auth::user()->name}}
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                <li> <a class="dropdown-item" href="{{ route('users.show', Auth::user()) }}">个人信息</a></li>
                <li><a class="dropdown-item" href="{{ route('users.edit', Auth::user()) }}">编辑资料</a></li>
                <div class="dropdown-divider"></div>
                <li><a class="dropdown-item" id="logout" href="#">
                        <form action="{{ route('logout') }}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <button class="btn btn-block btn-danger" type="submit" name="button">退出</button>
                        </form>
                    </a></li>
            </ul>
            </div>
            </li>
            @else
            <li class="nav-item"><a class="nav-link" href="{{ route('help') }}">帮助</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">登录</a></li>
            @endif
        </ul>



    </div>
</nav>
