@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Event') }}</div>

                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Event Title</th>
                                <th>Event Description</th>
                                <th>Time</th>
                                <th>Host</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($event as $e)
                            <tr>
                                <th scope="row">{{$e->id}}</th>
                                <td>{{$e->event_title}}</td>
                                <td>{{$e->event_description}}</td>
                                <td>{{$e->time}}</td>
                                <td>{{$e->host}}</td>
                                <td>
                                    <a href="#" class="btn btn-default">View</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    {{$event->links()}}

                    <a href="event/create" class="btn btn-success">Create an event</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
