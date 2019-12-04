@if (Session::has('message'))
<div class="row">
    <div class="col-md-6">
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-check"></i> Attention!</h4>
            {{ Session::get('message') }}
        </div>
    </div>
</div>
@endif

@if ($errors->any())
<div class="alert alert-danger ">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif