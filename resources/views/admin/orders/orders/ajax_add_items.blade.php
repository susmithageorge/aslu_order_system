
	<table class="table table-condensed" id="item_list_table">
		<tr>
			<th>##</th>
			<th width="40%">Prod Name</th>
			<th width="15%">Quantity</th>
			<th>Remarks</th>
			<th width="10%"  class="hidden-480">Price</th>
		</tr>
		@for($i = 1; $i <= 25; $i++)
			@if($i > 5)
			<tr class="tr_list_items hidden_list" id="tr_list_items_{{$i}}" style="display:none;">
			@else
			<tr class="tr_list_items" id="tr_list_items_{{$i}}">
			@endif
				<td>{{$i}}</td>
				<td>
					<input type="hidden" value="{{$i}}" class="input_elements" />
					{{Form::select('prod_name[]', $products, Input::old('product_id'), array("class" => "form-control product_name_list selectpicker", "data-live-search"=>"true","style" => "width:98%;", "id"=>"prod_name_" . $i))}}
				</td>
				<td><input type="number" pattern="\d*" step="0.01" min="0" name="prod_qty[]"  class="form-control prod_qty_input show-menu-arrow"  id="prod_qty_{{$i}}" required="required" value="0.00" placeholder="Qty"/></td>
				<td><input type="text" name="prod_remark[]"  class="form-control"  id="prod_remark_{{$i}}"  placeholder="Remarks"/></td>
				<td  class="hidden-480">
					<input id="prod_price_{{$i}}" name="prod_price[]" type="text" class="price_box price_box_listing" value="0.00" />
				</td>
			</tr>
		@endfor
	</table>
	<hr/>
<script type="text/javascript">
  	/*$('.product_name_list').select2({
  	  	placeholder: "Select product",
  		allowClear: true
  	});*/
</script>
