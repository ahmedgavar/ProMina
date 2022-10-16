@extends('layouts.app')
@section('content')
{{-- logout --}}
<form method="POST" action="{{ route('users.logout') }}">
    @csrf
    <button type="submit"  class="btn btn-primary" style="margin-right: 10%">Logout</button>
  </form>
<div class="template" style="display: flex;flex-direction: row-reverse">
{{-- right side --}}

    <div class="app-content content" style="width: 70%;margin-right: 8%">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">

                    <h3 class="content-header-title">المستخدمين والألبومات </h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                </li>
                                <li class="breadcrumb-item active">الألبومات
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- DOM - jQuery events table -->
                <section id="dom">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header" style="margin-right: 300px">
                                    <a href="albums/create" class="btn btn-primary "> إنشاء ألبوم</a>
                                    <br><br>

                                    <h4 class="card-title">  كل الألبومات </h4>
                                    <a class="heading-elements-toggle"><i
                                            class="la la-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                            <li><a data-action="close"><i class="ft-x"></i></a></li>
                                        </ul>
                                    </div>
                                </div>

                                @include('includes.alerts.success')
                                @include('includes.alerts.error')

                                <div class="card-content collapse show">
                                    <div class="card-body card-dashboard">
                                        <table
                                            class="table display nowrap table-striped table-bordered">
                                            <thead class="">
                                            <tr>
                                                <th>المؤلف</th>
                                                <th>البريد الالكتروني </th>
                                                <th>الألبوم </th>

                                                <th>الإجراءات</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            @isset($albums )
                                                @foreach($albums as $album)
                                                    <tr>
                                                        <td>{{$album -> user->username}}</td>
                                                        <td>{{$album->user -> email}}</td>
                                                        <td>
                                                            {{$album ->name}}
                                                        </td>

                                                        <td>
                                                            <div class="btn-group" role="group"
                                                                 aria-label="Basic example">
                                                                 <a href="{{ route('albums.show',$album->id ) }}"
                                                                   class="btn btn-outline-primary btn-min-width box-shadow-3 mr-1 mb-1">عرض </a>
                                                                 <a href="{{ route('albums.edit',$album->id ) }}"
                                                                   class="btn btn-outline-primary btn-min-width box-shadow-3 mr-1 mb-1" style="margin: 0px 20px">تعديل </a>
                                                                 <a href="{{ route('albums.destroy',$album->id ) }}"
                                                                    class="btn btn-danger btn-min-width box-shadow-3 mr-1 mb-1 to_deletes"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#deleteModal"
                                                                   data-id="{{$album->id}}">حذف </a>

                                                            </div>
                                                        </td>

                                                    </tr>

                                                @endforeach
                                            @endisset


                                            </tbody>
                                        </table>
                                        <div class="justify-content-center d-flex">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </section>
            </div>
        </div>

    </div>
    {{-- left side --}}
    <div>
    </div>
    </div>


@stop
@section('delete_modal')
<!-- Modal -->
<div class="modal fade my_large_model" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">حذف ألبوم </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

          <form class="delete-form"
          @method('DELETE')
          @csrf>

             <div class="modal-body">
                <h5>هل تريد حذف الصور من الألبوم أم نقلها إلي سلة المهملات</h5>

                <input type="hidden" name="delete_name" id="delete_name">

              </div>

              <div class="modal-footer">
                <button type="submit" id="move_btn" class="btn btn-secondary">نقل</button>
                <button type="submit" id="delete_btn{{ $album->id }}" class="btn btn-danger">حذف</button>
              </div>
          </form>


      </div>
    </div>
  </div>

@stop
@section('script')
<script>

  // delete
  var job_id;

    $(document).on('click','.to_deletes',function(){
         job_id = $(this).attr('data-id');
        $('#delete_name').val(job_id);

    //    delete

    });

    $('#delete_btn'+job_id).submit(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type:'DELETE',
            url:"albums/" + job_id,
        });
            $.ajax({
                beforeSend:function(){
                    $('#delete_btn'+job_id).text('Deleting...');
                },
            success:function(data)
            {
                setTimeout(function(){
                    $('#deleteModal').modal('hide');

                $('body').removeClass('modal-open');
                $('.modal-backdrop').remove();
                }, 1000);
            }
        });
    });




</script>
@stop

