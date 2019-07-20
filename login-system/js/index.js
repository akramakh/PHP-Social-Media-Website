$('.form').find('input, textarea').on('keyup blur focus hover', function (e) {
  
  var $this = $(this),
      label = $this.prev('label');

	  if (e.type === 'keyup') {
			if ($this.val() === '') {
          label.removeClass('active highlight');
        } else {
          label.addClass('active highlight');
        }
    } else if (e.type === 'blur') {
    	if( $this.val() === '' ) {
    		label.removeClass('active highlight'); 
			} else {
		    label.removeClass('highlight');   
			}   
    } else if (e.type === 'focus') {
      
      if( $this.val() === '' ) {
    		label.removeClass('highlight'); 
    		label.addClass('active'); 
			} 
      else if( $this.val() !== '' ) {
		    label.addClass('active highlight');
		    
			}
    }

});

$('.tab a').on('click', function (e) {
  
  e.preventDefault();
  
  $(this).parent().addClass('active');
  $(this).parent().siblings().removeClass('active');
  
  target = $(this).attr('href');

  $('.tab-content > div').not(target).hide();
  
  $(target).fadeIn(600);
  
});



$('#dob').focus(function (){
        $(this).attr('type', 'date');
    }, function (){
        $(this).attr('type', 'text');
    });
    

    // Convert Password Field To Text Field
    var passField = $('.password');
    $('.show-pass').hover(function (){
        passField.attr('type', 'text');
    }, function (){
        passField.attr('type', 'password');
    });