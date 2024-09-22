@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    {{-- <div class="container my-4">
        <div id="notifications">
            @foreach ($notifications as $notification)
                <strong>{{ $notification->user->name }}:</strong>

                <div class="alert alert-info {{ $notification->read ? 'read' : 'unread' }}">
                    {{ $notification->message }}
                </div>
            @endforeach
        </div>
    </div> --}}
@endsection
