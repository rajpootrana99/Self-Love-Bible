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
                                Days
                            </div>
                        </div>
                        <div class="kt-align-left mt-3">
                            <button value="" id="addDayButton" class="btn btn-primary" style="float:right;"><i class="flaticon2-add-1"></i> New Day </button>
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
                                        <th width="20%">Day</th>
                                        <th width="20%">Detail</th>
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

    <div class="modal fade" id="addDay" tabindex="-1" role="dialog" aria-labelledby="addDayLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addDayLabel">Day</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <form class="kt-form" method="post" id="addDayForm">
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
                                <label>Select Month</label>
                                <select class="form-control kt-select2 month_id" style="width: 100%" id="kt_select2_1" name="month_id">

                                </select>
                                <span class="form-text error-text month_id_error" style="color: red"></span>
                            </div>
                            <div class="form-group">
                                <label>Day</label>
                                <input type="number" class="form-control" name="day" id="day">
                                <span class="form-text error-text day_error" style="color: red"></span>
                            </div>
                            <div class="form-group">
                                <label>Detail</label>
                                <textarea class="summernote" id="kt_summernote_1" name="detail"></textarea>
                                <span class="form-text error-text detail_error" style="color: red"></span>
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

    <div class="modal fade" id="editDay" tabindex="-1" role="dialog" aria-labelledby="editDayLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editDayLabel">Day</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <form class="kt-form" method="post" id="editDayForm">
                    @csrf
                    @method('PATCH')
                    <div class="modal-body">
                        <input type="hidden" name="day_id" id="day_id">
                        <div class="kt-portlet__body">
                            <div class="form-group">
                                <label>Select Topic</label>
                                <select class="form-control kt-select2 edit_topic_id" disabled style="width: 100%" id="kt_select2_1" name="topic_id">

                                </select>
                                <span class="form-text error-text topic_id_update_error" style="color: red"></span>
                            </div>
                            <div class="form-group">
                                <label>Select Month</label>
                                <select class="form-control kt-select2 edit_month_id" style="width: 100%" id="kt_select2_1" name="month_id">

                                </select>
                                <span class="form-text error-text month_id_update_error" style="color: red"></span>
                            </div>
                            <div class="form-group">
                                <label>Day</label>
                                <input type="number" class="form-control" name="day" id="edit_day">
                                <span class="form-text error-text day_update_error" style="color: red"></span>
                            </div>
                            <div class="form-group">
                                <label>Detail</label>
                                <textarea class="summernote edit_detail" id="kt_summernote_1" name="detail"></textarea>
                                <span class="form-text error-text detail_update_error" style="color: red"></span>
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

    <div class="modal fade" id="deleteDay" tabindex="-1" role="dialog" aria-labelledby="deleteDayLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteDayLabel">Delete</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <form class="kt-form" method="post" id="deleteDayForm">
                    @csrf
                    @method('DELETE')
                    <div class="modal-body">
                        <input type="hidden" name="day_id" id="day_id">
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

            fetchDays();

            function fetchDays()
            {
                $.ajax({
                    type: "GET",
                    url: "fetchDays",
                    dataType: "json",
                    success: function (response) {
                        $('tbody').html("");
                        $.each(response.days, function (key, day) {
                            $('tbody').append('<tr>\
                            <td>'+day.id+'</td>\
                            <td>'+day.topic.name+'</td>\
                            <td>'+day.month.name+'</td>\
                            <td>'+day.day+'</td>\
                            <td>'+day.detail+'</td>\
                            <td><button value="'+day.id+'" style="border: none; background-color: #fff" class="edit_btn"><i class="flaticon2-edit"></i></button></td>\
                            <td><button value="'+day.id+'" style="border: none; background-color: #fff" class="delete_btn"><i class="flaticon2-delete"></i></button></td>\
                    </tr>');
                        });
                    }
                });
            }

            function fetchTopics() {
                var fetch_specific_month = 0
                $.ajax({
                    type: "GET",
                    url: "fetchTopics",
                    dataType: "json",
                    success: function (response) {
                        var topic_id = $('.topic_id');
                        $('.topic_id').children().remove().end()
                        $.each(response.topics, function (topic) {
                            if (fetch_specific_month === 0){
                                fetch_specific_month = response.topics[topic].id;
                            }
                            topic_id.append($("<option />").val(response.topics[topic].id).text(response.topics[topic].name));
                        });
                        fetchSpecificMonths(fetch_specific_month);
                    }
                });
            }

            function fetchSpecificMonths(fetch_specific_month) {
                if (fetch_specific_month === 0){
                    var topic_id = $('.topic_id').val();
                }
                else {
                    topic_id = fetch_specific_month;
                }
                $.ajax({
                    type: "GET",
                    url: 'fetchSpecificMonths/'+topic_id,
                    dataType: "json",
                    success: function (response) {
                        var month_id = $('.month_id');
                        $('.month_id').children().remove().end()
                        $.each(response.months, function (month) {
                            month_id.append($("<option />").val(response.months[month].id).text(response.months[month].name));
                        });
                    }
                });
            }

            $(document).on('click', '#addDayButton', function (e) {
                e.preventDefault();
                $('#addDay').modal('show');
                fetchTopics();
                $(document).find('span.error-text').text('');
            });

            $(document).on('change', '.topic_id', function (e) {
                e.preventDefault();
                fetchSpecificMonths(0);
                $(document).find('span.error-text').text('');
            });

            $(document).on('click', '.delete_btn', function (e) {
                e.preventDefault();
                var day_id = $(this).val();
                $('#deleteDay').modal('show');
                $('#day_id').val(day_id)
            });

            $(document).on('submit', '#deleteDayForm', function (e) {
                e.preventDefault();
                var day_id = $('#day_id').val();

                $.ajax({
                    type: 'delete',
                    url: 'day/'+day_id,
                    dataType: 'json',
                    success: function (response) {
                        if (response.status == 0) {
                            $('#deleteDay').modal('hide');
                        }
                        else {
                            fetchDays();
                            $('#deleteDay').modal('hide');
                        }
                    }
                });
            });

            $(document).on('click', '.edit_btn', function (e) {
                e.preventDefault();
                var day_id = $(this).val();
                $('#editDay').modal('show');
                $(document).find('span.error-text').text('');
                $.ajax({
                    type: "GET",
                    url: 'day/'+day_id+'/edit',
                    success: function (response) {
                        if (response.status == 404) {
                            $('#editDay').modal('hide');
                        }
                        else {
                            var topic_id = $('.edit_topic_id');
                            $('.edit_topic_id').children().remove().end()
                            $.each(response.topics, function (topic) {
                                topic_id.append($("<option />").val(response.topics[topic].id).text(response.topics[topic].name));
                            });
                            var month_id = $('.edit_month_id');
                            $('.edit_month_id').children().remove().end()
                            $.each(response.months, function (month) {
                                month_id.append($("<option />").val(response.months[month].id).text(response.months[month].name));
                            });
                            console.log(response.day.detail)
                            $('#day_id').val(response.day.id);
                            $('#edit_day').val(response.day.day);
                            $('.edit_detail').summernote("code", response.day.detail);
                            $('.edit_topic_id').val(response.day.topic_id).change();
                            $('.edit_month_id').val(response.day.month_id).change();
                        }
                    }
                });
            });

            $(document).on('submit', '#editDayForm', function (e) {
                e.preventDefault();
                var day_id = $('#day_id').val();
                let EditFormData = new FormData($('#editDayForm')[0]);

                $.ajax({
                    type: "post",
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content'), '_method': 'patch'},
                    url: "day/"+day_id,
                    data: EditFormData,
                    contentType: false,
                    processData: false,
                    beforeSend:function (){
                        $(document).find('span.error-text').text('');
                    },
                    success: function (response) {
                        if (response.status == 0){
                            $('#editDay').modal('show')
                            $.each(response.error, function (prefix, val){
                                $('span.'+prefix+'_update_error').text(val[0]);
                            });
                        }else {
                            $('#editDayForm')[0].reset();
                            $('#editDay').modal('hide');
                            fetchDays();
                        }
                    },
                    error: function (error){
                        console.log(error)
                        $('#editDay').modal('show');
                    }
                });
            })

            $(document).on('submit', '#addDayForm', function (e){
                e.preventDefault();
                let formDate = new FormData($('#addDayForm')[0]);
                $.ajax({
                    type: "post",
                    url: "day",
                    data: formDate,
                    contentType: false,
                    processData: false,
                    beforeSend:function (){
                        $(document).find('span.error-text').text('');
                    },
                    success: function (response) {
                        if (response.status == 0){
                            $('#addDay').modal('show')
                            $.each(response.error, function (prefix, val){
                                $('span.'+prefix+'_error').text(val[0]);
                            });
                        }else {
                            $('#addDayForm')[0].reset();
                            $('#addDay').modal('hide');
                            fetchDays();
                        }
                    },
                    error: function (error){
                        $('#addDay').modal('show')
                    }
                });
            });
        });
    </script>

@endsection
