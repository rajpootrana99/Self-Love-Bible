@extends('layouts.base')

@section('content')
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
        <div class="row mt-4">
            <div class="col-xl-6">

                <!--begin::Portlet-->
                <div class="kt-portlet">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                            <div class="kt-portlet__head-title">
                                Users
                            </div>
                        </div>
                    </div>
                    <div class="kt-portlet__body">

                        <!--begin::Section-->
                        <div class="kt-section">
                            <div class="kt-section__content">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th width="5%">#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th width="7%">Age</th>
                                        <th width="3%"><i class="flaticon2-delete"></i></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!--end::Section-->
                    </div>

                    <!--end::Form-->
                </div>

                <!--end::Portlet-->

            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteUser" tabindex="-1" role="dialog" aria-labelledby="deleteUserLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteUserLabel">Delete</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <form class="kt-form" method="post" id="deleteUserForm">
                    @csrf
                    @method('DELETE')
                    <div class="modal-body">
                        <input type="hidden" name="user_id" id="user_id">
                        <div class="kt-portlet__body">
                            <div class="form-group">
                                <label>Are you sure want to delete?</label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Yes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function (){

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            fetchUsers();

            function fetchUsers()
            {
                $.ajax({
                    type: "GET",
                    url: "fetchUsers",
                    dataType: "json",
                    success: function (response) {
                        $('tbody').html("");
                        $.each(response.users, function (key, user) {
                            $('tbody').append('<tr>\
                            <td>'+user.id+'</td>\
                            <td>'+user.name+'</td>\
                            <td>'+user.email+'</td>\
                            <td>'+user.age+'</td>\
                            <td><button value="'+user.id+'" style="border: none; background-color: #fff" class="delete_btn"><i class="flaticon2-delete"></i></button></td>\
                    </tr>');
                        });
                    }
                });
            }

            $(document).on('click', '.delete_btn', function (e) {
                e.preventDefault();
                var user_id = $(this).val();
                $('#deleteUser').modal('show');
                $('#user_id').val(user_id)
            });

            $(document).on('submit', '#deleteUserForm', function (e) {
                e.preventDefault();
                var user_id = $('#user_id').val();

                $.ajax({
                    type: 'delete',
                    url: 'user/'+user_id,
                    dataType: 'json',
                    success: function (response) {
                        if (response.status == 0) {
                            $('#deleteUser').modal('hide');
                        }
                        else {
                            fetchUsers();
                            $('#deleteUser').modal('hide');
                        }
                    }
                });
            });

        });
    </script>

@endsection
