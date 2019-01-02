@if(session('level') == 'p')
<li>
    <a href="{{ route('kost.index') }}">
        <i class="material-icons">location_city</i>
        <span>Kost</span>
    </a>
</li>
@endif

@if(session('level') == 'a')
<li>
    <a href="{{ route('kos.index') }}">
        <i class="material-icons">location_city</i>
        <span>Kost</span>
    </a>
</li>

<li>
    <a href="{{ route('user.index') }}">
        <i class="material-icons">people</i>
        <span>User</span>
    </a>
</li>
@endif

<li>
    @if(session('level') == 'a')
    <a href="{{ route('pesananAdmin.index') }}">
    @elseif(session('level') == 'p')
    <a href="{{ route('pesananPemilik.index') }}">
    @elseif(session('level') == 'u')
    <a href="{{ route('pesananUser.index') }}">
    @endif
        <i class="material-icons">insert_chart</i>
        <span>Transaksi</span>
    </a>
</li>