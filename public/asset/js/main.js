$(function(){
  "use strict";

  $('.datepicker').datepicker({
    "format": "yyyy-mm-dd",
    "clearBtn": true,
    // "isBuddhist": true
    "language": "th",
    // "beforeShowYear": function(input) {
      // console.log((input.getFullYear() + 543) + "");
    // }
  });

  $(".remove-btn").click(function(e){
    if(!window.confirm("Are you sure?"))
      e.preventDefault();
  });
});
