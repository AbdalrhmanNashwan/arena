<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <title>Arena</title>
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
    <!-- Boxicons CDN Link -->
    <link rel="stylesheet" href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
          crossorigin="anonymous">
{{--    <meta name="viewport" content="width=device-width, initial-scale=1.0">--}}

</head>
<body>
<div class="sidebar">
    <div class="logo_content">
        <div class="logo">
            <div class="logo_name">Arena</div>
        </div>
        <i class='bx bx-menu' id="btn"></i>
    </div>
    <ul class="nav_list">
        <li class="{{request()->segment(1) == 'home' ? 'active-tooltip' : ''}}">
            <a href="{{route('home')}}">
                <i class='bx bx-grid-alt'
                   style="{{
                    request()->segment(1) == 'home' ? 'color: #11101d' : ''
                }}"
                ></i>
                <span class="links_name"
                      style="{{
                    request()->segment(1) == 'home' ? 'color: #11101d' : ''
                }}">Home</span>
            </a>
            <span class="tooltip">Home</span>
        </li>
        <li class="{{request()->segment(1) == 'expenses' ? 'active-tooltip' : ''}}">
            <a href="{{route('expenses')}}">
                <i class='bx bx-money' style="{{
                    request()->segment(1) == 'expenses' ? 'color: #11101d' : ''
                }}"></i>
                <span class="links_name" style="{{
                    request()->segment(1) == 'expenses' ? 'color: #11101d' : ''
                }}">Expenses</span>
            </a>
            <span class="tooltip">Expenses</span>
        </li>
        <li class="{{request()->segment(1) == 'income' ? 'active-tooltip' : ''}}">
            <a href="{{route('income')}}">
                <i class='bx bx-dollar' style="{{
                    request()->segment(1) == 'income' ? 'color: #11101d' : ''
                }}"></i>
                <span class="links_name" style="{{
                    request()->segment(1) == 'income' ? 'color: #11101d' : ''
                }}">Income</span>
            </a>
            <span class="tooltip">Income</span>
        </li>
        <li class="{{request()->segment(1) == 'debts' ? 'active-tooltip' : ''}}">
            <a href="{{route('debts')}}">
                <i class='bx bx-wallet' style="{{
                    request()->segment(1) == 'debts' ? 'color: #11101d' : ''
                }}"></i>
                <span class="links_name" style="{{
                    request()->segment(1) == 'debts' ? 'color: #11101d' : ''
                }}">Debts</span>
            </a>
            <span class="tooltip">Debts</span>
        </li>

        <li class="{{request()->segment(1) == 'sessions' ? 'active-tooltip' : ''}}">
            <a href="{{route('sessions')}}">
                <i class='bx bx-game' style="{{
                    request()->segment(1) == 'sessions' ? 'color: #11101d' : ''
                }}"></i>
                <span class="links_name" style="{{
                    request()->segment(1) == 'sessions' ? 'color: #11101d' : ''
                }}">Session</span>
            </a>
            <span class="tooltip">Sessions</span>
        </li>

        <li class="{{request()->segment(1) == 'settings' ? 'active-tooltip' : ''}}">
            <a href="{{route('settings')}}">
                <i class='bx bx-cog' style="{{
                    request()->segment(1) == 'settings' ? 'color: #11101d' : ''
                }}"></i>
                <span class="links_name" style="{{
                    request()->segment(1) == 'settings' ? 'color: #11101d' : ''
                }}">Settings</span>
            </a>
            <span class="tooltip">Settings</span>
        </li>
    </ul>
    <div class="content " >
        <div class="user">
            <div class="user_details">
                <div class="name_job">
                    <div class="name">{{
                        Auth::user()->name}}</div>
                    <div class="job"></div>
                </div>
            </div>
            <form action="{{route('logout')}}" method="post">
                @csrf
                <button type="submit" class="btn btn-danger" style="background-color:#1a202c;border-color: #1a202c">
                    <i class='bx bx-log-out' style="color: #AEFF00"></i>
                </button>
            </form>
        </div>
    </div>
</div>
<div class="home_content" >
    @yield('content')
</div>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="jquery-3.7.1.min.js"></script>

<script>
    let btn = document.querySelector("#btn");
    let sidebar = document.querySelector(".sidebar");
    let searchBtn = document.querySelector(".bx-search");

    btn.onclick = function () {
        sidebar.classList.toggle("active");
    }
    searchBtn.onclick = function () {
        sidebar.classList.toggle("active");
    }
</script>

</body>
</html>
