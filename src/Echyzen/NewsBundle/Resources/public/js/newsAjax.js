/**
* TODO ajout de style css avant et après ajax call
*	resoudre le scope ppour atteindre baliseNews depuis la fonction ajaxSuccess
*	
*
**/
jQuery(document).ready(function ($) {

	newsAjax = {
		
		// selecteur pour le click rubrique
		baliseRubrique : '#rubrique a',
		// selecteur pour le clik date
		baliseArchive : '#archive a',
		// selecteur pour le clik mot-cle
		baliseMotCle : '#mot_cle a',

		// selecteur pour le fonctionnement du TopMenu
		menuTop : document.getElementById( 'top_menu' ),
		showTop : document.getElementsByClassName( 'showTop' ),
		body : document.body,
		// selecteur pour ma propre utilisation du TopMenu
		baliseShowMenu : '.showTop',
		baliseMenuContainer : '#showTopContainer',
		// class pour afficher le loading
		classLoading : 'loading',
		
		// selecteur de la partie ou sont afficher les news
		baliseNews : "#news_container",
		
		// selecteur pour reconnaitre les formulaires soumis par ajax
		baliseAjaxForm : '.ajax_form',

		// nombre d'appel ajax effectué initialiser à -1
		// pour permettre de supprimer la mise en cache de la première page par les navigateurs
		// en cas de back puis forward clique
		nbAjaxCall : -1,

		ajaxTimeout : 4000,

		test: function(data, url) {
			newsAjax.nbAjaxCall++;

			$(this.baliseNews).html(data);
			//newsAjax.baliseNews.html(data);
			// modifification de l'URL
			history.pushState({key: 'value'}, 'titre', url);
		},
		// fonction requête ajax pour des affichage des news par Rubrique/Date/Mot Cle
		newsBy: function(event) {			
			// permet d'avoir accès à la class dans la fonction click
			var that = this;
			
			$(that.baliseRubrique).add($(that.baliseMotCle)).add($(that.baliseArchive)).click(function(e) {
				e.preventDefault();
				var options = {};
				//alert($('#news_container article').length);
				$($('#news_container article').get().reverse()).each(function(i, obj) {
			   		//$(this).fadeOut( "slow" );
			   		
			   		$( this ).delay(75 * i).hide( 'drop', options, 1200 );
			   	
				});
	
				var lil = $(this)
				setTimeout(function(){
   					$(that.baliseNews).html('<div class="loading" style="height : 130px; width: 130px;"></div>');




				
				
				var url = $(lil).attr('href')
				//alert(url);
				//alert(url + "?nocache="+Date.now());
				$.ajax({
					type: 'GET',
					url: url, //+ "?nocache="+Date.now(),
					timeout: newsAjax.ajaxTimeout,
					success: function (data) {
						newsAjax.test(data, url);
					},  
					error: function () {
						alert('La requête n\'a pas abouti');
					}
				});






				}, ($('#news_container article').length*75 + 1200));
				//$(that.baliseNews).delay($('#news_container article').length*75 + 1200).html('<div class="loading"></div>');


			});			
		},
		newsCreateCommentaire : function() {
			// permet d'avoir accès à la class dans la fonction click
			var that = this;
			
			//$(that.baliseShowMenu).click(function() {
			$('body').delegate(that.baliseShowMenu,'click',function(e) {
				var url = Routing.generate('news_create_commentaire', { id: this.value });/*'{{ path("news_create_commentaire", {'id': 'id'}) }}'; */

                $(that.baliseMenuContainer).append('<div class="' + that.classLoading + '"></div>');
                $.ajax({
                    type: 'GET',
                    url: url,
                    timeout: 3000,
                    success: function (data) {
						$('.loading').hide();
						$(that.baliseMenuContainer).append(data);
                    },   
                    error: function () {
                        alert('La requête n\'a pas abouti');
                    }
                })

                classie.toggle( this, 'active' );
				classie.toggle( that.menuTop, 'cbp-spmenu-open' );
				classie.toggle( that.showTop, 'disabled' );
			}); // baliseShowMenu.click()
			
			$(that.baliseMenuContainer).delegate(that.baliseAjaxForm,'submit',function(e) {
				// empecher le comportement classique
				// ici la soumission du submit
				e.preventDefault();
				
				// pour pouvoir sélectionner plus facilement les attr du form
				var $this = $(this);
				
				var DATA = 'echyzen_newsbundle_commentaire[contenu]=' +
				$("#echyzen_newsbundle_commentaire_contenu").val() +
				 '&echyzen_newsbundle_commentaire[_token]=' + 
				 $("#echyzen_newsbundle_commentaire__token").val() +
				 '&echyzen_newsbundle_commentaire[auteur]=' + $("#echyzen_newsbundle_commentaire_auteur").val();
				var formdata = $($this).serialize();
				$.ajax({
					url: $this.attr('action'),
					type: $this.attr('method'),
					data: formdata,

					success: function(data) {
						$(that.baliseMenuContainer).html(data);
					},
					error: function () {
						alert('La requête n\'a pas abouti');
					}
				});
				
			});
			
		}, // function newsCreateCommentaire()
		init : function() {
			alert(newsAjax.nbAjaxCall);
			window.onload = function(e) {
  history.replaceState({myTag: true}, null, document.URL);
}
			// permet d'avoir accès à la class dans la fonction click
			var that = this;
			
			//evenement a écouter lors du changement de page par le navigateur 
			//(dès qu'il y a un back ou un next dans l'historique avec info rentrer dans un pushState
			window.onpopstate = function(event) {

					// si il y a eu un appel ajax sur l'URL demandé
					if(newsAjax.nbAjaxCall != 0) {
						newsAjax.nbAjaxCall--;
						//alert(document.location.pathname);
						$.ajax({
							type: 'GET',
							url: document.location.pathname,
							timeout: 3000,

							success: function (data) {
								$(that.baliseNews).html(data);
							},   
							error: function () {
								alert('La requête n\'a pas abouti');
							}
						})
					// c'est la page par laquelle on a acceder au module de news donc on doit la recharger en entier
					} else if (newsAjax.nbAjaxCall == 0)  {
						newsAjax.nbAjaxCall++;
						window.location.href = document.location.pathname;
					} 
			}
			/*$("nav a").click(function(e) {
				e.preventDefault();
				alert(document.location.pathname);
 
				history.replaceState( {key: 'value'} , 'titre', document.location.pathname+"?nocache="+Date.now() );
				alert($(this).attr('href'));
				window.location.href = $(this).attr('href');
			});*/
		}
	
	} // class newsAjax
	
	newsAjax.init();
	newsAjax.newsBy();
	newsAjax.newsCreateCommentaire();
	

});