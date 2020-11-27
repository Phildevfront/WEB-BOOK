$(function () {

        $('#contact-form').submit(function(e){

            e.preventDefault();// supprime le comportement par default lorsque le formulaire est soumis
            $('.comments').empty();// vide tous les commentaires
            var postdata = $('#contact-form').serialize();

            $.ajax({
                type: 'POST',
                url: 'php/contact.php',
                data: postdata,
                dataType: 'json',
                success: function(result) {

                    if(result.isSuccess)
                    {
                        $("#contact-form").append("<p class='thanks'>Votre message a bien été envoyé. Merci de m'avoir contacté.</p>");
                        $("#contact-form")[0].reset();// remet les champs du formulaire a vide
                        
                    }
                    else
                    {
                        $("#firstname + .comments").html(result.firstnameError);// sinon renvoi message erreur pour chaque champ
                        $("#name + .comments").html(result.nameError);
                        $("#email + .comments").html(result.emailError);
                        $("#message + .comments").html(result.messageError);
                    }
                    
                }
                
            });

        });

})