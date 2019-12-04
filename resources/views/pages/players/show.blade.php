@extends('layouts.content')
@section('title', 'Details')
@section('main-content')

<section class="content-header">
    <h1>
        Player Profile
    </h1>
   
    <ol class="breadcrumb">
        <li><a href="{{route('players.index')}}"><i class="fa fa-dashboard"></i>Home</a></li>
        <li class="active">Profile</li>
    </ol>
    
</section>
<section class="content">

    <div class="row">
        <div class="col-md-10">

            <!-- Profile Image -->
            <div class="box box-primary">
                <div class="box-body box-profile">
                                          
                    <img class="profile-user-img img-responsive img-circle  " src="../../dist/img/user4-128x128.jpg"
                        alt="User profile picture">

                <h3 class="profile-username text-center">{{$player->first_name}} {{$player->last_name}}</h3>

                

                    <p class="text-muted text-center">{{$team}}</p>

                    <ul class="list-group list-group-unbordered">
                        <li class="list-group-item">
                            <b>Citizenship</b> <a class="pull-right">{{$player->country}}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Date of Birth</b> <a class="pull-right">{{$player->date}}</a>
                        </li>
                        {{-- <li class="list-group-item">
                            <b>Goals Scored</b> <a class="pull-right">{{$player->goals}}</a>
                        </li> --}}
                        <li class="list-group-item">
                            <b>Description</b> <p class="form-control" rows="3">{{$player->description}}</p>
                        </li>
                    </ul>
                    {!! Form::open(['method' => 'GET', 'url' => route('players.edit', $player->id)])
                                    !!}
                    <button id='edit' type="submit" class="btn btn-block" style="margin-right:5px;">
                            Edit
                        </button>
                    {!! Form::close() !!}

                    <a href="{{route('players.index')}}" class="btn btn-primary btn-block"><b>Back</b></a>
                    
                </div>
                
            </div>
            
        </div>
        
    </div>
    
    <!-- /.row -->

</section>
@endsection
