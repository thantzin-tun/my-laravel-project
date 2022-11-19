<div class="container-fluid p-0">
    <header class="header-menu w-100 h-10 bg-dark d-flex justify-content-between align-items-center py-3">
        <ul class="menu">
            <li><a href="{{route('user#page')}}">Home</a></li>
            <li><a href="{{route('contact#us')}}">Contact</a></li>
        </ul>
        <div class="connect">
            <div class="userOne mr-3">
                @if(Auth::user()->image == null)
                @if(Auth::user()->gender == 'female')
                <img src="{{asset('admin/images/images.jpg')}}" class="rounded-lg" alt="admin" width="42px" height="42px" />
                @else
                <img src="{{asset('admin/images/userOne.png')}}" class="rounded-lg" alt="admin" width="42px" height="42px" />
                @endif
                @else
                <img src="{{asset('storage/'.Auth::user()->image)}}" class="rounded" alt="user" width="42px" height="42px" />
                @endif
                <h4 class="text-light mx-3" style="font-size: 1rem;">{{Auth::user()->name}}</h4>
            </div>
            <form action="{{route('logout')}}" method="POST">
                @csrf
                <button class="btn btn-danger" type="submit">Logout</button>
            </form>
        </div>
    </header>
</div>