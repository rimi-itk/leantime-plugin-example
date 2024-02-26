@extends('itk::layout')

@php /** @var \Leantime\Domain\Tickets\Models\Tickets $ticket */ @endphp

@section('title', __('Ticket'))

@section('content')
<div class="ticket">
    <h1>{{ $ticket->id }}: {{ $ticket->headline }}</h1>

    {{ $ticket->projectName }}

    <div class="description">
        {!! $ticket->description !!}
    </div>

    {{ $ticket->status }}
</div>
@endsection
