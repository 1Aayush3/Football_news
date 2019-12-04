<?php
    namespace App\Http\Controllers;
    use App\Http\Controllers\Controller;
    use DB;
    use App\Model\Match;
    use App\Model\Player;
    use App\Model\Team;
    use App\Model\Goal;
    use Illuminate\Http\Request;
    use Session;
    use Illuminate\Support\Facades\Validator;

    class MatchController extends Controller
    {
        public function index()
        {

            $teams = Team::pluck('name', 'id');      
            $matches = Match::with(['goals.player'])->simplePaginate(10);
            
            foreach($matches as $key=> $match){
                $homeGoals = [];
                $awayGoals = [];
                        foreach($match->goals as $goal){
                            if($goal->player->team_id == $match->home_team_id){
                                array_push($homeGoals, [
                                    'player' => $goal->player->first_name.' '.$goal->player->last_name,
                                    'time' => $goal->match_time
                                ]);
                            }else{
                                array_push($awayGoals, [
                                    'player' => $goal->player->first_name.' '.$goal->player->last_name,
                                    'time' => $goal->match_time
                                ]);
                            }
                        }
                $matches[$key]->home_goals = $homeGoals;
                $matches[$key]->away_goals = $awayGoals;
            }
            

            return View('pages.matches.index',compact('matches','teams'));
        }

        
        public function create()
        {
            $teams=Team::pluck('name','id');
        return View('pages.matches.create',compact('teams'));
        }

        
        public function store(Request $request)
        {
            // dd($request);
            $rules = array(
                'home_team_id'       => 'bail|required|unique:table_matches',
                'away_team_id'       => 'bail|required|unique:table_matches',
            );

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return Redirect()->back()
                    ->withErrors($validator)->with('error', 'invalid data');
            }else{            
                
                $match = new Match;
                $match->home_team_id = $request->get('home_team_id');
                $match->away_team_id = $request->get('away_team_id');
                $match->match_time = $request->get('date');
                $match->status = $request->status[0][0];
                $match->save();

                Session::flash('message', 'Match registered sucessfully!');
                return Redirect()->route('matches.index');
            }
        }
    
        
        public function show(Match $match)
        {   
                    
                    //

        }
    
        
        public function edit(Match $match)
        { 
            $teams = Team::pluck('name','id');
            
                return View('pages.matches.edit')
                    ->with('match', $match)->with('teams',$teams);
        }
    
        
        public function update(Request $request, Match $match)
        {
            $rules = array(
                'home_team_id'       => 'bail|required|unique:table_matches',
                'away_team_id'       => 'bail|required|unique:table_matches',
            );

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return Redirect()->back()
                    ->withErrors($validator)->with('error', 'invalid data');
            }else{            
                $match = new Match;
                $match->home_team_id = $request->get('home_team_id');
                $match->away_team_id = $request->get('away_team_id');
                $match->match_time = $request->get('date');
                $match->save();
                Session::flash('message', 'Changes saved sucessfully!');
                return Redirect()->route('matches.index');
            }
        }
    
        
        public function destroy(Match $match)
        {   
            $match->delete();
            return redirect()->route('matches.index');
        }

        public function addScore(Match $match)
        {   
            $teams = Team::pluck('name','id');
                
            $players = Player::select(DB::raw("CONCAT(first_name,' ',last_name) AS name"),'id')
            ->where('team_id', $match->home_team_id)->orWhere('team_id',$match->away_team_id)
            ->pluck('name', 'id');
        
            return View('pages.matches.addScore')
            ->with('match', $match)
            ->with('teams', $teams)
            ->with('players', $players);
        }
        
        public function updateScore(Request $request,$id)
        {   
            $goals=$request->get('goals');
    
            try{
                DB::beginTransaction();
                $match = Match::find($id);
    
                foreach ($goals as $keys => $goal) {
                    $score = new Goal;
                    $score->match_id = $id;
                    $score->player_id = $goal['player_id'];
                    $score->match_time = $goal['time'];
                    $score->save();
                }

                $match->status = 1;
                $match->save();
    
                DB::commit();
            } catch (\Exception $e){
                DB::rollback();
                return redirect()->back()->with('error', 'Failed to update scores');
            }
            
            return Redirect()->route('matches.index')->with('success', 'Goals stored in the Match Sucessfully!');
        }
        
    }
    