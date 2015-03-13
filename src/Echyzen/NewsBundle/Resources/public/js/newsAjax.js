/**
* TODO ajout de style css avant et après ajax call
*	resoudre le scope ppour atteindre baliseNews depuis la fonction ajaxSuccess
*	Appliquer sur tout les selecteur Rubrique/motcle/date
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

			$('#news_container').html(data);
			//newsAjax.baliseNews.html(data);
			// modifification de l'URL
			history.pushState({key: 'value'}, 'titre', url);
		},
		newsByRubrique: function(event) {			
			// permet d'avoir accès à la class dans la fonction click
			var that = this;
			
			$(that.baliseRubrique).click(function(e) {
			e.preventDefault();
				var url = $(this).attr('href')
				alert(url);
				$.ajax({
					type: 'GET',
					url: url,
					timeout: newsAjax.ajaxTimeout,//6000,
					success: function (data) {
						//$(that.baliseNews).html(data);
						newsAjax.test(data, url);
					},  
					error: function () {
						alert('La requête n\'a pas abouti');
					}
				});
			});			
		},/* // function newsByRubrique()

		newsByMotCle: function(event) {
			
			// permet d'avoir accès à la class dans la fonction click
			var that = this;
			
			$(that.baliseMotCle).click(function(e) {
			e.preventDefault();
			history.pushState({key: 'value'}, 'titre', $(this).attr('href'));
			alert($(this).attr('href'));
				$.ajax({
					type: 'GET',
					url: $(this).attr('href'),
					timeout: 3000,
					success: function (data) {
						
						$(that.baliseNews).html(data);
						
					},   
					error: function () {
						alert('La requête n\'a pas abouti');
					}
				})
			});
		}, // function newsByMotCle()*/
		
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
			
			// permet d'avoir accès à la class dans la fonction click
			var that = this;
			
			//evenement a écouter lors du changement de page par le navigateur 
			//(dès qu'il y a un back ou un next dans l'historique avec info rentrer dans un pushState
			window.onpopstate = function(event) {

					// si il y a eu un appel ajax sur l'URL demandé
					if(newsAjax.nbAjaxCall != 0) {
						newsAjax.nbAjaxCall--;
						alert(document.location.pathname);
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
					} else {
						alert('llllll');
						newsAjax.nbAjaxCall++;
					}
					
				//}
			}
		}
	
	} // class newsAjax
	
	newsAjax.init();
	newsAjax.newsByRubrique();
	//newsAjax.newsByMotCle();
	newsAjax.newsCreateCommentaire();
	

});