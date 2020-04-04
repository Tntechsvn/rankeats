<tr>
	<td>{{$ad->id}}</td>
	<td>{{$ad->business->user->name}}</td>
	<td>{{$ad->business->name}}</td>
	<td>{{$ad->city->name ?? ""}}</td>
	<td>{{$ad->state->name ?? ""}}</td>
	<td>{{$ad->plan_detail->pd_days}} days</td>
	<td><img src="{{$ad->image_url}}" width="60"></td>
	<td>action</td>
</tr>