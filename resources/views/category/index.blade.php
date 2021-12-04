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
                                Categories
                            </div>
                        </div>
                        <div class="kt-align-left mt-3">
                            <a href="" data-toggle="modal" data-target="#addCategory" id="addCategoryButton" class="btn btn-primary" style="float:right;"><i class="flaticon2-add-1"></i> New Category </a>
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
                                        <th width="10%">Image</th>
                                        <th>Name</th>
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

    <div class="modal fade" id="addCategory" tabindex="-1" role="dialog" aria-labelledby="addCategoryLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCategoryLabel">Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <form class="kt-form" method="post" id="addCategoryForm" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="kt-portlet__body">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control" name="name" id="name" placeholder="Enter Name">
                                <span class="form-text error-text name_error" style="color: red"></span>
                            </div>
                            <div class="form-group">
                                <label>File Browser</label>
                                <div></div>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="image" name="image">
                                    <label class="custom-file-label" for="image">Choose file</label>
                                </div>
                                <span class="form-text error-text image_error" style="color: red"></span>
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

    <div class="modal fade" id="editCategory" tabindex="-1" role="dialog" aria-labelledby="editCategoryLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editCategoryLabel">Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <form class="kt-form" method="post" id="editCategoryForm" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="modal-body">
                        <input type="hidden" name="category_id" id="category_id">
                        <div class="kt-portlet__body">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control" name="name" id="edit_name">
                                <span class="form-text error-text name_update_error" style="color: red"></span>
                            </div>
                            <div class="form-group">
                                <label>File Browser</label>
                                <div></div>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="edit_image" name="image">
                                    <label class="custom-file-label" for="edit_image">Choose file</label>
                                </div>
                                <span class="form-text error-text image_update_error" style="color: red"></span>
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

    <div class="modal fade" id="deleteCategory" tabindex="-1" role="dialog" aria-labelledby="deleteCategoryLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteCategoryLabel">Delete</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <form class="kt-form" method="post" id="deleteCategoryForm">
                    @csrf
                    @method('DELETE')
                    <div class="modal-body">
                        <input type="hidden" name="category_id" id="category_id">
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

            fetchCategories();

            function fetchCategories()
            {
                $.ajax({
                    type: "GET",
                    url: "fetchCategories",
                    dataType: "json",
                    success: function (response) {
                        $('tbody').html("");
                        $.each(response.categories, function (key, category) {
                            $('tbody').append('<tr>\
                            <td>'+category.id+'</td>\
                            <td><img width="50px" height="50px" src="storage/'+category.image+'"></td>\
                            <td>'+category.name+'</td>\
                            <td><button value="'+category.id+'" style="border: none; background-color: #fff" class="edit_btn"><i class="flaticon2-edit"></i></button></td>\
                            <td><button value="'+category.id+'" style="border: none; background-color: #fff" class="delete_btn"><i class="flaticon2-delete"></i></button></td>\
                    </tr>');
                        });
                    }
                });
            }

            $(document).on('click', '.delete_btn', function (e) {
                e.preventDefault();
                var category_id = $(this).val();
                $('#deleteCategory').modal('show');
                $('#category_id').val(category_id)
            });

            $(document).on('submit', '#deleteCategoryForm', function (e) {
                e.preventDefault();
                var category_id = $('#category_id').val();

                $.ajax({
                    type: 'delete',
                    url: 'category/'+category_id,
                    dataType: 'json',
                    success: function (response) {
                        if (response.status == 0) {
                            $('#deleteCategory').modal('hide');
                        }
                        else {
                            fetchCategories();
                            $('#deleteCategory').modal('hide');
                        }
                    }
                });
            });

            $(document).on('click', '.edit_btn', function (e) {
                e.preventDefault();
                var category_id = $(this).val();
                $('#editCategory').modal('show');
                $(document).find('span.error-text').text('');
                $.ajax({
                    type: "GET",
                    url: 'category/'+category_id+'/edit',
                    success: function (response) {
                        if (response.status == 404) {
                            $('#editCategory').modal('hide');
                        }
                        else {
                            $('#category_id').val(response.category.id);
                            $('#edit_name').val(response.category.name);
                        }
                    }
                });
            });

            $(document).on('submit', '#editCategoryForm', function (e) {
                e.preventDefault();
                var category_id = $('#category_id').val();
                let EditFormData = new FormData($('#editCategoryForm')[0]);

                $.ajax({
                    type: "post",
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content'), '_method': 'patch'},
                    url: "category/"+category_id,
                    data: EditFormData,
                    contentType: false,
                    processData: false,
                    beforeSend:function (){
                        $(document).find('span.error-text').text('');
                    },
                    success: function (response) {
                        if (response.status == 0){
                            $('#editCategory').modal('show')
                            $.each(response.error, function (prefix, val){
                                $('span.'+prefix+'_update_error').text(val[0]);
                            });
                        }else {
                            $('#editCategoryForm')[0].reset();
                            $('.custom-file-label').text('Choose File');
                            $('#editCategory').modal('hide');
                            fetchCategories();
                        }
                    },
                    error: function (error){
                        console.log(error)
                        $('#editCategory').modal('show');
                    }
                });
            })

            $(document).on('submit', '#addCategoryForm', function (e){
                e.preventDefault();
                let formDate = new FormData($('#addCategoryForm')[0]);
                $.ajax({
                    type: "post",
                    url: "category",
                    data: formDate,
                    contentType: false,
                    processData: false,
                    beforeSend:function (){
                        $(document).find('span.error-text').text('');
                    },
                    success: function (response) {
                        if (response.status == 0){
                            $('#addCategory').modal('show')
                            $.each(response.error, function (prefix, val){
                                $('span.'+prefix+'_error').text(val[0]);
                            });
                        }else {
                            $('#addCategoryForm')[0].reset();
                            $('.custom-file-label').text('Choose File');
                            $('#addCategory').modal('hide');
                            fetchCategories();
                        }
                    },
                    error: function (error){
                        $('#addCategory').modal('show')
                    }
                });
            });
        });
    </script>

@endsection
