<?php

namespace App\Http\Controllers;

use App\Property;
use App\Agent;
use App\User;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Pagination\Paginator;
use Timediff;

class PropertyController extends Controller
{
    public function getAddProperty($id){
    	$agent = Agent::where('id', $id)->get()->first();
    	return view('add_property',['agent' => $agent, 'user' => Auth::user()]);
    }

    public function postPropertySave(Request $request){
    	$this->validate($request, [
    		'name' => 'required|max:255',
    		'description' => 'required|max:500',
    	]);

    	$property = new Property;

    	$property->name = $request['name'];
    	$property->description = $request['description'];
    	$property->agent_id = $request['agent_id'];

    	if($property->save()){
    		$message_success = "New property has been added successfully.";
    		return redirect()->route('property-list',['id' => $request['agent_id']])->with(['message-success' => $message_success]);
    	}else{
    		$message_fail = "Sorry! An error has occured. Property has not been added. Please try again!";
    		return redirect()->route('add-property',['id' => $request['agent_id']])->with(['message-fail' => $message_fail]);
    	}
    }

    public function getPropertyList($id){
    	$agent = Agent::where('id', $id)->get()->first();

    	$property = Property::where('agent_id', $agent->id)->orderBy('created_at', 'DESC')->paginate(10);

    	return view('properties', ['properties' => $property, 'agent' => $agent, 'user' => Auth::user()]);
    }

    public function getEditProperty($agent_id, $property_id){
    	$agent = Agent::where('id', $agent_id)->get()->first();

    	$property = Property::where('id', $property_id)->get()->first();

    	return view('edit_property', ['property' => $property, 'agent' => $agent, 'user' => Auth::user()]);
    }

    public function postUpdateProperty(Request $request){
    	$this->validate($request, [
            'name' => 'required|max:255',
            'description' => 'required|max:500',
        ]);

        $agent = Agent::where('id', $request['agent_id'])->get()->first();

        $property = Property::where('id', $request['property_id'])->get()->first();

        $property->name = $request['name'];
        $property->description = $request['description'];
        $property->status = $request['status'];

        if($property->update()){
            $message_success = "Property information has been updated successfully.";
            return redirect()->route('property-list',['id' => $request['agent_id'], 'user' => Auth::user() ])->with(['message-success' => $message_success]); 
        }else{
            $message_fail = "Sorry! An error has occured. Property information has not been updated. Please try again!";
            return view('edit_property', ['property' => $property, 'agent' => $agent, 'user' => Auth::user()])->with(['message-fail' => $message_fail]);
        }
    }

    public function getDeleteProperty($id){
        $property = Property::where('id', $id)->get()->first();

        if($property->delete()){
            $message_success = "Property has been deleted successfully";
            return redirect()->route('property-list', ['id' => $property->agent_id, 'user' => Auth::user() ])->with(['message-success' => $message_success]);
        }
    }
}
