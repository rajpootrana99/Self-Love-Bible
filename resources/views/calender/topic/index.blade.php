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
                                Topics
                            </div>
                        </div>
                        <div class="kt-align-left mt-3">
                            <a href="" data-toggle="modal" data-target="#addTopic" id="addTopicButton" class="btn btn-primary" style="float:right;"><i class="flaticon2-add-1"></i> New Topic </a>
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

    <div class="modal fade" id="addTopic" tabindex="-1" role="dialog" aria-labelledby="addTopicLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addTopicLabel">Topic</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <form class="kt-form" method="post" id="addTopicForm">
                    @csrf
                    <div class="modal-body">
                        <div class="kt-portlet__body">
                            <div class="form-group">
                                <label>Topic Name</label>
                                <input type="text" class="form-control" name="name" id="name" placeholder="Enter Topic Name">
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

    <div class="modal fade" id="editTopic" tabindex="-1" role="dialog" aria-labelledby="editTopicLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editTopicLabel">Topic</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <form class="kt-form" method="post" id="editTopicForm">
                    @csrf
                    @method('PATCH')
                    <div class="modal-body">
                        <input type="hidden" name="topic_id" id="topic_id">
                        <div class="kt-portlet__body">
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

    <div class="modal fade" id="deleteTopic" tabindex="-1" role="dialog" aria-labelledby="deleteTopicLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteTopicLabel">Delete</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <form class="kt-form" method="post" id="deleteTopicForm">
                    @csrf
                    @method('DELETE')
                    <div class="modal-body">
                        <input type="hidden" name="topic_id" id="topic_id">
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

            fetchTopics();

            function fetchTopics()
            {
                $.ajax({
                    type: "GET",
                    url: "fetchTopics",
                    dataType: "json",
                    success: function (response) {
                        $('tbody').html("");
                        $.each(response.topics, function (key, topic) {
                            $('tbody').append('<tr>\
                            <td>'+topic.id+'</td>\
                            <td>'+topic.name+'</td>\
                            <td><button value="'+topic.id+'" style="border: none; background-color: #fff" class="edit_btn"><i class="flaticon2-edit"></i></button></td>\
                            <td><button value="'+topic.id+'" style="border: none; background-color: #fff" class="delete_btn"><i class="flaticon2-delete"></i></button></td>\
                    </tr>');
                        });
                    }
                });
            }

            $(document).on('click', '.delete_btn', function (e) {
                e.preventDefault();
                var topic_id = $(this).val();
                $('#deleteTopic').modal('show');
                $('#topic_id').val(topic_id)
            });

            $(document).on('submit', '#deleteTopicForm', function (e) {
                e.preventDefault();
                var topic_id = $('#topic_id').val();

                $.ajax({
                    type: 'delete',
                    url: 'topic/'+topic_id,
                    dataType: 'json',
                    success: function (response) {
                        if (response.status == 0) {
                            $('#deleteTopic').modal('hide');
                        }
                        else {
                            fetchTopics();
                            $('#deleteTopic').modal('hide');
                        }
                    }
                });
            });

            $(document).on('click', '.edit_btn', function (e) {
                e.preventDefault();
                var topic_id = $(this).val();
                $('#editTopic').modal('show');
                $(document).find('span.error-text').text('');
                $.ajax({
                    type: "GET",
                    url: 'topic/'+topic_id+'/edit',
                    success: function (response) {
                        if (response.status == 404) {
                            $('#editTopic').modal('hide');
                        }
                        else {
                            $('#topic_id').val(response.topic.id);
                            $('#edit_name').val(response.topic.name);
                        }
                    }
                });
            });

            $(document).on('submit', '#editTopicForm', function (e) {
                e.preventDefault();
                var topic_id = $('#topic_id').val();
                let EditFormData = new FormData($('#editTopicForm')[0]);

                $.ajax({
                    type: "post",
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content'), '_method': 'patch'},
                    url: "topic/"+topic_id,
                    data: EditFormData,
                    contentType: false,
                    processData: false,
                    beforeSend:function (){
                        $(document).find('span.error-text').text('');
                    },
                    success: function (response) {
                        if (response.status == 0){
                            $('#editTopic').modal('show')
                            $.each(response.error, function (prefix, val){
                                $('span.'+prefix+'_update_error').text(val[0]);
                            });
                        }else {
                            $('#editTopicForm')[0].reset();
                            $('#editTopic').modal('hide');
                            fetchTopics();
                        }
                    },
                    error: function (error){
                        console.log(error)
                        $('#editTopic').modal('show');
                    }
                });
            })

            $(document).on('submit', '#addTopicForm', function (e){
                e.preventDefault();
                let formDate = new FormData($('#addTopicForm')[0]);
                $.ajax({
                    type: "post",
                    url: "topic",
                    data: formDate,
                    contentType: false,
                    processData: false,
                    beforeSend:function (){
                        $(document).find('span.error-text').text('');
                    },
                    success: function (response) {
                        if (response.status == 0){
                            $('#addTopic').modal('show')
                            $.each(response.error, function (prefix, val){
                                $('span.'+prefix+'_error').text(val[0]);
                            });
                        }else {
                            $('#addTopicForm')[0].reset();
                            $('#addTopic').modal('hide');
                            fetchTopics();
                        }
                    },
                    error: function (error){
                        $('#addTopic').modal('show')
                    }
                });
            });
        });
    </script>

@endsection
