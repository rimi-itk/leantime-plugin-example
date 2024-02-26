@extends('itk::layout')

@section('title', __('Tickets'))

@section('content')
@foreach ($tickets as $ticket)
    <a href="/itk/tickets/{{ $ticket['id'] }}" id="ticket-{{ $ticket['id'] }}">
        <div class="ticket">
            <h2>{{ $ticket['id'] }}: {{ $ticket['headline'] }}</h2>

            <div class="description" style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                {!! $ticket['description'] !!}
            </div>

            {{ $ticket['projectId'] }}

{{--            {{ $ticket['dateToFinish'] }}--}}
            {{ (new \DateTimeImmutable($ticket['dateToFinish']))->format('Y-m-d') }}
        </div>
    </a>
@endforeach
@endsection
