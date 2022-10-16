@extends('layouts.app')
@section('content')

<!-- Modal -->
<div class="modal fade my_large_model" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">حذف ألبوم </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

          <form class="delete-form">

             <div class="modal-body">
                <h5>هل تريد حذف الصور من الألبوم أم نقلها إلي سلة المهملات</h5>

                <input type="hidden" name="delete_name" id="delete_name">

              </div>

              <div class="modal-footer">
                <button type="button" class="btn btn-secondary">نقل</button>
                <button type="button" class="btn btn-danger">حذف</button>
              </div>
          </form>


      </div>
    </div>
  </div>

@stop
@section('script')
<script>

$(document).ready(function()
{
    // delete post
    $('#deleteModal').on('show.bs.modal',function(event){

        $(this).appendTo("body");


        var button=$(event.relatedTarget);

        var postDeleteId=button.data('delete_id');

       $('#delete_name').val(postDeleteId);



        // delete using ajax
        $('.delete-form').on('submit', function(e) {
            e.preventDefault();

            $.ajax({
                type: 'post',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: 'users/posts/'+postDeleteId,
                data: {
                  '_method': 'delete'
                },
                success: function (response) {
                    // first step
                        console.log(response);
                        $('#deleteModal').modal('hide');

                         $('body').removeClass('modal-open');
                         $('.modal-backdrop').remove();

                          //  second step :show all posts
                        $.ajax({
                            method: 'GET',
                            url: 'http://localhost:8000/users/posts',
                            dataType:'json',

                            success: function (response)
                             {
                                const all_posts=response.responseText;

                                console.log(response);
                                $('.show_all_posts .container').html('');
                                $('.show_all_posts .container').html(all_posts);



                            }
                            ,error: function(reject){
                                console.log("reject",reject);
                                const all_posts=reject.responseText;
                                $('.show_all_posts .container').html('');

                                $('.show_all_posts .container').html(all_posts);
                            }

                        });
                        // third message to user
                        $('#success_msg_delete').text(response.message);

                        $('#success_msg_delete').show();
                        setTimeout(function(){
                            $('#success_msg_delete').hide();// or fade, css display however you'd like.
                         }, 5000);

                }
            });
          })

        } );

});
</script>
@stop
