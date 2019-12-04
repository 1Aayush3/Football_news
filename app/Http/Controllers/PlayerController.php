<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use DB;
use App\Model\Player;
use App\Model\Team;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Validator;

class PlayerController extends Controller
{
  public function index()
    {
    
        $players = Player::with(['team'])->orderBy('first_name', 'asc')->get();
        return View('pages.players.index')
        ->with('players', $players);
    }

    
    public function create()
    {
        $teams = Team::pluck('name','id');
        return View('pages.players.create')
        ->with('teams',$teams);
    }

    
    public function store(Request $request)
    
    {
        $rules = array(
            'first_name'       => 'bail|required',
            'date'             => 'before_or_equal:today',
            
        );

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect()->back()
                ->withErrors($validator)->with('error', 'invalid data');
        }else{

            
            // store
         $player = new Player;
         $player->first_name = $request->get('first_name');
         $player->last_name = $request->get('last_name');
         $player->country = $request->get('country');
         $player->date = $request->get('date');
         $player->team_id = $request->get('team');
        //  $player->goals = $request->get('goals');
         $player->description = $request->get('desp');
         $player->save();
        //  $player->logo = $request->get('logo');
    
         Session::flash('message', 'Player registered sucessfully!');
         return Redirect()->route('players.index');
        }
    }

    
        public function show(Player $player)
        {
            
            $id = $player->team_id;
            
            $team = Team::find($id);
            $team = $team->name;
            
            return View('pages.players.show')
                ->with('player', $player)->with('team',$team);
        }

    
    public function edit(Player $player)
    { 
        $teams = Team::pluck('name','id');
         // show the edit form and pass the player
         return View('pages.players.edit')
             ->with('player', $player)->with('teams',$teams);
    }

   
    public function update(Request $request, Player $player)
   
    {
        $rules = array(
            'date'             => 'before_or_equal:today',
            
        );

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect()->back()
                ->withErrors($validator)->with('error', 'invalid data');
        }else{
         $player->first_name = $request->get('first_name');
         $player->last_name = $request->get('last_name');
         $player->country = $request->get('country');
         $player->date = $request->get('date');
         $player->team_id = $request->get('team_id'); 
        //  $player->goals = $request->get('goals');
         $player->description = $request->get('desp');
         $player->save();
         Session::flash('message', 'Changes saved sucessfully!');
         return Redirect()->route('players.index');
        }
    }

   
    public function destroy(Player $player)
    {   
        $player->delete();
        return redirect()->route('players.index');
    }
}
