@extends('adminlte::page')

@section('title', 'Rankeats')

@section('content_header')
    <h1>List Reviews</h1>
    <p>Manage list  reviews</p>
    <div class="card-header">     
      <div class="card-tools">
        <form action="{{route('getListBusinessReviews')}}" method="get">
          <div class="input-group input-group-sm" style="width: 150px;">
            <input type="text" name="keyword" id="keyword" value="@if($keyword){{$keyword}}@endif" class="form-control float-right" placeholder="Search">

            <div class="input-group-append">
              <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
            </div>
          </div>
        </form>
      </div>
    </div>
@stop
@section('content')
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!--/.col (right) ------------------------------------------------------------------------------------------>
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <div class="card-tools">
                  {{$start}}-{{$record}}/{{$total_record}}
                  <div class="btn-group float-right">
                    <button type="button" class="btn btn-default btn-sm left" <?php if(!isset($_GET['page'])){echo "disabled";}?>>
                      <i class="fa fa-chevron-left "></i>
                    </button>
                    <button type="button" class="btn btn-default btn-sm right" <?php if(isset($_GET['page']) && $_GET['page'] > 0){if($_GET['page'] >= ceil($total_record/10)){echo "disabled";}}?>>
                      <i class="fa fa-chevron-right "></i>
                    </button>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0  mailbox-messages">
                <table class="table table-hover ">
                  <thead>
                    <tr>
                      <th>Add Date</th>                      
                      <th>Reviewer</th>
                      <th>Eat</th>
                      <th>Business Name</th>
                      <th>State</th>
                      <th>City</th>
                      <th>Review</th>
                      <th>Manage</th>
                    </tr>
                  </thead>
                  <tbody>                   
                    @if(count($list_reviews) > 0)
                    @foreach($list_reviews as $data)
                                  
                    <tr>
                      @php
                        $date = date("m-d-Y",strtotime($data -> created_at))                      
                      @endphp
                      <td>{{$date}}</td>
                      <td><a href="{{route('user.profile',['id'=> $data ->user_id])}}">{{$data -> name_user}}</a></td>
                      <td>{{$data -> category_name}}</td>
                      <td><a href="{{$data -> business->permalink()}}">{{$data -> businesses_name}}</a></td>                     
                      <td>{{$data -> business->location->state}}</td> 
                      <td>{{$data -> business->location->city}}</td> 
                      <td>{{$data -> description}}</td>
                      <td>
                       <a class="btn btn-danger del_lang" data-id="{{$data->review_id }}" onclick="delLangFunction()"><i class="fas fa-times" style="color: #fff;"></i></a>
                      </td>
                    </tr>
                    @endforeach
                    @else
                    <tr>
                      <td><span class="tag tag-success">No Data</span></td>
                    </tr>
                    @endif                    
                  </tbody>
                </table>
              </div>
              
            </div>
            <!-- /.card -->
            <!-- /.card-body -->
              <div class="card-header">
                <div class="card-tools">                  
                  {!!$list_reviews -> appends(request()->except('page')) -> links()!!}
                </div>
              </div>
          </div>

        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
@stop
@section('adminlte_js')
<script>
  function delLangFunction() {
    var r = confirm("You want to delete review?");
    if (r == true) {
      $(document).on('click', '.del_lang',function(e){
        var arr = [];
        arr.push($(this).data('id'));
        var selected_values = arr.join(",");

        var link = "{{route('deleteReview')}}";
        $.ajax({
          headers:{
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          type:'post',
          url: link,
          data: 'list_id='+selected_values,
          success:function(data){
            console.log(data);
            if(data.success){
              window.location.reload();
              alert(data.message);
            }else{
              alert(data.message);
            }
          }
        });
      });
    }
  }
</script>
<script type="text/javascript">
  /*paginate ********************** //*/

  $(".left").click(function(){
    var pg = @if(isset($_GET['page'])){{$_GET['page']}}@else{{'1'}}@endif;
    var kw = $('#keyword').val();
    if(kw != ''){
      var key = '&keyword=' +(kw);
    }else{
      var key = "";
    }
    if(pg == 1){
      var str_page = "?page=1";
    }else{
      if(pg >= 2){
        var str_page = "?page=" + (pg - 1);
      }else{
        var str_page = "";
      }
    }
    var current_link = <?php echo "'".strtok($_SERVER["REQUEST_URI"],'?')."'";?>;
    window.location.href = current_link + str_page + key;
  });

  $(".right").click(function(){
    var pg = @if(isset($_GET['page'])){{$_GET['page']}}@else{{'1'}}@endif;
    var kw = $('#keyword').val();
    if(kw != ''){
      var key = '&keyword=' +(kw);
    }else{
      var key = "";
    }
    var page_paginate = <?php $page_paginate = ceil($total_record/10); echo $page_paginate; ?>;
    if((pg + 1)>page_paginate){
      var str_page = "?page=" + (pg);
      
    }else{
      var str_page = "?page=" + (pg + 1);
    }


    var current_link = <?php echo "'".strtok($_SERVER["REQUEST_URI"],'?')."'";?>;
    window.location.href = current_link + str_page + key;
  });
</script>
@stop