@extends('layouts.content')
@section('title', 'Register Player')
@section('main-content')

<section class="content">
    <div class="row">
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Player R3gistration</h3>
                </div>

                {{ Form::open(array('url' => 'players'))}}

                <div class="box-body">
                    <div class="form-group">
                        {{ Form::label('first_name', 'Frist Name') }}
                        {{ Form::text('first_name','',['class'=>'form-control','placeholder'=>'Your First Name']) }}
                    </div>
                    <div class="form-group">
                            {{ Form::label('last_name', 'Last Name') }}
                            {{ Form::text('last_name','',['class'=>'form-control','placeholder'=>'Your Last Name']) }}
                        </div>

                    <div class="form-group">
                        {{ Form::label('country', 'Country') }}
                        {{ Form::select('country',[],null,['class'=>'selectpicker countrypicker']) }}
                    </div>

                    <div class="form-group">
                        {{ Form::label('date', 'Date of Birth') }}
                        {{Form::date('date', \Carbon\Carbon::now())}}  
                    </div>

                    <div class="form-group">
                            {{ Form::label('team', 'Team') }}
                            {{Form::select('team',$teams, null, ['class'=>'form-control','placeholder' => 'Pick a Team...'])}} </div>

                    {{-- <div class="form-group">
                            {{ Form::label('goals', 'Goals Scored') }}
                            {{Form::number('goals','',['class'=>'form-control','min'=>'0'])}}  
                    </div> --}}

                    <div class="form-group">
                        {{ Form::label('text area', 'Description') }}
                        {{ Form::textarea('desp','',['class'=>'form-control','placeholder'=>'Enter...','rows'=>'3','maxlength'=>'5000']) }}  
                    </div>                    
                    {{-- <div class="form-group">
                    <label for="exampleInputFile">Choose a Logo</label>
                    <p class="help-block">Example block-level help text here.</p>
                    </div> --}}    
                  

                    <div class="checkbox">
                        <label>
                            <input type="checkbox" onclick="canSubmit()" id="terms"> Terms and Conditions*
                        </label>
                    </div>
                </div>
            </div>
            <div class="box-footer">
                {{ Form::submit('Create the Team!', array('class' => 'btn btn-primary','disabled' => 'disabled','id'=>'submit')) }}
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

    function canSubmit(){
        if($('#terms').is(':checked') == true){
            $('#submit').prop('disabled', false);
        } else {
            $('#submit').prop('disabled', true);
        }
    }
</script>
@endpush