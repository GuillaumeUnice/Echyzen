jQuery(document).ready(function ($) {

	newsDisplay = {
		
		// selecteur pour le contenu de chaque news
		baliseNewsContenu : '.news_contenu',

		// selecteur pour le titre de chaque news
		baliseNewsTitre : '.news .news_titre',

		// selecteur pour le span "lire la suite" de chaque news
		baliseNewsSuite : '.news .newsShow',
		
		init : function() {
			$('.news_contenu').each(function( index ) {
            	$(this).hide();
        	});
		}, // init()

		newsShow: function(event) {
			
	        $('.news .news_titre').on('click', function() {
	            
	            $(this).parent().find('.news_contenu').slideToggle("slow");
	            if($(this).parent().find('.intro_contenu').is(":visible")) {
	                $(this).parent().find('.intro_contenu').hide();
	            } else {    
	                $(this).parent().find('.intro_contenu').show();  
	            }
	        });
	        $('.news .newsShow').on('click', function() {
	            var parentNode = $(this).closest('.news');
	            parentNode.find('.news_contenu').slideToggle("slow");
	            if(parentNode.find('.intro_contenu').is(":visible")) {
	                parentNode.find('.intro_contenu').hide();
	            } else {    
	                parentNode.find('.intro_contenu').hide();
	            }

	        });

			
		} // function newsShow()
	} // class newsDisplay
	
	newsDisplay.init();
	newsDisplay.newsShow();

	

});