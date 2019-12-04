@extends('layouts.content')
@section('title', 'Add Score')
@section('main-content')
<section class="content">
    <div class="container">
        <div class="row clearfix">
            <div class="col-md-12">
                    <div class="row clearfix">
                            <div class="col-md-11">
                                <button id="add_row" class="btn btn-primary pull-right">Add Goal</button>
                            </div>
                        </div>
                    {{ Form::open(array('url' => route('matches.update_scores', $match->id),'id'=>'goals'))}}
                <table class="table table-bordered table-hover" id="tab_logic">
                    <thead>
                        <tr>
                            <th class="text-center"> {{$teams->get($match->home_team_id)}} </th>
                            <th class="text-center"> VS </th>
                            <th class="text-center"> {{$teams->get($match->away_team_id)}} </th>
                        </tr>
                    </thead>
                    
                    <tbody id="mainBody">
                        <template id="template">
                            <tr class='newRow'>
                                <td>{{Form::select('goals[COUNTER][player_id]',$players, NULL, ['class'=>'form-control player','placeholder' => 'Pick a Player...'])}}
                                </td>
                                <td></td>
                                <td><input type="number" step='1' min="0" max="90" name='goals[COUNTER][time]'
                                        class="form-control time" /></td>
                                <td class='remove'><button>Remove</button></td>
                            </tr>
                        </template>
                    </tbody>
                   
                </table>
                {{ Form::submit('Finalize', array('class' => 'btn btn-primary')) }}
                {{ Form::close() }}
            </div>
        </div>
    </div>



</section>
@endsection
@push('page-script')
<script>
    var goalCounter = 0;
    $(document).ready(function () {
        $("#add_row").on("click", function () {
            var goalTemplate = $("#template").html();
            goalTemplate = goalTemplate.replace('COUNTER', goalCounter);
            goalTemplate = goalTemplate.replace('COUNTER', goalCounter);
            $("#mainBody").append(goalTemplate);
            goalCounter++;
        });
        ////////////////////////////RemoveRow///////////////////
        $("tbody").on("click", ".remove", function () {
            $(this)
                .closest("tr")
                .remove();
        });
    });  
    /////////////////////////////////////////////
    $("tbody").on("change", ".player", function () {

        var selectedVal = $(this)
                .find("option:selected")
                .val();

  });
</script>
@endpush