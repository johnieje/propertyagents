@extends('layouts.app')

@section('title')
	Account Settings
@endsection

@section('content')

<div class="container">
    <div class="row profile">
    <!-- ACCOUNT SIDEBAR -->
		@include('includes.account_sidebar')
		<!-- END ACCOUNT SIDEBAR -->
		<div class="col-md-9">
            <div class="profile-content">
			   Settings form
            </div>
		</div>
	</div>
</div>
@endsection
