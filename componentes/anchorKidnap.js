$(document).ready(function(){
  $('.anchor').each(function() {
      var href = $(this).attr('href');
      $(this).attr('href','about:blank');
      $(this).attr('jshref',href);
  });

  $('.anchor').bind('click', function(e){
    e.stopImmediatePropagation();           
    e.preventDefault();
    e.stopPropagation();
    var href= $(this).attr('jshref');
    if (!e.metaKey && e.ctrlKey)
        e.metaKey = e.ctrlKey;
    if(!e.metaKey){
        location.href= href;
    }
    return false;
  })
});