
@extends('users.edit')


@section('charities')

<h5 class="text-center">Pick a Charity</h5>
	<div class="col-md-12"></div>
		<div class="col-md-12 text-center">	
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="row">
				    @foreach ($charities as $charity)
					    <div class="col-md-1 text-center">
						    <img src="{{$charity->user->profile_picture_link}}" height="100px" width="100px">{{link_to_action('DonorsController@addCharity','Add', array('charity_id' => $charity->id))}}<span> </span>{{$charity->charity_name}}
					    </div>
					    <div class="col-md-1"></div>
				    @endforeach
					</div> <!-- end row -->
				</div> <!-- end panel-body -->
			</div> <!-- end panel -->
			<div class="row">
				<div class="col-md-12 text-center">{{ $charities->links() }}</div> <!-- pagination -->
			</div> <!-- end row -->
</div> <!-- end class="col-md-12" -->
	<div class="col-md-3"></div>

@stop