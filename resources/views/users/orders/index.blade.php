@extends('users.users')
@section('content')
<!-- PAGE CONTENT BEGINS -->
<div class="container">
	<div class="row">
		<div class="col-md-11">
			<div class="panel panel-default">
				<div class="panel-heading">Your recent orders</div>

				<div class="panel-body">
						@include ('admin._partials.notifications')
						<!-- ./ notifications -->
								@if($orders->count() > 0)
									<table id="simple-table" class="table">
											<thead>
												<tr>
		                                            <th width="5%" class="hidden-480">#</th>
		                                            <th width="35%" >Name</th>
		                                            <th class="hidden-480">Dealer</th>
		                                            <th  width="15%">Created</th>
													<th width="5%" >Actions</th>
												</tr>
											</thead>
											<tbody>
												@foreach ($orders as $order)
	                                        	<tr  class="table-tr-bg-{{{$order->id}}}">
		                                            <td class="hidden-480">{{{ $order->id }}}</td>
		                                            <td>{{{ $order->name }}}</td>
		                                            <td class="hidden-480">{{{ $order->dealer->name }}}</td>
		                                            <td class="hidden-480">{{{ date('F d, Y', strtotime($order->created_at)) }}}</td>
		                                            <td style="width:15%">
		                                            	<div class="btn-group" style="width:100%;">
			                                            			<a data-toggle="tooltip"  class="btn btn-link btn-sm"title="View order" href="{{URL::to('/users/orders/' . $order->id . '/view')}}" ><i class="fa fa-eye"></i></a>
			                                            			{{ Form::open(array('method'=> 'DELETE', 'route' => array('userordersdestroy', $order->id))) }}
				                                            			<button  data-placement="left" data-toggle="tooltip" title="Delete order" type="submit" class="btn btn-link btn-sm" onclick="return confirm('Do you want to delete this order ?')"><i class="fa fa-trash-o"></i></button>
															    	{{ Form::close() }}
			                                                </div>
		                                            </td>
		                                        </tr>
	                                        @endforeach
											</tbody>
										</table>
	                                    {{ $orders->render() }}
	                                @else
	                                	<div class="alert alert-warning" role="alert">You dont have any orders.</div>
	                                @endif    
	                                <a href="{{ URL::to('users/orders/new') }}" class="btn btn-info btn-sm pull-right">Add new order</a>
	                            </div><!-- /.box -->
	                            
							</div>
						</div>

					</div>

</div>

@endsection