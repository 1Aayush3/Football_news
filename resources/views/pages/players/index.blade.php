@extends('layouts.content')
@section('title', 'Players')
@section('main-content')

<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">List of all Players</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
                <table id="example-list" class="table table-striped table-bordered" style="width:100%"
                    examclass="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Team</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($players as $key=> $player )
                        <tr style="font-weight:500; ">

                            <td>{{ $key +1 }}</td>
                            <td>{{$player->first_name}}</td>
                            <td>{{$player->last_name}}</td>
                            <td>{{$player->team->name}}</td>

                            <td style="display:inline-flex">
                                {!! Form::open(['method' => 'GET', 'url' => route('players.show', $player->id)])
                                !!}
                                <button id='show' type="submit" class="btn btn-primary" style="margin-right:5px;">
                                    Show Details
                                </button>
                                {!! Form::close() !!}

                                {!! Form::open(['method' => 'DELETE', 'url' => route('players.destroy',
                                $player->id)]) !!}
                                <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-primary">
                                    Remove</button>
                                {!! Form::close() !!}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Team</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <!-- /.box-body -->
        </div>
    </div>
</div>
@endsection
@push('page-script')
<script>
    
        $('#example-list').DataTable({
            
            "columns": [
                null,
                null,
                null,
                null,
                { "orderable": false }
            ]
        });
  
</script>
@endpush