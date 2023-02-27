function awesome() {
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
        var table = $("#awesome_table").DataTable({
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
                            return `<img class="rounded-circle" src="/themes/guest/img/team/${data}" alt="" width="48" height="48">`;
                        }

                    }
                },
                {
                    title: "Tên",
                    data: "name",
                    name: "name",
                    class: "",
                    className: "",
                },
                {
                    title: "Chức vụ",
                    data: "position",
                    name: "position",
                    class: "",
                    className: "",
                },
                {
                    title: "Mô tả",
                    data: "des",
                    name: "des",
                    class: "",
                    className: "",
                },
                {
                    title: "Thao tác",
                    data: "id",
                    name: "id",
                    className: "text-center",
                    bSortable: false,
                    render: function (data, type, row, meta) {
                        return renderAction([{
                            class: 'btn-update-awesome',
                            value: row.id,
                            title: 'Sửa',
                            icon: 'fas fa-edit',
                            color: 'primary'
                        },
                        {
                            class: 'btn-delete-awesome',
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
        //Updaload image
        window.addEventListener('load', function () {
            document.querySelector('#image').addEventListener('change', function () {
                console.log("upload");
                if (this.files && this.files[0]) {
                    var img = document.querySelector('#image_preview');
                    img.onload = () => {
                        URL.revokeObjectURL(img.src);
                    }
                    document.querySelector('#label_image').innerHTML = "";
                    img.src = URL.createObjectURL(this.files[0]);
                }
            });
        });
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

        var description = new Quill('#description_quill_awesome', {
            modules: {
                toolbar: toolbarOptions,

            },
            theme: 'snow'
        });
        $("#btn_insert_awesome").on("click", function () {
            $("#submit_awesome").attr('data-url', datas.routes.insert);
            $("#modal-title-awesome").text("Thêm mới");
            $("#submit_awesome").attr('data-action', 'insert');
            $("#submit_awesome").attr('data-id', '');
            description.root.innerHTML = '';
            $("#awesome_modal").modal('show');
        });
        // Open dialog modal data update
        $(document).delegate(".btn-update-awesome", "click", function () {
            var id = $(this).val();
            $("#submit_awesome").attr('data-action', 'update');
            $("#modal-title-awesome").text("Cập nhật dữ liệu");
            $("#submit_awesome").attr('data-action', 'update');
            $("#awesome_modal").modal('show');
            $.ajax({
                url: datas.routes.update,
                data: {
                    id: id
                },
                type: 'GET',
                dataType: 'JSON',
                success: function (data) {
                    console.log(data);
                    $("#submit_awesome").attr('data-url', datas.routes.update);
                    $("#submit_awesome").attr('data-id', data.data.id);
                    document.getElementById("awesome_name").value = data.data.name;
                    document.getElementById("awesome_position").value = data.data.position;
                    $('#image_preview').attr("src", "/themes/guest/img/team/" + data.data.image);
                    description.root.innerHTML = data.data.des;
                },
                error: function (error) {
                    console.log(error);
                }
            });
        });
        // Open dialog modal data delete
        $(document).delegate(".btn-delete-awesome", "click", function () {
            var id = $(this).val();
            $('#modal-text-delete-awesome').text(" Bạn có muốn xóa không ?");
            $("#onDeleteAwesome").attr('value', id);
            $("#modal-delete-awesome").modal('show');
        });
        // Delete data categories
        $("#onDeleteAwesome").on("click", function (e) {
            e.preventDefault(e);
            var id = $(this).val();
            var result = AjaxDelete({
                id: id
            }, datas.routes.delete_awesome);
            if (result) {
                table.ajax.reload();
                $("#modal-delete-awesome").modal('hide');
            } else {
                $("#modal-delete-awesome").modal('hide');
            }
        });

        // Insert and Update data categories
        $('#awesome_form').validate({
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
                var getDescription = document.getElementById('awesome_des').value = description.root.innerHTML;
                var formData = new FormData($("#awesome_form")[0]);
                formData.append('id', $("#submit_awesome").attr('data-id'));
                formData.append('awesome_des', getDescription);
                formData.append('image', $('#image')[0].files[0]);
                var url = $('#submit_awesome').attr('data-url');
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
                            $('#awesome_form')[0].reset();
                            $('#awesome_modal').modal('hide');
                            table.ajax.reload();
                        }
                        else {
                            toastr.error(data.msg);
                            $('#awesome_modal').modal('hide');
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