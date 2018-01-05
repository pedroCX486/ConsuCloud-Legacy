$(document).ready(function () {
  $('a').click(function (e){  
    if (e.ctrlKey) {
        return false;
    }
  })
});