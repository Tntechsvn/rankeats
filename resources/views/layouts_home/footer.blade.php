<footer class="main-footer">
  <div class="container">
    <div class="footer-center">
        @foreach($all_page as $data)
        	<a href="{{route('getPages',['id_page' => $data->slug])}}">{{$data -> page_title}}</a>
        	&nbsp; | &nbsp;
        @endforeach
    </div>

    <div class="footer-center copyright"> &#169; 2020 Rank Eats </div>
    
  </div>
  <!--container--> 
  
</footer>
<input type="hidden" name="login" value="{{route('postAjaxLogin')}}">