@extends('layouts.content')
@section('title', 'Teams')
@section('main-content')

<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">List of all Teams</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
                <table class="table table-striped table-bordered" style="width:100%" examclass="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th></th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($teams as $key=> $team )
                        <tr style="font-weight:500; ">
                            <td>{{ $key + $teams->firstItem() }}</td>
                            <td>{{$team->name}}</td>
                            <td><img src="/images/{{ $team->logo }}" alt="Team Logo Here" height="42" width="42">
                            </td>
                            <td style="display:inline-flex">
                                <button id='show' type="button" class="btn btn-primary" data-toggle="modal"
                                    data-id="{{$team->id}}" data-name="{{$team->name}}" data-image="{{$team->image}}"
                                    data-country="{{$team->countries}}" data-formation="{{$team->formation}}"
                                    data-description="{{$team->description}}" data-target="#exampleModal"
                                    style="margin-right:5px;">
                                    Show
                                </button>
                                {!! Form::open(['method' => 'DELETE', 'url' => route('teams.destroy', $team->id)]) !!}
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
                            <th>Name</th>
                            <th>Logo</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
                <div class="container-fluid">
                    <div class="row">
                        <div class="pull-left">
                            Showing {{ $teams->firstItem() }} to {{ $teams->lastItem() }}
                        </div>
                        <div class="pull-right">
                            {{ $teams->links() }}
                        </div>
                    </div>
                </div>

                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- Button trigger modal -->
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Team</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        {{  Form::model($team, array('route' => array('teams.update', $team->id), 'method' => 'PUT','files'=> true,'id'=>'form','enctype'=>'multipart/form-data')) }}
                        <div class="form-group">
                            {{ Form::open(array('url' => 'teams','files'=> true))}}

                            <div class="box-body">


                                <div class="form-group">

                                    {{ Form::label('name', 'Name') }}
                                    {{ Form::text('name','',['class'=>'form-control','placeholder'=>'Name here','id'=>'name']) }}
                                </div>

                                <div class="form-group">
                                    {{ Form::label('country', 'Country') }}
                                    {{ Form::select('country',[],null,['class'=>'selectpicker countrypicker select-cont','id'=>'country','data-default'=>'']) }}
                                </div>

                                <div class="form-group">
                                    {{ Form::label('date', 'Year of Formation') }}
                                    {{Form::date('date','',['id'=>'date'])}}
                                </div>

                                <div class="form-group">
                                    {{ Form::label('text area', 'Description') }}
                                    {{ Form::textarea('desp','',['class'=>'form-control','id'=>'desp','placeholder'=>'Enter...','rows'=>'3','maxlength'=>'5000']) }}
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputFile">Change Logo*</label>
                                    {!! Form::file('logo', ['ref' => 'file', 'id' => 'file'])!!}
                                    <p class="help-block">Example block-level help text here.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        {{ Form::submit('Save Changes', array('class' => 'btn btn-primary', 'id' => 'update')) }}
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    </section>
    @endsection
    @push('page-script')
    <script>
        $('#exampleModal').on('show.bs.modal', function (e) {
        var dataName = $(e.relatedTarget).data('name');
        var dataId = $(e.relatedTarget).data('id');
        var dataCountry = $(e.relatedTarget).data('country');
        var dataFormation = $(e.relatedTarget).data('formation');
        var dataDescription = $(e.relatedTarget).data('description');
        var dataImage = $(e.relatedTarget).data('image');

        $(".modal-body #name").val(dataName);
        $(".modal-body #id").val(dataId);
        $(".modal-body #image").attr('src',dataImage);
        $(".modal-body #country").val(dataCountry);
        $(".modal-body #date").val(dataFormation);
        $(".modal-body #desp").val(dataDescription);
        $('.modal-body form').attr('action', '/teams/' + dataId);
        // $('.selectpicker').selectpicker('refresh');
    });
     
    $('.countrypicker').countrypicker();

    // $('#form').submit(function(event){
    // if($('#terms').is(':checked') == false){
    //     event.preventDefault();
    //     alert("By signing up, you must accept our terms and conditions!");
    //     return false;
    // }
    
    // $.ajax({
    //     type:"PUT",
    //     cache:false,
    //     url:"teams/",
    //     data:{ id : dataId, name : dataName }, // multiple data sent using ajax
    //     success: function (html) {

    //       $('#add').val('data sent sent');
    //       $('#msg').html(html);
    //     }
    //         })
    //     });

    </script>
    @endpush