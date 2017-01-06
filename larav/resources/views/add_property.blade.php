@extends('layouts.app')

@section('title')
	Add Property
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
				<h3>Add Property:
				   	<a href="{{ url('property-list',['id' => $agent->id]) }}" role="button" class="btn btn-warning pull-right">
	  					<span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> List all Properties
					</a>
				</h3>
			</header>  
			@include('includes.message-block')
				<form action="{{ url('/propertysave') }}" method="post" enctype="multipart/form-data">
	              {!! csrf_field() !!}
	              <input type="hidden" name="agent_id" value="{{ $agent->id }}">
	              <div class="form-group">
	                <label for="email">Agent: </label>
	                {{ $agent->name }}
	              </div>
	              
	              	<div class="form-group">
		                <label for="name">Propety Name</label>
		                <input type="text" class="form-control" id="name" name="name" aria-describedby="nameHelp" placeholder="Add property name">
	              	</div>

	              	<div class="form-group">
		                <label for="name">Description</label>
		                <textarea class="form-control" name="description" id="description" rows="5" placeholder="Add property description"></textarea>
	              	</div>

					
	              	<div class="form-group">
	                	<label for="image">Upload a photo</label>
	                	<input type="file" class="form-control-file" name="image" id="image" aria-describedby="fileHelp">
	              	</div>
	              	<button type="submit" class="btn btn-primary">Save</button>
          		</form>  
            </div>
		</div>
	</div>
</div>

@endsection
