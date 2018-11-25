@php
$data['header'] = 'Ubah Email';
$data['link'] = route('confirmChemail') . '?head=' . md5($user->id) . '&body=' . md5($user->email) . '&token=' . $token . '&key=' . md5($temp_email);
@endphp
@include('template.email.template', $data)