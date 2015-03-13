jQuery(document).ready(function ($) {

	testAjax = {
		
		// selecteur pour le click type
		baliseType : '#test_type a',

		// selecteur pour le click type
		baliseGenre : '#test_genre a',

		// selecteur de la partie ou sont afficher les news
		baliseTest : "#test_container",
		
		getGenre: function(event) {
			var res = "";
			$(this.baliseGenre + "[value=1]").each(function() {
				res += $(this).attr('href') + ':';
			});
			alert(res);
			return res;
		}, // function getGenre()
		testByType: function(event) {
			
			// permet d'avoir accès à la class dans la fonction click
			var that = this;
			
			$(that.baliseType).click(function(e) {
				e.preventDefault();
			
				//generation de l'url
				var genre = testAjax.getGenre() // recuperation des genres selectionnés

				var url = $(this).attr('href')  + "/" + genre;
				alert(url);
			//permet de modifier url en passant des données
			history.pushState({key: 'value'}, 'titre', url);
			alert('dgdsg');
				$.ajax({
					type: 'GET',
					url: url,
					timeout: 3000,
					success: function (data) {
						$(that.baliseTest).html(data);
					},   
					error: function() {
  						alert('La requête n\'a pas abouti');
					}
				})

			});

			
		}, // function testByType()
		testByGenre: function(event) {
			
			// permet d'avoir accès à la class dans la fonction click
			var that = this;
			
			$(that.baliseGenre).click(function(e) {
				e.preventDefault();
				if($(this).attr('value') == 1) {
					$(this).attr('value', '0');
				} else {

					//générationd de l'url
					var url = "";
					if(document.location.pathname.slice(-1) != ":") {
						url = document.location.pathname + "/" + $(this).attr('href') + ":"
					} else {
						url = document.location.pathname + $(this).attr('href') + ":";
					}
					
					alert(url);
					//permet de modifier url en passant des données
					history.pushState({key: 'value'}, 'titre', url);

					$.ajax({
						type: 'GET',
						url: url,
						timeout: 3000,
						success: function (data) {
							$(that.baliseTest).html(data);
						},   
						error: function () {
							alert('La requête n\'a pas abouti');
						}
					})
				}
			});
		}, // function testByGenre()
		
		init : function() {
			// permet d'avoir accès à la class dans la fonction click
			var that = this;
		
			//evenement a écouter lors du changement de page par le navigateur (des qu'il y a un back ou un next dans l'historique avec info rentrer dans un pushState
			window.onpopstate = function(event) {
					alert(document.location.pathname);
						$.ajax({
							type: 'GET',
							url: document.location.pathname,
							timeout: 3000,
							success: function (data) {
								$(that.balisetest).html(data);
							},   
							error: function () {
								alert('La requête n\'a pas abouti');
							}
						})
			}
		} // init()
	
	} // class testAjax
	
	testAjax.init();
	testAjax.testByType();
	testAjax.testByGenre();

});