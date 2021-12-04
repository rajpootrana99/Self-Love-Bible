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
                                Months
                            </div>
                        </div>
                        <div class="kt-align-left mt-3">
                            <a href="" data-toggle="modal" data-target="#addMonth" id="addMonthButton" class="btn btn-primary" style="float:right;"><i class="flaticon2-add-1"></i> New Month </a>
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
                                        <th>Topic Name</th>
                                        <th width="20%">Month Name</th>
                                        <th width="3%"><i class="flaticon2-edit"></i></th>
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

    <div class="modal fade" id="addMonth" tabindex="-1" role="dialog" aria-labelledby="addMonthLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addMonthLabel">Month</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <form class="kt-form" method="post" id="addMonthForm">
                    @csrf
                    <div class="modal-body">
                        <div class="kt-portlet__body">
                            <div class="form-group">
                                <label>Select Topic</label>
                                <select class="form-control kt-select2 topic_id" style="width: 100%" id="kt_select2_1" name="topic_id">

                                </select>
                                <span class="form-text error-text topic_id_error" style="color: red"></span>
                            </div>
                            <div class="form-group">
                                <label>Month Name</label>
                                <input type="text" class="form-control" name="name" id="name" placeholder="Enter Month Name">
                                <span class="form-text error-text name_error" style="color: red"></span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editMonth" tabindex="-1" role="dialog" aria-labelledby="editMonthLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editMonthLabel">Month</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <form class="kt-form" method="post" id="editMonthForm">
                    @csrf
                    @method('PATCH')
                    <div class="modal-body">
                        <input type="hidden" name="month_id" id="month_id">
                        <div class="kt-portlet__body">
                            <div class="form-group">
                                <label>Select Topic</label>
                                <select class="form-control kt-select2 edit_topic_id" style="width: 100%" id="kt_select2_1" name="topic_id">

                                </select>
                                <span class="form-text error-text topic_id_update_error" style="color: red"></span>
                            </div>
                            <div class="form-group">
                                <label>Topic Name</label>
                                <input type="text" class="form-control" name="name" id="edit_name">
                                <span class="form-text error-text name_update_error" style="color: red"></span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteMonth" tabindex="-1" role="dialog" aria-labelledby="deleteMonthLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteMonthLabel">Delete</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <form class="kt-form" method="post" id="deleteMonthForm">
                    @csrf
                    @method('DELETE')
                    <div class="modal-body">
                        <input type="hidden" name="month_id" id="month_id">
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

            fetchMonths();

            function fetchMonths()
            {
                $.ajax({
                    type: "GET",
                    url: "fetchMonths",
                    dataType: "json",
                    success: function (response) {
                        $('tbody').html("");
                        $.each(response.months, function (key, month) {
                            $('tbody').append('<tr>\
                            <td>'+month.id+'</td>\
                            <td>'+month.topic.name+'</td>\
                            <td>'+month.name+'</td>\
                            <td><button value="'+month.id+'" style="border: none; background-color: #fff" class="edit_btn"><i class="flaticon2-edit"></i></button></td>\
                            <td><button value="'+month.id+'" style="border: none; background-color: #fff" class="delete_btn"><i class="flaticon2-delete"></i></button></td>\
                    </tr>');
                        });
                    }
                });
            }

            function fetchTopics() {
                $.ajax({
                    type: "GET",
                    url: "fetchTopics",
                    dataType: "json",
                    success: function (response) {
                        var topic_id = $('.topic_id');
                        $('.topic_id').children().remove().end()
                        $.each(response.topics, function (topic) {
                            topic_id.append($("<option />").val(response.topics[topic].id).text(response.topics[topic].name));
                        });
                    }
                });
            }

            $(document).on('click', '#addMonthButton', function (e) {
                e.preventDefault();
                $('#addMonth').modal('show');
                fetchTopics();
                $(document).find('span.error-text').text('');
            });

            $(document).on('click', '.delete_btn', function (e) {
                e.preventDefault();
                var month_id = $(this).val();
                $('#deleteMonth').modal('show');
                $('#month_id').val(month_id)
            });

            $(document).on('submit', '#deleteMonthForm', function (e) {
                e.preventDefault();
                var month_id = $('#month_id').val();

                $.ajax({
                    type: 'delete',
                    url: 'month/'+month_id,
                    dataType: 'json',
                    success: function (response) {
                        if (response.status == 0) {
                            $('#deleteMonth').modal('hide');
                        }
                        else {
                            fetchMonths();
                            $('#deleteMonth').modal('hide');
                        }
                    }
                });
            });

            $(document).on('click', '.edit_btn', function (e) {
                e.preventDefault();
                var month_id = $(this).val();
                $('#editMonth').modal('show');
                $(document).find('span.error-text').text('');
                $.ajax({
                    type: "GET",
                    url: 'month/'+month_id+'/edit',
                    success: function (response) {
                        if (response.status == 404) {
                            $('#editMonth').modal('hide');
                        }
                        else {
                            var topic_id = $('.edit_topic_id');
                            $('.edit_topic_id').children().remove().end()
                            $.each(response.topics, function (topic) {
                                topic_id.append($("<option />").val(response.topics[topic].id).text(response.topics[topic].name));
                            });
                            $('#month_id').val(response.month.id);
                            $('#edit_name').val(response.month.name);
                            $('.edit_topic_id').val(response.month.topic_id).change();
                        }
                    }
                });
            });

            $(document).on('submit', '#editMonthForm', function (e) {
                e.preventDefault();
                var month_id = $('#month_id').val();
                let EditFormData = new FormData($('#editMonthForm')[0]);

                $.ajax({
                    type: "post",
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content'), '_method': 'patch'},
                    url: "month/"+month_id,
                    data: EditFormData,
                    contentType: false,
                    processData: false,
                    beforeSend:function (){
                        $(document).find('span.error-text').text('');
                    },
                    success: function (response) {
                        if (response.status == 0){
                            $('#editMonth').modal('show')
                            $.each(response.error, function (prefix, val){
                                $('span.'+prefix+'_update_error').text(val[0]);
                            });
                        }else {
                            $('#editMonthForm')[0].reset();
                            $('#editMonth').modal('hide');
                            fetchMonths();
                        }
                    },
                    error: function (error){
                        console.log(error)
                        $('#editMonth').modal('show');
                    }
                });
            })

            $(document).on('submit', '#addMonthForm', function (e){
                e.preventDefault();
                let formDate = new FormData($('#addMonthForm')[0]);
                $.ajax({
                    type: "post",
                    url: "month",
                    data: formDate,
                    contentType: false,
                    processData: false,
                    beforeSend:function (){
                        $(document).find('span.error-text').text('');
                    },
                    success: function (response) {
                        if (response.status == 0){
                            $('#addMonth').modal('show')
                            $.each(response.error, function (prefix, val){
                                $('span.'+prefix+'_error').text(val[0]);
                            });
                        }else {
                            $('#addMonthForm')[0].reset();
                            $('#addMonth').modal('hide');
                            fetchMonths();
                        }
                    },
                    error: function (error){
                        $('#addMonth').modal('show')
                    }
                });
            });
        });
    </script>

@endsection
