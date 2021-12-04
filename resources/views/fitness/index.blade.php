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
                                Fitnesses
                            </div>
                        </div>
                        <div class="kt-align-left mt-3">
                            <a href="" data-toggle="modal" data-target="#addFitness" id="addFitnessButton" class="btn btn-primary" style="float:right;"><i class="flaticon2-add-1"></i> New Fitness </a>
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
                                        <th width="10%">Media</th>
                                        <th>Name</th>
                                        <th>Category</th>
                                        <th>Type</th>
                                        <th>Description</th>
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

    <div class="modal fade" id="addFitness" tabindex="-1" role="dialog" aria-labelledby="addFitnessLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addFitnessLabel">Fitness</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <form class="kt-form" method="post" id="addFitnessForm" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="kt-portlet__body row">
                            <div class="form-group col-lg-6">
                                <label>Name</label>
                                <input type="text" class="form-control" name="name" id="name" placeholder="Enter Name">
                                <span class="form-text error-text name_error" style="color: red"></span>
                            </div>
                            <div class="form-group col-lg-6">
                                <label>Thumbnail</label>
                                <div></div>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="thumbnail" name="thumbnail">
                                    <label class="custom-file-label" for="thumbnail">Choose file</label>
                                </div>
                            </div>
                            <div class="form-group col-lg-6">
                                <label>Select Category</label>
                                <select class="form-control kt-select2 category_id" style="width: 100%" id="kt_select2_1" name="category_id">

                                </select>
                                <span class="form-text error-text category_id_error" style="color: red"></span>
                            </div>
                            <div class="form-group col-lg-6">
                                <label>Select Type</label>
                                <select class="form-control kt-select2 type" style="width: 100%" id="kt_select2_1" name="type">
                                    <option value="0">Indoor</option>
                                    <option value="1">Outdoor</option>
                                </select>
                                <span class="form-text error-text type_error" style="color: red"></span>
                            </div>
                            <div class="form-group col-lg-12">
                                <label>Description</label>
                                <input type="text" class="form-control" name="description" id="description" placeholder="Enter Description">
                                <span class="form-text error-text description_error" style="color: red"></span>
                            </div>
                            <div class="form-group col-lg-6">
                                <label>Choose Media</label>
                                <div></div>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="media" name="media">
                                    <label class="custom-file-label" for="media">Choose file</label>
                                </div>
                            </div>
                            <div class="form-group col-lg-6">
                                <label>Duration</label>
                                <input type="number" class="form-control" name="duration" id="duration">
                                <span class="form-text error-text duration_error" style="color: red"></span>
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

    <div class="modal fade" id="editFitness" tabindex="-1" role="dialog" aria-labelledby="editFitnessLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editFitnessLabel">Fitness</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <form class="kt-form" method="post" id="editFitnessForm" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="modal-body">
                        <input type="hidden" name="fitness_id" id="fitness_id">
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

    <div class="modal fade" id="deleteFitness" tabindex="-1" role="dialog" aria-labelledby="deleteFitnessLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteFitnessLabel">Delete</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <form class="kt-form" method="post" id="deleteFitnessForm">
                    @csrf
                    @method('DELETE')
                    <div class="modal-body">
                        <input type="hidden" name="fitness_id" id="fitness_id">
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

            fetchFitnesses();

            function fetchFitnesses()
            {
                $.ajax({
                    type: "GET",
                    url: "fetchFitnesses",
                    dataType: "json",
                    success: function (response) {
                        $('tbody').html("");
                        $.each(response.fitnesses, function (key, fitness) {
                            $('tbody').append('<tr>\
                            <td>'+fitness.id+'</td>\
                            <td><video width="75" height="50" controls><source src="storage/'+fitness.media+'"></video></td>\
                            <td>'+fitness.name+'</td>\
                            <td>'+fitness.category.name+'</td>\
                            <td>'+fitness.type+'</td>\
                            <td>'+fitness.description+'</td>\
                            <td><button value="'+fitness.id+'" style="border: none; background-color: #fff" class="edit_btn"><i class="flaticon2-edit"></i></button></td>\
                            <td><button value="'+fitness.id+'" style="border: none; background-color: #fff" class="delete_btn"><i class="flaticon2-delete"></i></button></td>\
                    </tr>');
                        });
                    }
                });
            }

            function fetchCategories() {
                $.ajax({
                    type: "GET",
                    url: "fetchCategories",
                    dataType: "json",
                    success: function (response) {
                        var category_id = $('.category_id');
                        $('.category_id').children().remove().end()
                        $.each(response.categories, function (category) {
                            category_id.append($("<option />").val(response.categories[category].id).text(response.categories[category].name));
                        });
                    }
                });
            }

            $(document).on('click', '#addFitnessButton', function (e) {
                e.preventDefault();
                $('#addFitness').modal('show');
                fetchCategories();
                $(document).find('span.error-text').text('');
            });

            $(document).on('click', '.delete_btn', function (e) {
                e.preventDefault();
                var fitness_id = $(this).val();
                $('#deleteFitness').modal('show');
                $('#fitness_id').val(fitness_id)
            });

            $(document).on('submit', '#deleteFitnessForm', function (e) {
                e.preventDefault();
                var fitness_id = $('#fitness_id').val();

                $.ajax({
                    type: 'delete',
                    url: 'fitness/'+fitness_id,
                    dataType: 'json',
                    success: function (response) {
                        if (response.status == 0) {
                            $('#deleteFitness').modal('hide');
                        }
                        else {
                            fetchFitnesses();
                            $('#deleteFitness').modal('hide');
                        }
                    }
                });
            });

            $(document).on('click', '.edit_btn', function (e) {
                e.preventDefault();
                var fitness_id = $(this).val();
                $('#editFitness').modal('show');
                $(document).find('span.error-text').text('');
                $.ajax({
                    type: "GET",
                    url: 'fitness/'+fitness_id+'/edit',
                    success: function (response) {
                        if (response.status == 404) {
                            $('#editFitness').modal('hide');
                        }
                        else {
                            $('#fitness_id').val(response.fitness.id);
                            $('#edit_information').val(response.fitness.information);
                        }
                    }
                });
            });

            $(document).on('submit', '#editFitnessForm', function (e) {
                e.preventDefault();
                var fitness_id = $('#fitness_id').val();
                let EditFormData = new FormData($('#editFitnessForm')[0]);

                $.ajax({
                    type: "post",
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content'), '_method': 'patch'},
                    url: "fitness/"+fitness_id,
                    data: EditFormData,
                    contentType: false,
                    processData: false,
                    beforeSend:function (){
                        $(document).find('span.error-text').text('');
                    },
                    success: function (response) {
                        if (response.status == 0){
                            $('#editFitness').modal('show')
                            $.each(response.error, function (prefix, val){
                                $('span.'+prefix+'_update_error').text(val[0]);
                            });
                        }else {
                            $('#editFitnessForm')[0].reset();
                            $('.custom-file-label').text('Choose File');
                            $('#editFitness').modal('hide');
                            fetchFitnesses();
                        }
                    },
                    error: function (error){
                        console.log(error)
                        $('#editFitness').modal('show');
                    }
                });
            })

            $(document).on('submit', '#addFitnessForm', function (e){
                e.preventDefault();
                let formDate = new FormData($('#addFitnessForm')[0]);
                $.ajax({
                    type: "post",
                    url: "fitness",
                    data: formDate,
                    contentType: false,
                    processData: false,
                    beforeSend:function (){
                        $(document).find('span.error-text').text('');
                    },
                    success: function (response) {
                        if (response.status == 0){
                            $('#addFitness').modal('show')
                            $.each(response.error, function (prefix, val){
                                $('span.'+prefix+'_error').text(val[0]);
                            });
                        }else {
                            $('#addFitnessForm')[0].reset();
                            $('.custom-file-label').text('Choose File');
                            $('#addFitness').modal('hide');
                            fetchFitnesses();
                        }
                    },
                    error: function (error){
                        $('#addFitness').modal('show')
                    }
                });
            });
        });
    </script>

@endsection
