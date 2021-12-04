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
                                Notifications
                            </div>
                        </div>
                        <div class="kt-align-left mt-3">
                            <a href="" data-toggle="modal" data-target="#addNotification" id="addNotificationButton" class="btn btn-primary" style="float:right;"><i class="flaticon2-add-1"></i> New Notification </a>
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
                                            <th>Title</th>
                                            <th>Body</th>
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

    <div class="modal fade" id="addNotification" tabindex="-1" role="dialog" aria-labelledby="addNotificationLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addNotificationLabel">Notification</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <form class="kt-form" method="post" id="addNotificationForm">
                    @csrf
                    <div class="modal-body">
                        <div class="kt-portlet__body">
                            <div class="form-group">
                                <label>Title</label>
                                <input type="text" class="form-control" name="title" id="title" placeholder="Enter Notification Title">
                                <span class="form-text error-text title_error" style="color: red"></span>
                            </div>
                            <div class="form-group">
                                <label>Body</label>
                                <textarea class="form-control" name="body" id="body" rows="4"></textarea>
                                <span class="form-text error-text body_error" style="color: red"></span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Send</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteNotification" tabindex="-1" role="dialog" aria-labelledby="deleteNotificationLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteNotificationLabel">Delete</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <form class="kt-form" method="post" id="deleteNotificationForm">
                    @csrf
                    @method('DELETE')
                    <div class="modal-body">
                        <input type="hidden" name="notification_id" id="notification_id">
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

            fetchNotifications();

            function fetchNotifications()
            {
                $.ajax({
                    type: "GET",
                    url: "fetchNotifications",
                    dataType: "json",
                    success: function (response) {
                        $('tbody').html("");
                        $.each(response.notifications, function (key, notification) {
                            $('tbody').append('<tr>\
                            <td>'+notification.id+'</td>\
                            <td>'+notification.title+'</td>\
                            <td>'+notification.body+'</td>\
                            <td><button value="'+notification.id+'" style="border: none; background-color: #fff" class="delete_btn"><i class="flaticon2-delete"></i></button></td>\
                    </tr>');
                        });
                    }
                });
            }

            $(document).on('click', '.delete_btn', function (e) {
                e.preventDefault();
                var notification_id = $(this).val();
                $('#deleteNotification').modal('show');
                $('#notification_id').val(notification_id)
            });

            $(document).on('submit', '#deleteNotificationForm', function (e) {
                e.preventDefault();
                var notification_id = $('#notification_id').val();

                $.ajax({
                    type: 'delete',
                    url: 'notification/'+notification_id,
                    dataType: 'json',
                    success: function (response) {
                        if (response.status == 0) {
                            $('#deleteNotification').modal('hide');
                        }
                        else {
                            fetchNotifications();
                            $('#deleteNotification').modal('hide');
                        }
                    }
                });
            });

            $(document).on('submit', '#addNotificationForm', function (e){
                e.preventDefault();
                let formDate = new FormData($('#addNotificationForm')[0]);
                $.ajax({
                    type: "post",
                    url: "notification",
                    data: formDate,
                    contentType: false,
                    processData: false,
                    beforeSend:function (){
                        $(document).find('span.error-text').text('');
                    },
                    success: function (response) {
                        if (response.status == 0){
                            $('#addNotification').modal('show')
                            $.each(response.error, function (prefix, val){
                                $('span.'+prefix+'_error').text(val[0]);
                            });
                        }else {
                            $('#addNotificationForm')[0].reset();
                            $('#addNotification').modal('hide');
                            fetchNotifications();
                        }
                    },
                    error: function (error){
                        $('#addNotification').modal('show')
                    }
                });
            });
        });
    </script>

@endsection
