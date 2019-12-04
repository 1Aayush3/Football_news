<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use DB;
use App\Model\Team;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Validator;

class TeamController extends Controller
{
  public function index()
    {
      $teams = Team::orderBy('name', 'asc')->simplePaginate(10);
      // dd($teams)

        // $teams = Team::orderBy('name', 'asc')->get();
        // foreach($teams as $key => $value){
        //     $value->image = $value->getFirstMediaUrl('images');
        //     $teams[] = $value;
        return View('pages.teams.index')
            ->with('teams', $teams);
    }

    
    public function create()
    {
      return View('pages.teams.create');
    }

    
    public function store(Request $request)
    {
        // dump($request->file('logo')->getClientOriginalName());
        // dd($request->all());
        $rules = array(
            'name'       => 'bail|required|unique:teams|max:255',
            'date'       => 'before_or_equal:today',
        );

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect()->back()
                ->withErrors($validator)->with('error', 'invalid data');
        }else{            
         
         $team = new Team;

         if($request->file('logo')){
            $logoName = time().'-'.$request->file('logo')->getClientOriginalName();

            if (!file_exists(public_path('/images'))) {
              mkdir(public_path('/images'), 0755, true);
            }

            if($request->file('logo')->move(public_path('/images'), $logoName)){
                $team->logo = $logoName;       
            }
         }
         

         $team->name = $request->get('name');
         $team->countries = $request->get('country');
         $team->formation = $request->get('date');
         $team->description = $request->get('desp'); 
         $team->save();
        //  return response()->json(['success'=>'Team registered sucessfully!']);
 
        //  $team->addMedia($request->logo)->toMediaCollection('images');

         Session::flash('message', 'Team registered sucessfully!');
         return Redirect()->route('teams.index');
        }
    }

    
    public function show(Team $team)
    {
            //
    }

    
    public function edit(Team $team)
    {
         $team = Team::find($id);
         // show the edit form and pass the team
         return View('pages.teams.edit')
             ->with('team', $team);
    }
    
    public function update(Request $request, Team $team)
    {
      $rules = array(
        'name'       => "required|unique:teams,name,$team->id",
        'date'       => 'before_or_equal:today',
    );

    $validator = Validator::make($request->all(), $rules);

    if ($validator->fails()) {
        return Redirect()->back()
            ->withErrors($validator)->with('error', 'invalid data');
    }else{  
          
      if($request->file('logo')){
        $logoName = time().'-'.$request->file('logo')->getClientOriginalName();

        if (!file_exists(public_path('/images'))) {
          mkdir(public_path('/images'), 0755, true);
        }

        $oldFileName = $team->logo;

        if($request->file('logo')->move(public_path('/images'), $logoName)){
            $team->logo = $logoName;       
        }

        if($oldFileName && file_exists(public_path('/image').'/'.$oldFileName)){
          unlink(public_path('/image').'/'.$oldFileName);  
        }

     }      
      $team->name = $request->name;
      $team->countries = $request->get('country');
      $team->formation = $request->get('date');
      $team->description = $request->get('desp');
    //   $team->media()->delete($request->id);
      $team->update();
    } 
    //   die('delete');
    //   $team->addMedia($request->logo)->toMediaCollection('images'); 
      Session::flash('message', 'Changes stored sucessfully!');
      return Redirect()->route('teams.index');
    }

   
    public function destroy(Team $team)
    {   
        $team->delete();
        return redirect()->route('teams.index');
    }




    // public function index()
    //  {    
    //    return view('pages.index');
    //  }

    //  public function create(Request $request)
    //  {       
    //   $team = null;
    //   if (isset($request->id))
    //   {
       
    //     $team = team::find($request->id);
    //   }
    //   // die('here');
    //     return view('pages.teams.create', compact('team'));
  
     
      
    //  }

    //  public function store(Request $request)
    //  {    
    //   $team = new team(); 
    //   $team->name = $request->name;
    //   $team->save();
    //   return view('pages.teams.list');
    //  }

    //  public function list()
    //  {      
    //   // $teams = DB::select('select * from teams');   
    //   $teams = team::get(); 
    //   // dd($teams);
    //   return view('pages.teams.list', compact('teams'));
    //  }

    //  public function delete($id)
    //  {        
    //   // dd($id);
    //   $teams = team::find($id);
    //     $teams->delete();
    //     return redirect()->route('list');
    //     // return view('pages.listTeams');
    //  }

    //  public function edit(Request $request)
    // { 
    //   // dd($request);
    //   $team = team::find($request->id);
    //   $team->name = $request->name;
    //   $team->save(); 
    //   return redirect()->route('list');
    // }


}
