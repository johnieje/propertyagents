@extends('layouts.app')

@section('title')
	Users
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
				   	<h3>Users</h3>
				</header>
				<div class="message">@include('includes.message-block')</div>
			   <table class="table table-striped">
			    <thead>
			      <tr>
			        <th>Name</th>
			        <th>Email</th>
			        <th>Created</th>
			      </tr>
			    </thead>
			    <tbody>
			    @foreach($users as $appuser)
			      <tr>
			        <td>{{ $appuser->name }}</td>
			        <td>{{ $appuser->email }}</td>
			        <td>{{ $appuser->created_at }}</td>
			      </tr>
			    @endforeach
			    </tbody>
			  </table>
			  <div class="center">
				   	<div class="pagination"> {{ $users->links() }} </div>
			  </div>
			</div>   
		</div>
	</div>
</div>

@endsection
 
