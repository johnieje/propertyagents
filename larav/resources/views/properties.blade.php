@extends('layouts.app')

@section('title')
	Property list
@endsection

@section('content')

<div class="container">
    <div class="row profile">
    <!-- ACCOUNT SIDEBAR -->
		@include('includes.account_sidebar')
		<!-- END ACCOUNT SIDEBAR -->
		<div class="col-md-9">
            <div class="profile-content">
	            <div class="row_hearder">
	            	<header>
					   	<h3>Properties for {{ $agent->name }}
					   		<a href="{{ url('add-property',['id' => $agent->id]) }}" role="button" class="btn btn-primary pull-right">
		  						<span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add Property
							</a>
						</h3>
					</header>
	            </div>
				<div class="message">@include('includes.message-block')</div>
				
					<div class="table-responsive">
						<table class="table table-striped">
					    <thead>
					      <tr>
					        <th>Name</th>
					        <th>Description</th>
					        <th>Created</th>
					        <th>Status</th>
					        <th>Actions</th>
					      </tr>
					    </thead>
					    <tbody>
					    @foreach($properties as $property)
					      <tr>
					        <td>{{ $property->name }}</td>
					        <td>{{ $property->description }}</td>
					        <td>{{ Timediff::timeDiff($property->created_at) }}</td>
					        <td>
					        	@if( $property->status == 0)
				            		Sold
				            	@else
				            		Available
				            	@endif
					        </td>
					        <td>
					        	<a href="{{ url('/edit-property', ['agent_id' => $agent->id, 'property_id' => $property->id]) }}"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a> 
		                    	<a data-href="{{ url('/delete-property', ['id' => $property->id]) }}" data-toggle="modal" data-target="#property-delete" role="button"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span> </a>
					        </td>
					      </tr>
					    @endforeach
					    </tbody>
					  </table>
					</div>
				
			  <div class="center">
				   	<div class="pagination"> {{ $properties->links() }} </div>
			  </div>
			</div>   
		</div>
	</div>
</div>
<div class="modal fade" id="property-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Confirm Delete</h4>
            </div>
            
            <div class="modal-body">
                <p>You are about to delete a property, this procedure is irreversible.</p>
                <p>Do you want to proceed?</p>
                <p class="debug-url"></p>
            </div>
                
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <a class="btn btn-danger btn-ok">Delete Property
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
 
