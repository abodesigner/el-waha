$(document).ready(function(){

	$(window).resize(function(){
		if ($(window).width() <= 480){
			$('.header,.logo,.menu-btn').removeClass('shrink');
		}
		else{
			$('.header,.logo,.menu-btn').addClass('shrink');
		}
});

	// Shrink Header When Scrolling Down
	var shrinkHeader = 300;

  		$(document).scroll(function() {
    		var scroll = getCurrentScroll();

				if ( scroll >= shrinkHeader ) {
           			$('.header,.nav-list,.logo,.menu-btn,.btn-line,.sidebar,.logo-sm').addClass('shrink');
				}
        		else {
            		$('.header,.nav-list,.logo,.menu-btn,.btn-line,.sidebar,.logo-sm').removeClass('shrink');
				}
			});
	function getCurrentScroll() {
    	return window.pageYOffset || document.documentElement.scrollTop;
    }



	/*
	** Menu button click event
	** function on('click',function(){});
	*/
	$('.menu-btn').on('click', function(){
		$('.sidebar').toggleClass('move-to-left');
	});


	/*
	** Focus & Blur on search input field
	*/

	$('#search-btn').on("focus", function(){
		$(this).removeAttr('placeholder');
	});

	$('#search-btn').on("blur", function(){
		if($(this).val() == ''){
            $(this).attr('placeholder' , " بحث عن طريق إسم الكتاب - العنوان - الكاتب");
            }
	});








});
