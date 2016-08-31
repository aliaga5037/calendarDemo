@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 ">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    <div id="scheduler_here" class="dhx_cal_container" style='width:700px; height:500px; padding:10px;'>
    <div class="dhx_cal_navline">
        <div class="dhx_cal_prev_button">&nbsp;</div>
        <div class="dhx_cal_next_button">&nbsp;</div>
        <div class="dhx_cal_today_button"></div>
        <div class="dhx_cal_date"></div>
        <div class="dhx_cal_tab" name="day_tab" style="right:204px;"></div>
        <div class="dhx_cal_tab" name="week_tab" style="right:140px;"></div>
        <div class="dhx_cal_tab" name="month_tab" style="right:76px;"></div>
    </div>
    <div class="dhx_cal_header"></div>
    <div class="dhx_cal_data"></div>    
    <script type="text/javascript">
        // scheduler.config.xml_date="%Y-%m-%d %H:%i";
        scheduler.init('scheduler_here', new Date(),"month");
                var events = [
                @foreach($dals as $cals)

{id:{{$cals->id}}, text:"{{$cals->text}}",   start_date:"{{$cals->start_date}}",end_date:"{{$cals->end_date}}"},

@endforeach

];
scheduler.parse(events, "json");



    </script>   
</div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
     var last=scheduler.getEvents().length;
    var obj=scheduler.getEvents();
    // console.log(obj)
    jQuery(document).ready(function($) {
        $.ajaxSetup({
      headers:{
      'X-CSRF-TOKEN':'{{ csrf_token() }}'
      }
      })

            $('body').on('click', '.dhx_save_btn_set', function(event) {

            var last=scheduler.getEvents().length;
            var obj=scheduler.getEvents()[last-1];

            var end_date=(obj.end_date.getMonth()+1)+'/'+obj.end_date.getDate()+'/'+obj.end_date.getFullYear()+' '+obj.end_date.getHours()+':'+obj.end_date.getMinutes();
            var start_date= (obj.start_date.getMonth()+1)+'/'+obj.start_date.getDate()+'/'+obj.start_date.getFullYear()+' '+obj.start_date.getHours()+':'+obj.start_date.getMinutes();



                    scheduler.attachEvent("onEventCollision", function (ev, evs){
                    alert("Sorry, you're allowed to have just 1 event per time slot");
                    return true;})
             
          
                $.ajax({    
                url: '/aa',
                type: 'POST',
                dataType: 'text',
                data:{text:obj.text,start:start_date,end:end_date},
            })
            .fail(function() {
                console.log("error");
            })
            .always(function() {
                console.log("complete");
            });
        
            
        

            
         });
    });
</script>
@endsection
