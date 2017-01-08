@extends('layouts.app')

@section('title')
	Account
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
					   	<h3>Listed Agents</h3>
					</header>
				</div>	
				<div class="message">@include('includes.message-block')</div>
				   @foreach($agents as $agent)
				   <div class="agent">
				   		<div class="follow_right clearfix">
				   			
							<button type="button" class="btn btn-success btn-sm">Follow</button>
				
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
@endsection
