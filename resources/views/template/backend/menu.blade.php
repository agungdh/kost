<li>
    <a href="{{ route('dashboard') }}">
        <i class="material-icons">home</i>
        <span>Dashboard</span>
    </a>
</li>

<li>
    <a href="{{ route('kost.index') }}">
        <i class="material-icons">location_city</i>
        <span>Kost</span>
    </a>
</li>

@if(session('level') == 'a')
<li>
    <a href="{{ route('user.index') }}">
        <i class="material-icons">people</i>
        <span>User</span>
    </a>
</li>
@endif