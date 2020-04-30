$(document).ready(function(){
       // occur the event when click on seat
       $('.bearth').click(function(){
        var seat = $(this).attr('data-seat');
        alert('Seat no '+seat+ ' is available ');
        
       });

       // Occur the event when  select book the seat on change
       $('.selectSeat').change(function(){
        var seat = $(this).val();
        if(seat>0){
        var persionHtml = '';
        var btn ='<div class="form-group"><button type="submit" name="submitDetails" class="btn-info">Submit</button></div>';
        for(let i=1;i<=seat;i+=1){
            persionHtml += '<div class="form-group"> <label for="usr">Enter Persion - '+i+' </label> <input type="text" name="name[]" class="form-control" required></div>';
        }

        $('.bindDynamicPersion').html(persionHtml+btn);
       }else{
        $('.bindDynamicPersion').html('');
       }
       })
  });