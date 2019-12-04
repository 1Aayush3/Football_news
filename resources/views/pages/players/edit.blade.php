@extends('layouts.content')
@section('title', 'Edit')
@section('main-content')
{{-- {{dd($player)}} --}}
<section class="content">
    <div class="row">
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Player R3gistration</h3>
                </div>

                {!! Form::model($player, ['method' => 'PUT', 'url' => route('players.update', $player->id)])
                !!}

                <div class="box-body">
                    <div class="form-group">
                        {{ Form::label('first_name', 'First Name') }}
                        {{ Form::text('first_name', null,['class'=>'form-control','placeholder'=>'Your First Name']) }}
                    </div>
                    <div class="form-group">
                        {{ Form::label('last_name', 'Last Name') }}
                        {{ Form::text('last_name', NULL,['class'=>'form-control','placeholder'=>'Your Last Name']) }}
                    </div>

                    <div class="form-group">
                        {{ Form::label('country', 'Country') }}
                        {{ Form::select('country',[],null,['class'=>'selectpicker countrypicker','data-default'=>$player->country]) }}
                    </div>

                    <div class="form-group">
                        {{ Form::label('date', 'Date of Birth') }}
                        {{Form::date('date', $player->date)}}
                    </div>

                    <div class="form-group">
                        {{ Form::label('team', 'Team') }}
                        {{Form::select('team_id', $teams, NULL, ['class'=>'form-control','placeholder' => 'Pick a Team...'])}}
                        {{-- {{ Form::hidden('team-id',$player->team_id,['class'=>'form-control']) }} --}}
                    </div>
                    

                    {{-- <div class="form-group">
                        {{ Form::label('goals', 'Goals Scored') }}
                        {{Form::number('goals',$player->goals,['class'=>'form-control','min'=>'0','onkeypress'=>'return event.charCode >= 48 && event.charCode <= 57'])}}
                    </div> --}}

                    <div class="form-group">
                        {{ Form::label('text area', 'Description') }}
                        {{ Form::textarea('desp',$player->description,['class'=>'form-control','placeholder'=>'Enter...','rows'=>'3','maxlength'=>'5000']) }}
                    </div>
                    {{-- <div class="form-group">
                    <label for="exampleInputFile">Choose a Logo</label>
                    <p class="help-block">Example block-level help text here.</p>
                    </div> --}}
                </div>
            </div>
            <div class="box-footer">
                {{ Form::submit('Save Changes', array('class' => 'btn btn-primary')) }}
                {{ Form::close() }}
            </div>
            </form>
        </div>
    </div>
</section>
<div class="container ">
</div>
@endsection
@push('page-script')
<script>
    $('.countrypicker').countrypicker();

    $(document).ready(function () {
        var team_id = $("input[name=team-id]").val();
        console.log(team_id);
        $('#team').val(team_id);
    });
</script>
@endpush