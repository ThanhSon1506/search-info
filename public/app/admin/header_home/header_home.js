function header_home() {
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
        var table = $("#header_home_table").DataTable({
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
                    title: "Icon",
                    data: "icon",
                    name: "icon",
                    class: "",
                    className: "text-center",
                    render: function (data, type, row, meta) {
                        if (data === null) {
                            return 'Chưa có dữ liệu';
                        } else {
                            return `<i class="${data}"></i>`
                        }

                    }
                },
                {
                    title: "Tiêu đề",
                    data: "title",
                    name: "tile",
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
                            class: 'btn-update-header-home',
                            value: row.id,
                            title: 'Sửa',
                            icon: 'fas fa-edit',
                            color: 'primary'
                        },
                        {
                            class: 'btn-delete-header-home',
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
        // Open diallog modal data insert
        $("#btn-insert").on("click", function () {
            $("#submit").attr('data-url', datas.routes.insert);
            $("#modal-title").text("Thêm mới");
            $("#submit").attr('data-action', 'insert');
            $("#submit").attr('data-id', '');
            document.getElementById("header_home_title").value = "";
            document.getElementById("header_home_icon").value = "";

            description.root.innerHTML = '';
            $("#header_home_modal").modal('show');
        });
        // Open dialog modal data update
        $(document).ready(function () {
            $('#header_home_icon').select2({
                dropdownParent: $('#header_home_modal')
            });

        });
        $("#header_home_icon").on("change", function () {
            $("#icon_header_home_icon").html(`<i class="${$(this).val()}"></i>`);
        });
        $(document).delegate(".btn-update-header-home", "click", function () {
            var id = $(this).val();
            $("#submit").attr('data-action', 'update');
            $("#modal-title-header").text("Cập nhật dữ liệu");
            $("#submit").attr('data-action', 'update');
            $("#header_home_modal").modal('show');
            $.ajax({
                url: datas.routes.update,
                data: {
                    id: id
                },
                type: 'GET',
                dataType: 'JSON',
                success: function (data) {
                    console.log(data);
                    $("#submit").attr('data-url', datas.routes.update);
                    $("#submit").attr('data-id', data.data.id);
                    document.getElementById("header_home_title").value = data.data.title;
                    $("#header_home_icon").val(data.data.icon).trigger('change');
                    // document.getElementById("header_home_icon").value = data.data.icon;
                    // $('#title').val(data.data.title)
                    description.root.innerHTML = data.data.des;
                },
                error: function (error) {
                    console.log(error);
                }
            });
        });
        // Open dialog modal data delete
        $(document).delegate(".btn-delete-header-home", "click", function () {
            var id = $(this).val();
            $('#modal-text-delete-header').text(" Bạn có muốn xóa không ?");
            $("#onDeleteHeader").attr('value', id);
            $("#onDeleteHeader").attr('data-id', id);
            $("#modal-delete-header-home").modal('show');
        });
        // Delete data categories
        $("#onDeleteHeader").on("click", function (e) {
            e.preventDefault(e);
            var id = $(this).val();
            console.log(id);
            var result = AjaxDelete({
                id: id
            }, datas.routes.delete);
            if (result) {
                table.ajax.reload();
                $("#modal-delete-header-home").modal('hide');
            } else {
                $("#modal-delete-header-home").modal('hide');

            }
        });

        // Insert and Update data categories
        $('#header_home_form').validate({
            rules: {
                title: {
                    required: true,
                    maxlength: 150,
                    validateScript: true
                },
            },
            messages: {
                title: {
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
                var formData = new FormData($("#header_home_form")[0]);
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
                            $('#header_home_form')[0].reset();
                            $('#header_home_modal').modal('hide');
                            table.ajax.reload();
                        }
                        else {
                            toastr.error(data.msg);
                            $('#header_home_modal').modal('hide');
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