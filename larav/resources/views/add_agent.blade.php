@extends('layouts.app')

@section('title')
	Add Agent
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
				   	<h3>Add Agents
				   		<a href="{{ url('agents') }}" role="button" class="btn btn-warning pull-right">
	  						<span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> List all agents
						</a>
					</h3>
				</header>
			   @include('includes.message-block')
				<form action="{{ url('/agent-save') }}" method="post" enctype="multipart/form-data">
	              {!! csrf_field() !!}
				   <div class="form-group">
			            <label for="name">Agent Name</label>
			            <input type="text" class="form-control" id="name" name="name" aria-describedby="nameHelp" placeholder="Enter Agent Name">
		            </div>
		            <div class="form-group">
			            <label for="name">Location</label>
			            <input type="text" class="form-control" id="location" name="location" aria-describedby="nameHelp" placeholder="Enter Address eg. city, road & building name">
		            </div>
		            <div class="form-group">
			            <label for="name">Contact</label>
			            <input type="text" class="form-control" id="contact" name="contact" aria-describedby="nameHelp" placeholder="Enter Agent Phone Number, eg. 0700001001">
		            </div>
		            <div class="form-group">
			            <label for="name">Email</label>
			            <input type="text" class="form-control" id="email" name="email" aria-describedby="nameHelp" placeholder="Enter Agent Email, eg. agent@email.dev">
		            </div>
		            <div class="form-group">
			            <label for="name">Website</label>
			            <input type="text" class="form-control" id="website" name="website" aria-describedby="nameHelp" placeholder="Enter Agent Website, eg. http://www.agentwebsite.com">
		            </div>
		            <div class="form-group">
			            <label for="name">Logo</label>
			            <input type="file" class="form-control-file" name="image" id="image" aria-describedby="fileHelp">
	                	<small id="fileHelp" class="form-text text-muted">Only jpeg/jpg format is allowed.</small>
		            </div>
			   		<button type="submit" class="btn btn-primary">Add Agent</button>
			   </form>
			   
            </div>
		</div>
	</div>
</div>
@endsection
