@extends('layouts.template')

@section('content')

<h3>Nova Pergunta do Checklist</h3>

@includeIf('registrations.checklist-item._checklist-item-form')

@endsection

