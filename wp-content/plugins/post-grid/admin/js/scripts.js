jQuery(document).ready(function($)
	{


		
		$(document).on('click', '.post-grid-reset-taxonomy', function()
			{
				$('.post_grid_taxonomy_category').prop('checked', false);
				$('.post_grid_taxonomy').prop('checked', false);
				
				
			})

		
		
		
		$(document).on('click', '.post_grid_content_source', function()
			{	
				var source = $(this).val();
				var source_id = $(this).attr("id");
				
				$(".content-source-box.active").removeClass("active");
				$(".content-source-box."+source_id).addClass("active");
				
			})
		
		
		
	
		
		
		
		
		jQuery(".post_grid_taxonomy").click(function()
			{
				


				var taxonomy = jQuery(this).val();
				
				jQuery(".post_grid_loading_taxonomy_category").css('display','block');

						jQuery.ajax(
							{
						type: 'POST',
						url: post_grid_ajax.post_grid_ajaxurl,
						data: {"action": "post_grid_get_taxonomy_category","taxonomy":taxonomy},
						success: function(data)
								{	
									jQuery(".post_grid_taxonomy_category").html(data);
									jQuery(".post_grid_loading_taxonomy_category").fadeOut('slow');
								}
							});

		
			})
		
	
 		
		

		$(document).on('click', '.post-grid-builder .canvas .remove', function()
			{
				$(this).parent().parent().remove();
				
			})






		$(document).on('click', '.post-grid-builder .canvas .header', function()
			{
				
				if($(this).parent().hasClass('active'))
					{
						$(this).parent().removeClass('active');
					}
				else
					{
						$(this).parent().addClass('active');
					}
				
			})




	});	







