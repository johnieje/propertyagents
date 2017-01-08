<?php

namespace App\Http\Controllers;

use App\Agent;
use App\User;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Pagination\Paginator;

class AgentController extends Controller
{
    public function getAgents(){
    	$agents = Agent::orderBy('created_at', 'DESC')->paginate(5);
    	return view('agents', ['agents' => $agents, 'user' => Auth::user()]);
    }

    public function account(){
    	$agents = Agent::orderBy('created_at', 'DESC')->paginate(5);
    	return view('account', ['agents' => $agents, 'user' => Auth::user()]);
    }

    public function getAgentLogo($filename){
       $file = Storage::disk('agents')->get($filename);
       return new Response($file, 200);
   }

    public function getAddAgent(){
		return view('add_agent', ['user' => Auth::user()]);
    }

    public function getEditAgent($id){
    	$agent = Agent::where('id', $id)->first();
		return view('edit_agent', ['agent' => $agent,'user' => Auth::user()]);
    }

    public function getDeleteAgent($id){
		$agent = Agent::where('id', $id)->first();

		if($agent->delete()){
			$message_success = "Agent deleted successfully";
			return redirect()->route('agents')->with(['message_success' => $message_success]);
		}
   }

	public function postSaveAgent(Request $request){
		$this->validate($request, [
			'name' => 'required|min:2|max:255',
			'location' => 'required|max:255',
			'contact' => 'required|regex:/(0)[0-9]{9}/',
			'email' => 'required|email|max:255',
			'website' => 'regex:/^(http?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/',
			'logo' => '',
		]);


		$agent = new Agent;

		$agent->name = $request['name'];
		$agent->location = $request['location'];
		$agent->contact = $request['contact'];
		$agent->email = $request['email'];
		$agent->website = $request['website'];

		if($request->hasFile('image')){
        
	        $file = $request->file('image');
	        $file_name = $request['name'] . '-logo' . '-' .'.jpg';
	        $agent->logo = $file_name;
	        Storage::disk('agents')->put($file_name, File::get($file));
        
      	}else{
      		$agent->logo = "default.jpg";
      	}

		if($agent->save()){
			$message_success = "Agent has been added successfully!";
			return redirect()->route('agents')->with(['message-success' => $message_success]);
		}

	}

   public function postUpdateAgent(Request $request){
   		$this->validate($request, [
			'name' => 'required|min:2|max:255',
			'location' => 'required|max:255',
			'contact' => 'required|regex:/(0)[0-9]{9}/',
			'email' => 'required|email|max:255',
			'website' => 'regex:/^(http?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/',
			'logo' => '',
		]);

		$agent = Agent::find($request['agent_id']);

		$agent->name = $request['name'];
		$agent->location = $request['location'];
		$agent->contact = $request['contact'];
		$agent->email = $request['email'];
		$agent->website = $request['website'];
		$agent->status = $request['status'];

		if($request->hasFile('image')){
	        $file = $request->file('image');
	        $file_name = $request['name'] . '-logo' . '-' .'.jpg';
	        $agent->logo = $file_name;
	        Storage::disk('agents')->put($file_name, File::get($file));
        
      	}

      	if($agent->update()){
			$message_success = "Agent information has been updated successfully!";
			return redirect()->route('edit-agent',['id' => $request['agent_id']])->with(['message-success' => $message_success]);
		}else{
			$message_fail = "Error occurred. Could not update agent information! Please try again!";
			return redirect()->route('edit-agent',['id' => $request['agent_id']])->with(['message-fail' => $message_fail]);
		}
   }
 
}
