@extends('layouts.template')

@section('content')

<h3>Novo Usuário</h3>
@includeIf('registrations.user._user-form')

@endsection