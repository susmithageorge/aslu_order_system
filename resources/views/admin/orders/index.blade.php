@extends('layouts.admin')
@section('page_heading','Listing orders - Admin')
@section('section')
<!-- PAGE CONTENT BEGINS -->
<div class="row" id="server_listing">
@include('admin._partials.notifications')
@if($orders)
	<div class="col-sm-12">
		<table id="simple-table" class="table table-bordered">
											<thead>
												<tr>
		                                            <th width="5%" class="hidden-480">#</th>
		                                            <th width="15%" >Name</th>
		                                            <th width="10%" >User</th>
		                                            <th class="hidden-480">Dealer</th>
		                                            <th  width="10%">Status</th>
		                                            <th  width="15%">Created</th>
													<th width="5%" >Actions</th>
												</tr>
											</thead>
											<tbody>
												@foreach ($orders as $order)
	                                        	<tr  class="table-tr-bg-{{{$order->id}}}">
		                                            <td class="hidden-480">{{{ $order->id }}}</td>
		                                            <td>{{{ $order->name }}}</td>
		                                            <td class="hidden-480">{{{ $order->user->name }}}</td>
		                                            <td class="hidden-480">{{{ $order->dealer->name }}}</td>
		                                            <td class="hidden-480">
		                                            	@if($order->sent_flag == 0)
		                                            		<span class="label label-danger">Unsent</span>
		                                            	@else
		                                            		<span class="label label-success">Sent&nbsp;&nbsp;</span>
		                                            	@endif
		                                            </td>
		                                            <td class="hidden-480">{{{ date('F d, Y', strtotime($order->created_at)) }}}</td>
		                                            <td style="width:15%">
		                                            	<div class="btn-group" style="width:100%;">
					                                            	@if($order->sent_flag == 0)
					                                            		<a data-toggle="tooltip"  class="btn btn-link btn-sm"title="Change status" href="{{URL::to('/admin/orders/' . $order->id . '/change_status')}}" onclick="return confirm('Do you want to change status to Sent?')"><i class="fa fa-exchange"></i></a>
					                                            	@else
					                                            		<a data-toggle="tooltip"  class="btn btn-link btn-sm"title="Change status" href="{{URL::to('/admin/orders/' . $order->id . '/change_status')}}" onclick="return confirm('Do you want to change status to Unsent?')"><i class="fa fa-exchange"></i></a>
					                                            	@endif
			                                            			
			                                            			<a data-toggle="tooltip"  class="btn btn-link btn-sm"title="View order" href="{{URL::to('/admin/orders/' . $order->id . '/view')}}" ><i class="fa fa-folder-open"></i></a>
			                                            			{{ Form::open(array('method'=> 'DELETE', 'route' => array('adminordersdestroy', $order->id))) }}
				                                            			<button  data-placement="left" data-toggle="tooltip" title="Delete order" type="submit" class="btn btn-link btn-sm" onclick="return confirm('Do you want to delete this order ?')"><i class="fa fa-trash-o"></i></button>
															    	{{ Form::close() }}
			                                                </div>
		                                            </td>
		                                        </tr>
	                                        @endforeach
											</tbody>
										</table>
	                                    {{ $orders->render() }}
	                                </div>
	
	@else
	    <div class="alert alert-warning " role="alert">
	        <i class="fa fa-warning"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  There is nothing to show.
	    </div>
	@endif	
</div>
@endsection
