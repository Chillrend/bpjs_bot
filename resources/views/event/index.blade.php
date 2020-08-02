@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Event') }}</div>

                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Event Title</th>
                                <th>Event Description</th>
                                <th>Mentions</th>
                                <th>Cover Image</th>
                                <th>Time</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($event as $e)
                            <tr>
                                <th scope="row">{{$e->id}}</th>
                                <td>@markdown{{$e->event_title}}@endmarkdown</td>
                                <td>@markdown{{$e->event_description}}@endmarkdown</td>
                                <td>{{$e->mentions}}</td>
                                <td><img src="{{$e->event_image_url}}" alt="Event Image" height=80></td>
                                <td>{{$e->time}}</td>
                                <td>
                                    <a href="event/delete/{{$e->id}}" class="btn btn-danger" onclick="confirm('You sure?')">Delete</a>
                                    <a href="event/edit/{{$e->id}}" class="btn btn-info">Edit</a>
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
