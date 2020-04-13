<tr>

	<td>{{$ad->id}}</td>
	<td>{{$ad->business->user->name}}</td>
	<td>{{$ad->business->name}}</td>
	<td>{{$ad->city->name ?? ""}}</td>
	<td>{{$ad->state->name ?? ""}}</td>
	<td>{{$ad->plan_detail->pd_days}} days</td>
	<td><img src="{{$ad->image_url}}" width="60"></td>
	<td>
		<a class="btn btn-danger del_lang" data-id="{{$ad->id }}" onclick="delLangFunction()"><i class="fas fa-times" style="color: #fff;"></i></a>
		<a class="btn btn-warning" data-toggle="modal" data-target="#sentmail-popup{{$ad->id }}" href="javascript:;"><i class="fa fa-envelope" style="color: #fff"></i></a>
	</td>
	<!-- sent-email -->
	<div id="sentmail-popup{{$ad->id}}" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="popup" aria-hidden="true"> 
		<div class="modal-dialog">

			<!-- Modal content-->
			<form action="{{route('SendEmailManagerBusiness')}}" method="post" accept-charset="utf-8">
				@csrf
				<input type="hidden" name="business_id" value="{{$ad->business->id}}">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" style="position: absolute;right: 0;top: 0;"><i class="fas fa-times-circle"></i></button>
						<h2 style="text-align: center;">Sent message to manager business</h2>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<input class="form-control" type="text" name="subject" value="" placeholder="Subject">
							<span class="bg-danger color-palette">{{$errors -> first('subject')}}</span>
						</div>
						<div class="form-group">
							<textarea class="form-control" name="message" placeholder="Message"></textarea>
							<span class="bg-danger color-palette">{{$errors -> first('message')}}</span>
						</div>
					</div>
					<div class="modal-footer">
						<div class="firstWindow" style="width: 100%">
							<button type="submit" class="btn btn-default " data-dismiss="modal" >Cancel</button>
							<button type="submit" class="btn btn-primary " >send</button>
						</div>
					</div>
				</div>
			</form>

		</div>
	</div>
	<!-- end sent-email -->
</tr>