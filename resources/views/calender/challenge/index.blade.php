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
                                Challenges
                            </div>
                        </div>
                        <div class="kt-align-left mt-3">
                            <button value="" id="addChallengeButton" class="btn btn-primary" style="float:right;"><i class="flaticon2-add-1"></i> New Challenge </button>
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
                                        <th width="10%">Month</th>
                                        <th width="10%">Day</th>
                                        <th width="20%">Challenge Name</th>
                                        <th>Challenge Detail</th>
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

    <div class="modal fade" id="addChallenge" tabindex="-1" role="dialog" aria-labelledby="addChallengeLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addChallengeLabel">Challenge</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <form class="kt-form" method="post" id="addChallengeForm">
                    @csrf
                    <div class="modal-body">
                        <div class="kt-portlet__body row">
                            <div class="form-group col-lg-12">
                                <label>Select Topic</label>
                                <select class="form-control kt-select2 topic_id" style="width: 100%" id="kt_select2_1" name="topic_id">

                                </select>
                                <span class="form-text error-text topic_id_error" style="color: red"></span>
                            </div>
                            <div class="form-group col-lg-6">
                                <label>Select Month</label>
                                <select class="form-control kt-select2 month_id" style="width: 100%" id="kt_select2_1" name="month_id">

                                </select>
                                <span class="form-text error-text month_id_error" style="color: red"></span>
                            </div>
                            <div class="form-group col-lg-6">
                                <label>Select Day</label>
                                <select class="form-control kt-select2 day_id" style="width: 100%" id="kt_select2_1" name="day_id">

                                </select>
                                <span class="form-text error-text day_id_error" style="color: red"></span>
                            </div>
                            <div class="form-group col-lg-12">
                                <label>Challenge Name</label>
                                <input type="text" class="form-control" name="name" id="name" placeholder="Enter Challenge Name">
                                <span class="form-text error-text name_error" style="color: red"></span>
                            </div>
                            <div class="form-group col-lg-12">
                                <label>Challenge Detail</label>
                                <textarea class="form-control" name="detail" id="detail" rows="4"></textarea>
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

    <div class="modal fade" id="editChallenge" tabindex="-1" role="dialog" aria-labelledby="editChallengeLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editChallengeLabel">Challenge</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <form class="kt-form" method="post" id="editChallengeForm">
                    @csrf
                    @method('PATCH')
                    <div class="modal-body">
                        <input type="hidden" name="challenge_id" id="challenge_id">
                        <div class="kt-portlet__body row">
                            <div class="form-group col-lg-12">
                                <label>Select Topic</label>
                                <select class="form-control kt-select2 edit_topic_id" disabled style="width: 100%" id="kt_select2_1" name="topic_id">

                                </select>
                                <span class="form-text error-text topic_id_update_error" style="color: red"></span>
                            </div>
                            <div class="form-group col-lg-6">
                                <label>Select Month</label>
                                <select class="form-control kt-select2 edit_month_id" disabled style="width: 100%" id="kt_select2_1" name="month_id">

                                </select>
                                <span class="form-text error-text month_id_update_error" style="color: red"></span>
                            </div>
                            <div class="form-group col-lg-6">
                                <label>Select Day</label>
                                <select class="form-control kt-select2 edit_day_id" style="width: 100%" id="kt_select2_1" name="day_id">

                                </select>
                                <span class="form-text error-text day_id_update_error" style="color: red"></span>
                            </div>
                            <div class="form-group col-lg-12">
                                <label>Challenge Name</label>
                                <input type="text" class="form-control" name="name" id="edit_name">
                                <span class="form-text error-text name_update_error" style="color: red"></span>
                            </div>
                            <div class="form-group col-lg-12">
                                <label>Challenge Detail</label>
                                <textarea class="form-control" rows="4" name="detail" id="edit_detail"></textarea>
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

    <div class="modal fade" id="deleteChallenge" tabindex="-1" role="dialog" aria-labelledby="deleteChallengeLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteChallengeLabel">Delete</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <form class="kt-form" method="post" id="deleteChallengeForm">
                    @csrf
                    @method('DELETE')
                    <div class="modal-body">
                        <input type="hidden" name="challenge_id" id="challenge_id">
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

            fetchChallenges();

            function fetchChallenges()
            {
                $.ajax({
                    type: "GET",
                    url: "fetchChallenges",
                    dataType: "json",
                    success: function (response) {
                        $('tbody').html("");
                        $.each(response.challenges, function (key, challenge) {
                            $('tbody').append('<tr>\
                            <td>'+challenge.id+'</td>\
                            <td>'+challenge.topic.name+'</td>\
                            <td>'+challenge.month.name+'</td>\
                            <td>'+challenge.day.day+'</td>\
                            <td>'+challenge.name+'</td>\
                            <td>'+challenge.detail+'</td>\
                            <td><button value="'+challenge.id+'" style="border: none; background-color: #fff" class="edit_btn"><i class="flaticon2-edit"></i></button></td>\
                            <td><button value="'+challenge.id+'" style="border: none; background-color: #fff" class="delete_btn"><i class="flaticon2-delete"></i></button></td>\
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
                var fetch_specific_day = 0
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
                            if (fetch_specific_day === 0){
                                fetch_specific_day = response.months[month].id;
                            }
                            month_id.append($("<option />").val(response.months[month].id).text(response.months[month].name));
                        });
                        fetchSpecificDays(fetch_specific_day);
                    }
                });
            }

            function fetchSpecificDays(fetch_specific_day) {
                if (fetch_specific_day === 0){
                    var month_id = $('.month_id').val();
                }
                else {
                    month_id = fetch_specific_day;
                }
                $.ajax({
                    type: "GET",
                    url: 'fetchSpecificDays/'+month_id,
                    dataType: "json",
                    success: function (response) {
                        var day_id = $('.day_id');
                        $('.day_id').children().remove().end()
                        $.each(response.days, function (day) {
                            day_id.append($("<option />").val(response.days[day].id).text(response.days[day].day));
                        });
                    }
                });
            }

            $(document).on('click', '#addChallengeButton', function (e) {
                e.preventDefault();
                $('#addChallenge').modal('show');
                fetchTopics();
                $(document).find('span.error-text').text('');
            });

            $(document).on('change', '.topic_id', function (e) {
                e.preventDefault();
                fetchSpecificMonths(0);
                $(document).find('span.error-text').text('');
            });

            $(document).on('change', '.month_id', function (e) {
                e.preventDefault();
                fetchSpecificDays(0);
                $(document).find('span.error-text').text('');
            });

            $(document).on('click', '.delete_btn', function (e) {
                e.preventDefault();
                var challenge_id = $(this).val();
                $('#deleteChallenge').modal('show');
                $('#challenge_id').val(challenge_id)
            });

            $(document).on('submit', '#deleteChallengeForm', function (e) {
                e.preventDefault();
                var challenge_id = $('#challenge_id').val();

                $.ajax({
                    type: 'delete',
                    url: 'challenge/'+challenge_id,
                    dataType: 'json',
                    success: function (response) {
                        if (response.status == 0) {
                            $('#deleteChallenge').modal('hide');
                        }
                        else {
                            fetchChallenges();
                            $('#deleteChallenge').modal('hide');
                        }
                    }
                });
            });

            $(document).on('click', '.edit_btn', function (e) {
                e.preventDefault();
                var challenge_id = $(this).val();
                $('#editChallenge').modal('show');
                $(document).find('span.error-text').text('');
                $.ajax({
                    type: "GET",
                    url: 'challenge/'+challenge_id+'/edit',
                    success: function (response) {
                        if (response.status == 404) {
                            $('#editChallenge').modal('hide');
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
                            var day_id = $('.edit_day_id');
                            $('.edit_day_id').children().remove().end()
                            $.each(response.days, function (day) {
                                day_id.append($("<option />").val(response.days[day].id).text(response.days[day].day));
                            });
                            $('#challenge_id').val(response.challenge.id);
                            $('#edit_name').val(response.challenge.name);
                            $('#edit_detail').text(response.challenge.detail);
                            $('.edit_topic_id').val(response.challenge.topic_id).change();
                            $('.edit_month_id').val(response.challenge.month_id).change();
                            $('.edit_day_id').val(response.challenge.day_id).change();
                        }
                    }
                });
            });

            $(document).on('submit', '#editChallengeForm', function (e) {
                e.preventDefault();
                var challenge_id = $('#challenge_id').val();
                let EditFormData = new FormData($('#editChallengeForm')[0]);

                $.ajax({
                    type: "post",
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content'), '_method': 'patch'},
                    url: "challenge/"+challenge_id,
                    data: EditFormData,
                    contentType: false,
                    processData: false,
                    beforeSend:function (){
                        $(document).find('span.error-text').text('');
                    },
                    success: function (response) {
                        if (response.status == 0){
                            $('#editChallenge').modal('show')
                            $.each(response.error, function (prefix, val){
                                $('span.'+prefix+'_update_error').text(val[0]);
                            });
                        }else {
                            $('#editChallengeForm')[0].reset();
                            $('#editChallenge').modal('hide');
                            fetchChallenges();
                        }
                    },
                    error: function (error){
                        console.log(error)
                        $('#editChallenge').modal('show');
                    }
                });
            })

            $(document).on('submit', '#addChallengeForm', function (e){
                e.preventDefault();
                let formDate = new FormData($('#addChallengeForm')[0]);
                $.ajax({
                    type: "post",
                    url: "challenge",
                    data: formDate,
                    contentType: false,
                    processData: false,
                    beforeSend:function (){
                        $(document).find('span.error-text').text('');
                    },
                    success: function (response) {
                        if (response.status == 0){
                            $('#addChallenge').modal('show')
                            $.each(response.error, function (prefix, val){
                                $('span.'+prefix+'_error').text(val[0]);
                            });
                        }else {
                            $('#addChallengeForm')[0].reset();
                            $('#addChallenge').modal('hide');
                            fetchChallenges();
                        }
                    },
                    error: function (error){
                        $('#addChallenge').modal('show')
                    }
                });
            });
        });
    </script>

@endsection
