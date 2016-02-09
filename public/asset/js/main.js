$(function(){
  "use strict";

  $('.datepicker').datepicker({
    "format": "yyyy-mm-dd",
    "clearBtn": true
  });

  $(".remove-btn").click(function(e){
    if(!window.confirm("Are you sure?"))
      e.preventDefault();
  });
});
