@php
$data['header'] = 'Aktivasi E-Mail';
$data['link'] = route('activate') . "?head={$id}&body={$email}&token={$token}";
@endphp
@include('template.email.template', $data)