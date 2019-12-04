@extends('layouts.content')
@section('title', 'Create Team')
@section('main-content')

<section class="content">
    <div class="row">
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">R3GISTER A TEAM</h3>
                </div>

                {{ Form::open(array('url' => 'teams','enctype'=>'multipart/form-data' ))}}
                @csrf
                <div class="box-body">
                    <div class="form-group">
                        {{ Form::label('name', 'Name') }}
                        {{ Form::text('name','',['class'=>'form-control','placeholder'=>'Name here']) }}
                    </div>

                    <div class="form-group">
                        {{ Form::label('country', 'Country') }}
                        {{ Form::select('country',[],null,['class'=>'selectpicker countrypicker']) }}
                    </div>

                    <div class="form-group">
                        {{ Form::label('date', 'Year of Formation') }}
                        {{Form::date('date', \Carbon\Carbon::now())}}
                    </div>

                    <div class="form-group">
                        {{ Form::label('text area', 'Description') }}
                        {{ Form::textarea('desp','',['class'=>'form-control','placeholder'=>'Enter...','rows'=>'3','maxlength'=>'5000']) }}
                    </div>
                    @php($variable = '<strong>Aayush</strong>')

                    <div class="form-group">
                        <label for="exampleInputFile">Upload Logo*</label>
                        {{-- <input type="file" id="file" ref="file" name="logo"> --}}
                        {!! Form::file('logo', ['ref' => 'file', 'id' => 'file'])!!}
                        <p class="help-block">Example block-level help text here.</p>
                    </div>

                    <div class="checkbox">
                        <label>
                            <input id="terms" type="checkbox" onclick="canSubmit()"> Terms and Conditions
                        </label>
                    </div>

                </div>
            </div>
            <div class="box-footer">
                {{ Form::submit('Create the Team!', array('class' => 'btn btn-primary','id'=>'submit','disabled'=>'disabled')) }}
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
            $('#submit').prop('disabled', true)
        }
    }
</script>
@endpush