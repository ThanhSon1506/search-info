function categories() {
    // CKEDITOR.replace('description');
    this.datas = null;
    var datas = null;
    this.init = function () {
        datas = this.datas;
        var me = this;
        me.datatables();
    }
    // Datatables
    this.datatables = function () {
        var me = this;
        var table = $("#categoriesTable").DataTable({
            serverSide: true,
            processing: true,
            paging: true,
            lengthChange: true,
            searching: false,
            ordering: true,
            info: true,
            responsive: true,
            autoWidth: false,
            ajax: {
                url: datas.routes.datatable,
                type: "GET",
                data: function (d) {
                    return $.extend({}, d, {
                        search: $("#search").val(),
                        category: $("#category").val(),
                    });
                }
            },
            order: [0, "desc"],
            columns: [
                {
                    title: "Tên danh mục",
                    data: "name",
                    name: "name",
                    class: "",
                    className: "",
                },
                {
                    title: "Danh cha",
                    data: "parent_cats",
                    name: "parent_cats",
                    class: "",
                    className: "",
                    render: function (data, type, row, meta) {
                        if (data === null) {
                            return 'Chưa có dữ liệu';
                        } else {
                            return data.name;
                        }

                    }

                },
                {
                    title: "Đường dẫn",
                    data: "slug",
                    name: "slug",
                    class: "",
                    className: "",

                },
                {
                    title: "Mô Tả",
                    data: "id",
                    name: "id",
                    className: "",
                    render: function (data, type, row, meta) {
                        if (data === null) {
                            return 'Chưa có dữ liệu';
                        } else {
                            return '<button class="btn btn-outline-secondary" value="' + row.id + '"><i class="fa fa-eye"></i></button>';
                        }

                    }
                },
                {
                    title: "Ngày tạo",
                    data: "created_at",
                    name: "created_at",
                    className: "text-center",
                    render: function (data, type, row, meta) {
                        return changeDate(data);
                    }
                },
                {
                    title: "Thao tác",
                    data: "id",
                    name: "id",
                    className: "text-center",
                    bSortable: false,
                    render: function (data, type, row, meta) {
                        return renderAction([{
                            class: 'btn-update',
                            value: row.id,
                            title: 'Sửa',
                            icon: 'fas fa-edit',
                            color: 'primary'
                        },
                        {
                            class: 'btn-delete',
                            value: row.id,
                            title: 'Xóa',
                            icon: 'fa fa-trash',
                            color: 'danger'
                        }]);
                    }
                },]
        });
        me.action(table);
    }
    // Action
    this.action = function (table) {
        // Quill js
        var toolbarOptions = [
            [{
                'header': [1, 2, 3, 4, 5, 6, false]
            }],
            ['bold', 'italic', 'underline', 'strike', 'blockquote', 'code-block'],
            [{
                'list': 'ordered',
            }, {
                'list': 'bullet'
            }],
        ];

        var description = new Quill('#description_quill', {
            modules: {
                toolbar: toolbarOptions,

            },
            theme: 'snow'
        });
        $("#category").on("change", function () {
            table.ajax.reload();
        });
        // fetchdata category 
        function fetchCategory() {

            $.ajax({
                type: "get",
                url: datas.routes.fetchdata,
                dataType: 'JSON',
                success: function (response) {
                    var data = response
                    var list = document.getElementById("category_id");
                    for (var i in data) {
                        list.add(new Option(data[i].name, data[i].id));
                    }
                }
            });
        }
        // $(document).ready(function () {
        //     $('#category_id').select2({
        //         dropdownParent: $('#categoriesModal')
        //     });
        // });

        // Search data by submit
        $("#search").on("click", function () {
            table.ajax.reload();
        });
        //Tìm kiếm bằng phím Enter
        document.getElementById("search").addEventListener("keyup", function (event) {
            if (event.keyCode === 13) {
                table.ajax.reload();
                return false;
            }
        });
        //Open dialog deltail data description
        $(document).delegate(".btn-outline-secondary", "click", function () {
            var id = $(this).val();
            $('#modalTitle').text("Chi tiết mô tả");
            $("#descriptionModal").modal('show');
            $.ajax({
                url: datas.routes.update,
                data: {
                    id: id
                },
                type: 'GET',
                dataType: 'JSON',
                success: function (data) {
                    $('#description_view').html(data.data.description);
                    console.log(data);
                },
                error: function (error) {
                    console.log(error);
                }
            });
        });
        // Open diallog modal data insert
        $("#btn-insert").on("click", function () {
            $("#submit").attr('data-url', datas.routes.insert);
            $("#modal-title").text("Thêm mới danh mục");
            $("#submit").attr('data-action', 'insert');
            $("#submit").attr('data-id', '');
            $("#name").val('');
            description.root.innerHTML = '';
            // fetchCategory();
            // CKEDITOR.instances['description'].setData('');
            $("#categoriesModal").modal('show');
        });
        // Open dialog modal data update
        $(document).delegate(".btn-update", "click", function () {
            var id = $(this).val();
            $("#submit").attr('data-action', 'update');
            $("#modal-title").text("Cập nhật danh mục");
            $("#submit").attr('data-action', 'update');
            $("#categoriesModal").modal('show');
            $.ajax({
                url: datas.routes.update,
                data: {
                    id: id
                },
                type: 'GET',
                dataType: 'JSON',
                success: function (data) {
                    $("#submit").attr('data-url', datas.routes.update);
                    $("#submit").attr('data-id', data.data.id);
                    $('#name').val(data.data.name)
                    description.root.innerHTML = data.data.description;
                    // fetchCategory();
                    // CKEDITOR.instances['description'].setData(data.data.description);
                    console.log(data);
                },
                error: function (error) {
                    console.log(error);
                }
            });
        });
        // Open dialog modal data delete
        $(document).delegate(".btn-delete", "click", function () {
            var id = $(this).val();
            $('#modal-text-delete').text(" Bạn có muốn xóa không ?");
            $("#onDelete").attr('value', id);
            $("#modal-delete").modal('show');
        });
        // Delete data categories
        $("#onDelete").on("click", function (e) {
            e.preventDefault(e);
            var id = $(this).val();
            var result = AjaxDelete({
                id: id
            }, datas.routes.delete);
            if (result) {
                table.ajax.reload();
                $("#modal-delete").modal('hide');
            } else {
                $("#modal-delete").modal('hide');
            }
        });

        // Insert and Update data categories
        $('#categoriesForm').validate({
            rules: {
                name: {
                    required: true,
                    maxlength: 150,
                    validateScript: true
                },
            },
            messages: {
                name: {
                    required: "Tên không được trống !",
                    maxlength: "Tên không được quá 150 ký tự !"
                }
            },
            errorElement: 'span',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            },
            submitHandler: function (e) {
                // var getDescription = CKEDITOR.instances['description'].getData();
                var getDescription = document.getElementById('description').value = description.root.innerHTML;
                var formData = new FormData($("#categoriesForm")[0]);
                formData.append('description', getDescription);
                formData.append('id', $("#submit").attr('data-id'));
                var url = $('#submit').attr('data-url');
                $.ajax({
                    url: url,
                    data: formData,
                    type: 'POST',
                    dataType: 'JSON',
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        if (data.statusBoolean) {
                            toastr.success(data.msg);
                            $('#categoriesForm')[0].reset();
                            $('#categoriesModal').modal('hide');
                            table.ajax.reload();
                        }
                        else {
                            toastr.error(data.msg);
                            $('#categoriesModal').modal('hide');
                        }
                    },
                });
            }
        });
        // Validate value script categories
        jQuery.validator.addMethod("validateScript", function (value, element) {
            return !(value.includes("script>") ||
                value.includes("script&gt;") ||
                value.includes("<?") ||
                value.includes("&lt;?"));
        }, "Vui lòng nhập đúng định dạng chữ");


    }
}