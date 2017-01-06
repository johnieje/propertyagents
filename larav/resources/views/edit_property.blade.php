@extends('layouts.app')

@section('title')
	Edit Property
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
				<h3>Edit > {{ $property->name }}
				   	<a href="{{ url('property-list',['id' => $agent->id]) }}" role="button" class="btn btn-warning pull-right">
	  					<span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> Back to Properties
					</a>
				</h3>
			</header>  
			@include('includes.message-block')
				<form action="{{ url('/property-update') }}" method="post" enctype="multipart/form-data">
	              {!! csrf_field() !!}
	              <input type="hidden" name="property_id" value="{{ $property->id }}">
	              <input type="hidden" name="agent_id" value="{{ $agent->id }}">
	              <div class="form-group">
	                <label for="email">Agent: </label>
	                {{ $agent->name }}
	              </div>
	              
	              	<div class="form-group">
		                <label for="name">Propety Name</label>
		                <input type="text" class="form-control" id="name" name="name" aria-describedby="nameHelp" placeholder="Add property name" value="{{  $property->name }}">
	              	</div>

	              	<div class="form-group">
		                <label for="name">Description</label>
		                <textarea class="form-control" name="description" id="description" rows="5" placeholder="Add property description">{{  $property->description }}</textarea>
	              	</div>

	              	<div class="form-group">
		            	<label for="name">Status</label>
		            	<select class="form-control" name="status" id="status">
		            		<option selected="selected disabled" class="hideoption" value="{{ $property->status }}">
		            			@if( $property->status == 0)
		            				Sold
		            			@else
		            				Available
		            			@endif
		            		</option>
						  	<option value="1">Available</option>
						  	<option value="0">Sold</option>
						</select>
		            </div>
	              	<button type="submit" class="btn btn-primary">Save Changes</button>
          		</form>  
            </div>
		</div>
	</div>
</div>

@endsection
