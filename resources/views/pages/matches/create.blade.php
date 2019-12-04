@extends('layouts.content')
@section('title', 'Create Match')
@section('main-content')

<section class="content">
    <div class="row">
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Matches</h3>
                </div>
                {{ Form::open(array('url' => 'matches'))}}
                <div class="box-body">
                    <div class="form-group">
                        {{ Form::label('home_team_id', 'Home Team') }}
                        {{Form::select('home_team_id',$teams, null, ['class'=>'form-control event_selection','placeholder' => 'Pick a Team...'])}}
                    </div>
                    <p class="text-center">VS</p>
                    <div class="form-group">
                        {{ Form::label('away_team_id', 'Away Team') }}
                        {{Form::select('away_team_id',$teams, null, ['class'=>'form-control event_selection','placeholder' => 'Pick a Team...'])}}
                    </div>

                    <div class="form-group">
                        {{ Form::label('date', 'Match Date') }}
                        {{Form::date('date', \Carbon\Carbon::now())}}
                    </div>
                    <div class="form-group">
                        <b> STATUS:</b>
                        <br>
                        {{ Form::label('status', 'Started') }}
                        {{ Form::radio('status[]',2 )}}
                        <br>
                        {!! Form::label('status', 'Ongoing') !!}
                        {!! Form::radio('status[]', 1) !!}
                        <br>
                        {!! Form::label('status', 'Ended') !!}
                        {!! Form::radio('status[]', 0) !!}
                    </div>

                </div>
            </div>
            <div class="box-footer">
                {{ Form::submit('Create the Match!', array('class' => 'btn btn-primary')) }}
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
    var $coll = $( '.event_selection' ).on( 'change', function () {
    $coll.children().prop( 'disabled', false );
    $coll.each(function () {
        var val = this.value;
        $coll.not( this ).children( '[value="' + val + '"]' ).prop( 'disabled', true );
    });
});
</script>
@endpush