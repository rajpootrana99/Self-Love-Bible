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
                                Meditations
                            </div>
                        </div>
                        <div class="kt-align-left mt-3">
                            <a href="" data-toggle="modal" data-target="#addMeditation" id="addMeditationButton" class="btn btn-primary" style="float:right;"><i class="flaticon2-add-1"></i> New Meditation </a>
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
                                        <th width="17%">Media</th>
                                        <th>Information</th>
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

    <div class="modal fade" id="addMeditation" tabindex="-1" role="dialog" aria-labelledby="addMeditationLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addMeditationLabel">Meditation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <form class="kt-form" method="post" id="addMeditationForm" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="kt-portlet__body">
                            <div class="form-group">
                                <label>Information</label>
                                <input type="text" class="form-control" name="information" id="information" placeholder="Enter Information">
                                <span class="form-text error-text information_error" style="color: red"></span>
                            </div>
                            <div class="form-group">
                                <label>File Browser</label>
                                <div></div>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="media" name="media">
                                    <label class="custom-file-label" for="media">Choose file</label>
                                </div>
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

    <div class="modal fade" id="editMeditation" tabindex="-1" role="dialog" aria-labelledby="editMeditationLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editMeditationLabel">Meditation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <form class="kt-form" method="post" id="editMeditationForm" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="modal-body">
                        <input type="hidden" name="meditation_id" id="meditation_id">
                        <div class="kt-portlet__body">
                            <div class="form-group">
                                <label>Information</label>
                                <input type="text" class="form-control" name="information" id="edit_information">
                                <span class="form-text error-text information_update_error" style="color: red"></span>
                            </div>
                            <div class="form-group">
                                <label>File Browser</label>
                                <div></div>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="edit_media" name="media">
                                    <label class="custom-file-label" for="edit_media">Choose file</label>
                                </div>
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

    <div class="modal fade" id="deleteMeditation" tabindex="-1" role="dialog" aria-labelledby="deleteMeditationLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteMeditationLabel">Delete</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <form class="kt-form" method="post" id="deleteMeditationForm">
                    @csrf
                    @method('DELETE')
                    <div class="modal-body">
                        <input type="hidden" name="meditation_id" id="meditation_id">
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

            fetchMeditations();

            function fetchMeditations()
            {
                $.ajax({
                    type: "GET",
                    url: "fetchMeditations",
                    dataType: "json",
                    success: function (response) {
                        $('tbody').html("");
                        $.each(response.meditations, function (key, meditation) {
                            $('tbody').append('<tr>\
                            <td>'+meditation.id+'</td>\
                            <td><video width="180" height="100" controls><source src="storage/'+meditation.media+'"></video></td>\
                            <td>'+meditation.information+'</td>\
                            <td><button value="'+meditation.id+'" style="border: none; background-color: #fff" class="edit_btn"><i class="flaticon2-edit"></i></button></td>\
                            <td><button value="'+meditation.id+'" style="border: none; background-color: #fff" class="delete_btn"><i class="flaticon2-delete"></i></button></td>\
                    </tr>');
                        });
                    }
                });
            }

            $(document).on('click', '.delete_btn', function (e) {
                e.preventDefault();
                var meditation_id = $(this).val();
                $('#deleteMeditation').modal('show');
                $('#meditation_id').val(meditation_id)
            });

            $(document).on('submit', '#deleteMeditationForm', function (e) {
                e.preventDefault();
                var meditation_id = $('#meditation_id').val();

                $.ajax({
                    type: 'delete',
                    url: 'meditation/'+meditation_id,
                    dataType: 'json',
                    success: function (response) {
                        if (response.status == 0) {
                            $('#deleteMeditation').modal('hide');
                        }
                        else {
                            fetchMeditations();
                            $('#deleteMeditation').modal('hide');
                        }
                    }
                });
            });

            $(document).on('click', '.edit_btn', function (e) {
                e.preventDefault();
                var meditation_id = $(this).val();
                $('#editMeditation').modal('show');
                $(document).find('span.error-text').text('');
                $.ajax({
                    type: "GET",
                    url: 'meditation/'+meditation_id+'/edit',
                    success: function (response) {
                        if (response.status == 404) {
                            $('#editMeditation').modal('hide');
                        }
                        else {
                            $('#meditation_id').val(response.meditation.id);
                            $('#edit_information').val(response.meditation.information);
                        }
                    }
                });
            });

            $(document).on('submit', '#editMeditationForm', function (e) {
                e.preventDefault();
                var meditation_id = $('#meditation_id').val();
                let EditFormData = new FormData($('#editMeditationForm')[0]);

                $.ajax({
                    type: "post",
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content'), '_method': 'patch'},
                    url: "meditation/"+meditation_id,
                    data: EditFormData,
                    contentType: false,
                    processData: false,
                    beforeSend:function (){
                        $(document).find('span.error-text').text('');
                    },
                    success: function (response) {
                        if (response.status == 0){
                            $('#editMeditation').modal('show')
                            $.each(response.error, function (prefix, val){
                                $('span.'+prefix+'_update_error').text(val[0]);
                            });
                        }else {
                            $('#editMeditationForm')[0].reset();
                            $('.custom-file-label').text('Choose File');
                            $('#editMeditation').modal('hide');
                            fetchMeditations();
                        }
                    },
                    error: function (error){
                        console.log(error)
                        $('#editMeditation').modal('show');
                    }
                });
            })

            $(document).on('submit', '#addMeditationForm', function (e){
                e.preventDefault();
                let formDate = new FormData($('#addMeditationForm')[0]);
                $.ajax({
                    type: "post",
                    url: "meditation",
                    data: formDate,
                    contentType: false,
                    processData: false,
                    beforeSend:function (){
                        $(document).find('span.error-text').text('');
                    },
                    success: function (response) {
                        if (response.status == 0){
                            $('#addMeditation').modal('show')
                            $.each(response.error, function (prefix, val){
                                $('span.'+prefix+'_error').text(val[0]);
                            });
                        }else {
                            $('#addMeditationForm')[0].reset();
                            $('.custom-file-label').text('Choose File');
                            $('#addMeditation').modal('hide');
                            fetchMeditations();
                        }
                    },
                    error: function (error){
                        $('#addMeditation').modal('show')
                    }
                });
            });
        });
    </script>

@endsection
