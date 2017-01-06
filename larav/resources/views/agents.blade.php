@extends('layouts.app')

@section('title')
	Agents
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
				   	<h3>Agents
				   		<a href="{{ url('add-agent') }}" role="button" class="btn btn-primary pull-right">
	  						<span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add Agent
						</a>
					</h3>
				</header>
				<div class="message">@include('includes.message-block')</div>
			   @foreach($agents as $agent)
			   <div class="agent">
			   <div class="right clearfix">
			   			<a href="{{ url('/property-list', ['id' => $agent->id]) }}"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span></a>
			   			<a href="{{ url('/edit-agent', ['id' => $agent->id]) }}"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a> 
                    	<a data-href="{{ url('/delete-agent', ['id' => $user->id]) }}" data-toggle="modal" data-target="#agent-delete" role="button"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span> </a>
                    </div>
			   		<div class="left clearfix">
                        <a href="{{ url('/edit-agent',['id' => $agent->id]) }}">
	                	<img src="{{ url('/agent-logo',['filename' => $agent->logo])}}" alt="" class="img-responsive"></a>
	                	<p>{{ $agent->name }}</p>
	                	<p>Location: {{ $agent->location }}</p>
	                	<p>Tel: {{ $agent->contact }}</p>
	                	<p>Email: {{ $agent->email }}</p>
                    </div>
                    
			   </div>
			   @endforeach

			   <div class="center">
				   	<div class="pagination"> {{ $agents->links() }} </div>
			   </div>
			</div>   
		</div>
	</div>
</div>

<div class="modal fade" id="agent-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Confirm Delete</h4>
            </div>
            
            <div class="modal-body">
                <p>You are about to delete an agent, this procedure is irreversible.</p>
                <p>Do you want to proceed?</p>
                <p class="debug-url"></p>
            </div>
                
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <a class="btn btn-danger btn-ok">Delete Account</a>
            </div>
        </div>
    </div>
</div>
@endsection
 
