$(document).ready(function() {

   $('.hidden').hide().removeClass('hidden');

   $('.edit-user').on('click',function(){
         e=this.dataset.userId;
         login=this.dataset.userLogin;
         $('#edit-login').val(login);
         $('#edit-login-id').val(e);
         $('#edit-user').slideDown('slown');
   });

   $('.edit-genre').on('click',function(){
         e=this.dataset.genreId;
         name=this.dataset.genreName;
         $('#genre-name').val(name);
         $('#genre-id').val(e);
         $('#edit-genre').slideDown('slown');
   });

   setTimeout(function(){
      var e=$('.alert');
      if (e.length>0){
         e.slideUp("slow");
      }
      }, 2000);

   $(".delete-form").on('submit', function(e) {
      if (!confirm("Czy jesteś pewien?")) {
         e.preventDefault();
      }
   });

});
