<footer class="main-footer">
  <div class="container">
    <div class="footer-center">
        @foreach($all_page as $data)
        	<a href="{{route('getPages',['id_page' => $data->slug])}}">{{$data -> page_title}}</a>
        @endforeach
        <a href="{{route('advertise')}}">Advertise</a>
        <a href="{{route('contact')}}">Contact Us</a>
    </div>

    <div class="footer-center copyright"> &#169; 2020 Rank Eats </div>
    
  </div>
  <!--container--> 
  
</footer>
<input type="hidden" name="login" value="{{route('postAjaxLogin')}}">
<input type="hidden" name="ajaxcitystate" value="{{route('ajaxCity')}}">

