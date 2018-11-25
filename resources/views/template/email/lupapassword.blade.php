@php
$data['header'] = 'Reset Password';
$data['link'] = route('forgetPasswordChPass') . '?head=' . md5($user->id) . '&body=' . md5($user->email) . '&token=' . $token;
@endphp
@include('template.email.template', $data)