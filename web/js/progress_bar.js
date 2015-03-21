jQuery(document).ready(function(){
	progressBar = {
		countElem : 0,
		loadedElem : 0,
		
		init: function() {
			
			//initialisation
			this.countElem = $('img').length;
			
			// permet d'avoir accès à la class dans la fonction each
			var that = this;
			
			//parcours des elements a prendre en compte pour le chargement
			$("img").each(function() {
				$(this).on('load error', function(){
						that.loadedElem++;
						that.updateProgressBar();
					});
			
			});
			
			// permet d'éliminer les img non load car déjà dans le cache
			$('#progressBarInside').stop().animate({
				width :  100 + '%'
			}, 0);
			
		},
		
		updateProgressBar : function() {
			
			
			$('#progressBarInside').stop().animate({
				width :  (this.loadedElem / this.countElem) * 100 + '%'
			}, 0);
		}
	}

	progressBar.init();

	// Quoi qu'il arrive une fois la fenêtre totalement chargé :
	// mettre a 100% et effacer au bout d'1 sec
	$(window).load(function(){
		$('#progressBarInside').stop().animate({
				width :  100 + '%'
			}, 0).delay(1000).hide(0);
	});

});