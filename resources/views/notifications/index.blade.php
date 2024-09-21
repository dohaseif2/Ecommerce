@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container my-4">
    <div id="notifications">
        @foreach ($notifications as $notification)
        <strong>{{ $notification->user->name }}:</strong> 

            <div class="alert alert-info {{ $notification->read ? 'read' : 'unread' }}">
                {{ $notification->message }}
            </div>
        @endforeach
    </div>
</div>


@endsection
<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
  <script>

    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher('b351997304f15043fc32', {
      cluster: 'eu',
      forceTLS: true
    });

    var channel = pusher.subscribe('admin.notifications');
    
    channel.bind('App\\Events\\OrderCreated', function(data) {
        console.log("test " + data);
        
      alert(JSON.stringify(data));
    });
  </script>