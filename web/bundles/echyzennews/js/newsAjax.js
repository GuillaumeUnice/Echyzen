jQuery(document).ready(function ($) {

	newsAjax = {
		
		// selecteur pour le click rubrique
		baliseRubrique : '#rubrique a',
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
		
		newsByRubrique: function(event) {
			
			// permet d'avoir accès à la class dans la fonction click
			var that = this;
			
			$(that.baliseRubrique).click(function(e) {
			e.preventDefault();
			//var url = Routing.generate('news_by_rubrique', { id: this.value });
			alert($(this).attr('value'));
			alert($(this).attr('href'));
			//permet de modifier url en passant des données
			history.pushState({key: 'value'}, 'titre', $(this).attr('href'));
				$.ajax({
					type: 'GET',
					url: $(this).attr('href'),//'/Symfony/web/app_dev.php/news/7/rubrique', //url,
					timeout: 3000,
					success: function (data) {
						alert('lol');
						$(that.baliseNews).html(data);
					},   
					error: function () {
						alert('La requête n\'a pas abouti');
					}
				})

			});

			
		}, // function newsByRubrique()
		
		newsCreateCommentaire : function() {
			// permet d'avoir accès à la class dans la fonction click
			var that = this;
			
			//$(that.baliseShowMenu).click(function() {
			$('body').delegate(that.baliseShowMenu,'click',function(e) {
				var url = Routing.generate('news_create_commentaire', { id: this.value });/*'{{ path("news_create_commentaire", {'id': 'id'}) }}'; */

                $(that.baliseMenuContainer).html('<div class="' + that.classLoading + '"></div>');
                $.ajax({
                    type: 'GET',
                    url: url,
                    timeout: 50000,
                    success: function (data) {
						$('.loading').hide();
						$(that.baliseMenuContainer).html(data);
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
		
			//evenement a écouter lors du changement de page par le navigateur (des qu'il y a un back ou un next dans l'historique avec info rentrer dans un pushState
			window.onpopstate = function(event) {
				/*if(event.state == null) {
					$.ajax({
						type: 'GET',
						url: 'http://localhost/Nouveau%20dossier/testbis.html',
						timeout: 3000,
						success: function (data) {
							$('.container').html(data);
						},   
						error: function () {
							alert('La requête n\'a pas abouti');
						}
					})
					alert('se marche');
				} else {*/
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
				//}
			}
		}
	
	} // class newsAjax
	
	newsAjax.init();
	newsAjax.newsByRubrique();
	newsAjax.newsCreateCommentaire();
	

});