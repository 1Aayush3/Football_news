@extends('layouts.content')
@section('title', 'Fixtures')
@section('main-content')
{{-- {{die($fixtures)}} --}}
<style>
    td.fire-gif {
        background: url('https://i.pinimg.com/originals/60/b9/33/60b9330cadbe2dbef2c0e4d641f652b7.gif') no-repeat;
        background-size: cover;
        font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
        text-align: center;
        font-size: 30px;
    }
</style>
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Premiar League Fixtures</h3>
            </div>
            <!-- /.box-header -->


            <div class="box-body table-responsive no-padding">
                <table id="example-list" class="table table-hover ">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Home Team</th>
                            <th>Away Team</th>
                            <th>Match Date</th>
                            <th>Match Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($fixtures as $key=> $fixture)
                        <tr style="font-weight:500;">
                            <td>{{$key+1}}</td>
                            <td>{{$fixture['home_name']}}</td>
                            <td>{{$fixture['away_name']}}</td>
                            <td>{{$fixture['date']}}</td>
                            <td>{{$fixture['time']}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <th>ID</th>
                        <th>Home Team</th>
                        <th>Away Team</th>
                        <th>Match Date</th>
                        <th>Match Time</th>
                    </tfoot>
                </table>
            </div>
        </div>
        <button id='sliga' class='btn btn btn-primary'>Superliga</button>
    </div>
</div>

<template id="template">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Superliga</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    {{-- <template> --}}
                    <table id="example" class="table table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Home Team</th>
                                <th>Away Team</th>
                                <th>Match Time</th>
                                <th>Match Date</th>
                            </tr>
                        </thead>
                        <tbody id='tbody'>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>
@endsection
@push('page-script')
<script>
    $('#example-list').DataTable();
    $('#sliga').click(function(){
        $('#sliga').prop('disabled', true);
        $.ajax({
                url: '{{ route('sliga.index')}}',
                type: "GET",
                data: {
                         id: 6
                    },
                success: function (data) {
                    let template=  $("#template").html();
                    $(".content-wrapper").append(template);
                    data.forEach(function(data,index) {
                        $('#example').DataTable().row.add( [
                            index+1,
                            data["home_name"],
                            data["away_name"],
                            data["time"],
                            data["date"]
                            ] ).draw( false );                  
                        });
                    if($("#tbody")==""){
                    $('#sliga').prop('disabled', false);
                    }
                } ,
                error: function (error) {
                    console.log(`Error ${error}`);
                },
            }
        );
    });
</script>
@endpush