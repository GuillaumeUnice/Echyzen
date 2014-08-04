jQuery(document).ready(function ($) {

	newsAjax = {
		
		// selecteur pour le click rubrique
		baliseRubrique : '#news_categorie a',
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


		
		newsCreateCommentaire : function() {
			// permet d'avoir accès à la class dans la fonction click
			var that = this;
			
			$('body').delegate(that.baliseShowMenu,'click',function(e) {
				var url = Routing.generate('admin_rubrique_create');
				alert('url');
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
			
			
			
			
			
			
			
			
			
			
		} // function newsCreateCommentaire()

	
	} // class newsAjax
	
	newsAjax.newsCreateRubrique();
	

});