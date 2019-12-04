@extends('layouts.content')
@section('title', 'Matches')
@section('main-content')
{{-- {{dd($matches)}} --}}
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
        <h3 class="box-title">Matches</h3>
      </div>
      <!-- /.box-header -->

      <div class="box-body table-responsive no-padding">
        <table id="example-list" class="table table-hover">
          <thead>
            <tr>
              <th>ID</th>
              <th>Home Team</th>
              <th>Scores</th>
              <th>Away Team</th>
              <th>Match Time</th>
              <th>Status</th>
              <th>Action</th>
            </tr>

          </thead>
          <tbody>
            @foreach($matches as $key=> $match)
            <tr style="font-weight:500;">
              <td>{{ $key + $matches->firstItem() }}</td>
              <td>{{$teams->get($match->home_team_id)}}
              </td>
              <td class="fire-gif" onclick="reveal({{$key}})">
                <b>{{count($match->home_goals)}}</b>-<b>{{count($match->away_goals)}}</b></td>
              <td>{{$teams->get($match->away_team_id)}}</td>
              <td>{{$match->match_time}}</td>
              <td>{{$match->status==0?'Ended': ($match->status==1?'Ongoing':($match->status==2?'Started':'invalid'))}}
              </td>
              <td style="display:inline-flex">
                <a class="btn btn-primary" id='show' style="margin-right:5px;"
                  href="{{route( 'matches.add_scores',[$match->id] ) }}">
                  Add Score
                </a>
                {!! Form::open(['method' => 'DELETE', 'url' => route('matches.destroy', $match->id)]) !!}
                <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-primary">
                  Remove</button>
                {!! Form::close() !!}
              </td>
            </tr>

            <tr id='toggle-{{$key}}' style="display:none;">
              <td></td>

              <td> @foreach ($match->home_goals as $keys=>$home_goal)
                @if(isset($home_goal['player']))
                <ul>
                  <li>{{$home_goal['player']}}({{$home_goal['time']}}')</li>
                </ul>
                @endif
                @endforeach
              </td>
              <td></td>
              <td>@foreach ($match->away_goals as $keys=>$away_goal)
                @if(isset($away_goal['player']))
                <ul>
                  <li>{{$away_goal['player']}}({{$home_goal['time']}}')</li>
                </ul>
                @endif
                @endforeach</td>
              <td colspan="2"></td>
            </tr>
            @endforeach
          </tbody>
          <tfoot>
            <th>ID</th>
            <th>Home Team</th>
            <th>Scores</th>
            <th>Away Team</th>
            <th>Match Time</th>
            <th>Status</th>
            <th>Action</th>
          </tfoot>
        </table>
      </div>
      <!-- /.content -->
    </div>
  </div>
</div>
@endsection
@push('page-script')
<script>
  const reveal=(key)=>{
          let id=`#toggle-${key}`;
          $(id).toggle("slow");
        }

  $('#example-list').DataTable({
  // "columns": [
  //   null,
  //   null,
  //   null,
  //   null,
  //   null,
  //   { "orderable": false }
  // ]
});
</script>
@endpush