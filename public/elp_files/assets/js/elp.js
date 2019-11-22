 $(function () {
      // Replace the <textarea id="editor1"> with a CKEditor
      // instance, using default configuration.
      CKEDITOR.replace('editor1')
    });

// $(document).on('click', '#select_candidat', function(){
//           var id = $(this).data("id");
//           if (id != '') {
//             $.ajax({
//                 url:"http://localhost/ec/public/user/CV",
//                 method:"GET",
//                 data:{id:id},
//                 success:function(data){
//                   $('#CvModal').modal('show');
//                   $('#CV').html(data);
//                   console.log(data);
//                 }
//               });
//             var url = "http://localhost/ec/public/user/CV/"+id;
//             $.get(url, function(data){
//                 var tr = "popo";
//                 $('#CV').empty();
//                 $('#CvModal').modal('show');
//                 $('#CV').append('<a href="http://localhost/ec/public/cv/'+data.cv+'"><img src="http://localhost/ec/public/cv/'+data.cv+'" with="200" height="200"></a>');
//             });
//           }
// });          

$(document).ready(function(){
      $('#questions_titre').keyup(function(){
          var query = $(this).val();
          if (query != '') {
              var _token = $('input[name="_token"]').val();
              $.ajax({
                url:"http://localhost/ec/public/user/fetch",
                method:"POST",
                data:{query:query, _token:_token},
                success:function(data){
                  $('#questions_list').fadeIn();
                  $('#questions_list').html(data);
                }
              });
          }
      });

      // $(document).on('click', 'li', function(){
      //     $('#questions_titre').val($(this).text());
      //     $('#questions_titre').fadeOut();
      // });
	
      $('#updateCv').click(function(){
        $('#cvModal').modal('show');
      });

      $('#updateAvatar').click(function(){
        $('#avatarModal').modal('show');
      });

      $('#booster').click(function(){
        $('#boosterModal').modal('show');
      });

});