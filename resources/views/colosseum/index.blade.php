@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css"">
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Colosseum History') }}</div>
                    <div class="card-body">
                        Server time now : {{$time}}
                        <table class="table table-bordered" id="colo_table">
                            <thead>
                                <tr>
                                    <th>DT_RowIndex</th>
                                    <th>colosseum_date</th>
                                    <th>rival</th>
                                    <th>outcome</th>
                                    <th>lifeforce_our</th>
                                    <th>lifeforce_theirs</th>
                                    <th>colosseum_type</th>
                                    <th>action</th>
                                </tr>
                            </thead>
                        </table>

                        <a href="colosseum/create" class="btn btn-success">Create a colosseum archive entry</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
    <script type="text/javascript">
        var table;
        $(document).ready(function () {
            $.noConflict();

            table = $('#colo_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{route('colosseum_i')}}',
                columns: [
                    { data: 'DT_RowIndex',  name: 'DT_RowIndex' },
                    { data: 'colosseum_date',  name: 'colosseum_date' },
                    { data: 'rival',  name: 'rival' },
                    { data: 'outcome',  name: 'outcome' },
                    { data: 'lifeforce_our',  name: 'lifeforce_our' },
                    { data: 'lifeforce_theirs',  name: 'lifeforce_theirs' },
                    { data: 'colosseum_type',  name: 'colosseum_type' },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: true,
                        searchable: true
                    }

                ]
            });
        });

        // column: [
        //     { data: 'DT_RowIndex',  name: 'DT_RowIndex' },
        //     { data: 'colosseum_date',  name: 'colosseum_date' },
        //     { data: 'rival',  name: 'rival' },
        //     { data: 'outcome',  name: 'outcome' },
        //     { data: 'lifeforce_our',  name: 'lifeforce_our' },
        //     { data: 'lifeforce_theirs',  name: 'lifeforce_theirs' },
        //     { data: 'colosseum_type',  name: 'colosseum_type' },
        //     {
        //         data: 'action',
        //         name: 'action',
        //         orderable: true,
        //         searchable: true
        //     }
        //
        // ]
    </script>
@endsection
