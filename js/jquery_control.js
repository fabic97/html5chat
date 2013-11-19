jQuery(document).ready(function($){ 
    
    var eventType = 'mousedown touchstart';
    
    if (window.navigator.msPointerEnabled)
      eventType = 'MSPointerDown';

    $('#closes').bind(eventType, function () {
      $('#sidebar').animate({ width: 'hide', duration: '1000'});
      $('#closes').hide();
      $('#opens').show();
      $('#tabtitle').html("Chat");
    });
    $('#opens').bind(eventType, function () {
      $('#onlinelist').animate({ width: 'hide', duration: '1000'});
      $('#closel').hide();
      $('#openl').show();
      $('#tabtitle').html("Chat");
      $('#sidebar').animate({ width: 'show', duration: '1000'});
      $('#opens').hide();
      $('#closes').show();
      $('#tabtitle').html("Einstellungen");
    });
});

jQuery(document).ready(function($){ 
    
    var eventType = 'mousedown touchstart';
    
    if (window.navigator.msPointerEnabled)
      eventType = 'MSPointerDown';

    $('#closel').bind(eventType, function () {
      $('#onlinelist').animate({ width: 'hide', duration: '1000'});
      $('#closel').hide();
      $('#openl').show();
      $('#tabtitle').html("Chat");
    });
    $('#openl').bind(eventType, function () {
      $('#sidebar').animate({ width: 'hide', duration: '1000'});
      $('#closes').hide();
      $('#opens').show();
      $('#tabtitle').html("Chat");
      $('#onlinelist').animate({ width: 'show', duration: '1000'});
      $('#openl').hide();
      $('#closel').show();
      $('#tabtitle').html("Onlineliste");
      whoisonline();
    });
});