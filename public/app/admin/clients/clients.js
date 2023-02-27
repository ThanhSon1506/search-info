function clients() {
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
        var table = $("#clients_table").DataTable({
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
                    title: "Ảnh",
                    data: "image",
                    name: "image",
                    class: "",
                    className: "",
                    render: function (data, type, row, meta) {
                        if (data === null) {
                            return 'Chưa có dữ liệu';
                        } else {
                            return `<img src="/themes/guest/img/clients/${data}" alt="" width="120">`;
                        }

                    }
                },
                {
                    title: "Ảnh có màu",
                    data: "image_color",
                    name: "image_color",
                    class: "",
                    className: "",
                    render: function (data, type, row, meta) {
                        if (data === null) {
                            return 'Chưa có dữ liệu';
                        } else {
                            return `<img src="/themes/guest/img/clients/${data}" alt="" width="120">`;
                        }

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
                            class: 'btn-update-clients',
                            value: row.id,
                            title: 'Sửa',
                            icon: 'fas fa-edit',
                            color: 'primary'
                        },
                        {
                            class: 'btn-delete-clients',
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
        // Check size 
        Filevalidation = () => {
            const fi = document.getElementById('image');
            if (fi.files.length > 0) {
                for (var i = 0; i <= fi.files.length - 1; i++) {
                    const fsize = fi.files.item(i).size;
                    const file = Math.round((fsize / 1024));
                    if (file >= 5120) {
                        toastr.error("File quá lớn, file chỉ 4mb");

                        return false;
                    }
                }
            }
        }
        // Check size 
        Filevalidation2 = () => {
            const fi = document.getElementById('image_color');
            if (fi.files.length > 0) {
                for (var i = 0; i <= fi.files.length - 1; i++) {
                    const fsize = fi.files.item(i).size;
                    const file = Math.round((fsize / 1024));
                    if (file >= 5120) {
                        toastr.error("File quá lớn, file chỉ 4mb");

                        return false;
                    }
                }
            }
        }
        //Updaload image
        window.addEventListener('load', function () {
            document.querySelector('#image').addEventListener('change', function () {
                if (this.files && this.files[0]) {
                    var img = document.querySelector('#image_preview_clients');
                    img.onload = () => {
                        URL.revokeObjectURL(img.src);
                    }
                    document.querySelector('#label_image_clients').innerHTML = "";
                    img.src = URL.createObjectURL(this.files[0]);
                }
            });
        });

        //Updaload image
        window.addEventListener('load', function () {
            document.querySelector('#image_color').addEventListener('change', function () {
                console.log("upload 2");
                if (this.files && this.files[0]) {
                    var img = document.querySelector('#image_preview_clients_color');
                    img.onload = () => {
                        URL.revokeObjectURL(img.src);
                    }
                    document.querySelector('#label_image_clients_color').innerHTML = "";
                    img.src = URL.createObjectURL(this.files[0]);
                }
            });
        });

        $("#btn_insert_clients").on("click", function () {
            $("#submit_clients").attr('data-url', datas.routes.insert);
            $("#modal-title-clients").text("Thêm mới");
            $("#submit_clients").attr('data-action', 'insert');
            $("#submit_clients").attr('data-id', '');
            $("#clients_modal").modal('show');
        });
        // Open dialog modal data update
        $(document).delegate(".btn-update-clients", "click", function () {
            var id = $(this).val();
            $("#submit_clients").attr('data-action', 'update');
            $("#modal-title-clients").text("Cập nhật dữ liệu");
            $("#submit_clients").attr('data-action', 'update');
            $("#clients_modal").modal('show');
            $.ajax({
                url: datas.routes.update,
                data: {
                    id: id
                },
                type: 'GET',
                dataType: 'JSON',
                success: function (data) {
                    console.log(data);
                    $("#submit_clients").attr('data-url', datas.routes.update);
                    $("#submit_clients").attr('data-id', data.data.id);
                    $('#image_preview').attr("src", "/themes/guest/img/team/" + data.data.image);
                },
                error: function (error) {
                    console.log(error);
                }
            });
        });
        // Open dialog modal data delete
        $(document).delegate(".btn-delete-clients", "click", function () {
            var id = $(this).val();
            $('#modal-text-delete-clients').text(" Bạn có muốn xóa không ?");
            $("#onDeleteClients").attr('value', id);
            $("#modal-delete-clients").modal('show');
        });
        // Delete data categories
        $("#onDeleteClients").on("click", function (e) {
            e.preventDefault(e);
            var id = $(this).val();
            var result = AjaxDelete({
                id: id
            }, datas.routes.delete_clients);
            if (result) {
                table.ajax.reload();
                $("#modal-delete-clients").modal('hide');
            } else {
                $("#modal-delete-clients").modal('hide');
            }
        });

        // Insert and Update data categories
        $('#clients_form').validate({
            rules: {
                title: {
                    required: true,
                    maxlength: 150,
                    validateScript: true
                },
            },
            messages: {
                title: {
                    required: "Tiêu đề không được trống !",
                    maxlength: "Tiêu đề không được quá 150 ký tự !"
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
                var formData = new FormData($("#clients_form")[0]);
                formData.append('id', $("#submit_clients").attr('data-id'));
                formData.append('image', $('#image')[0].files[0]);
                var url = $('#submit_clients').attr('data-url');
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
                            $('#clients_form')[0].reset();
                            $('#clients_modal').modal('hide');
                            table.ajax.reload();
                        }
                        else {
                            toastr.error(data.msg);
                            $('#clients_modal').modal('hide');
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