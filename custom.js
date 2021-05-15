// JavaScript Document
function submitForm(id)
{
	$(id).on('submit',(function(e) {
		$(this).addClass('run_active');
		e.preventDefault();
		$.ajax({
        	url: "ajax.php",
			type: "POST",
			data:  new FormData(this),
			contentType: false,
    	    cache: false,
			processData:false,
			beforeSend: function() 
        {
			$('.run_active').next('.output').html('<div class="spinner-grow text-muted"><span class="sr-only">Loading...</span></div>');
        },  
        success: function(response)
        {
            $(id+'.run_active').next('.output').html(response);
			$(id+'.run_active').removeClass('run_active');
        }      
	   });
	}));
}
//end submit form function
$('#cloner').click(function(){
	$('.clone').clone().find('.form-control').val("").end().removeClass('clone').appendTo('#append').append('<div class="col-md-12"><a class="remover text-right" href="javascript:;">-Remove</a></div>');
});
//end cloner
$('body').on('click','.remover',function() {
	$(this).closest('.row').remove();
});
//end remover
