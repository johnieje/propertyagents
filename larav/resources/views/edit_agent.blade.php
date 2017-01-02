@extends('layouts.app')

@section('title')
	Edit Agent
@endsection

@section('content')

<div class="container">
    <div class="row profile">
    <!-- ACCOUNT SIDEBAR -->
		@include('includes.account_sidebar')
		<!-- END ACCOUNT SIDEBAR -->
		<div class="col-md-9">
            <div class="profile-content">
			   <header>
				   	<h3>Edit Agent: {{ $agent->name }}
				   		<a href="{{ url('agents') }}" role="button" class="btn btn-warning pull-right">
	  						<span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> List all agents
						</a>
					</h3>
				</header>
			   @include('includes.message-block')
				<form action="{{ url('/agent-update') }}" method="post" enctype="multipart/form-data">
	              {!! csrf_field() !!}
				   <div class="form-group">
			            <label for="name">Agent Name</label>
			            <input type="text" class="form-control" id="name" name="name" aria-describedby="nameHelp" placeholder="Enter Agent Name" value="{{ $agent->name }}">
		            </div>
		            <div class="form-group">
			            <label for="name">Location</label>
			            <input type="text" class="form-control" id="location" name="location" aria-describedby="nameHelp" placeholder="Enter Address eg. city, road & building name" value="{{ $agent->location }}">
		            </div>
		            <div class="form-group">
			            <label for="name">Contact</label>
			            <input type="text" class="form-control" id="contact" name="contact" aria-describedby="nameHelp" placeholder="Enter Agent Phone Number, eg. 0700001001" value="{{ $agent->contact }}">
		            </div>
		            <div class="form-group">
			            <label for="name">Email</label>
			            <input type="text" class="form-control" id="email" name="email" aria-describedby="nameHelp" placeholder="Enter Agent Email, eg. agent@email.dev" value="{{ $agent->email }}">
		            </div>
		            <div class="form-group">
			            <label for="name">Website</label>
			            <input type="text" class="form-control" id="website" name="website" aria-describedby="nameHelp" placeholder="Enter Agent Website, eg. http://www.agentwebsite.com" value="{{ $agent->website }}">
		            </div>
		            <div class="form-group">
			            <label for="name">Logo</label>
			            <input type="file" class="form-control-file" name="image" id="image" aria-describedby="fileHelp">
	                	<small id="fileHelp" class="form-text text-muted">{{ $agent->logo }}</small>
		            </div>
		            <input type="hidden" name="agent_id" value="{{ $agent->id }}" >
			   		<button type="submit" class="btn btn-primary">Save changes</button>
			   </form>
			   
            </div>
		</div>
	</div>
</div>

@endsection
