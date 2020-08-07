@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Colosseum History') }}</div>
                    <div class="card-body">
                        Server time now : {{$time}}
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Date</th>
                                <th>Rival</th>
                                <th>Outcome</th>
                                <th>Lifeforce</th>
                                <th>Colosseum Type</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($colosseum as $e)
                                <tr>
                                    <td>{{$e->colosseum_date}}</td>
                                    <td>@markdown{{$e->rival}}@endmarkdown</td>
                                    <td>@markdown{{$e->outcome}}@endmarkdown</td>
                                    <td>{{$e->lifeforce_our}} v {{$e->lifeforce_theirs}}</td>
                                    <td>{{$e->colosseum_type}}</td>
                                    <td>
                                        <a href="colosseum/delete/{{$e->id}}" class="btn btn-danger" onclick="confirm('You sure?')">Delete</a>
                                        <a href="colosseum/edit/{{$e->id}}" class="btn btn-info">Edit</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        {{$colosseum->links()}}

                        <a href="colosseum/create" class="btn btn-success">Create a colosseum archive entry</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
