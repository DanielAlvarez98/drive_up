<h2>Hola {{ $user->name }}</h2>

@if($status === 'expired')
    <p style="color:red">
        Tu {{ $type }} <strong>{{ $item->name }}</strong> ya se venció.
    </p>
@else
    <p style="color:orange">
        Tu {{ $type }} <strong>{{ $item->name }}</strong> vencerá pronto.
    </p>
@endif

<p>Fecha: {{ $item->fecRenov }}</p>

<p>Vehículo: {{ $item->car->marca }} - {{ $item->car->placa }}</p>

<hr>
<p>Drive UP 🚗</p>
