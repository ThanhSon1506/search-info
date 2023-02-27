function featureds() {
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
        var table = $("#featureds_table").DataTable({
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
                    title: "Tác vụ",
                    data: "id",
                    name: "id",
                    className: "text-center",
                    bSortable: false,
                    render: function (data, type, row, meta) {
                        return renderAction([{
                            class: 'btn-update-featureds',
                            value: row.id,
                            title: 'Sửa',
                            icon: 'fas fa-edit',
                            color: 'primary'
                        },
                        {
                            class: 'btn-delete-featureds',
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

        var description = new Quill('#description_quill_featureds', {
            modules: {
                toolbar: toolbarOptions,

            },
            theme: 'snow'
        });
        $("#btn_insert_featureds").on("click", function () {
            $("#submit_featureds").attr('data-url', datas.routes.insert);
            $("#modal-title-featureds").text("Thêm mới");
            $("#submit_featureds").attr('data-action', 'insert');
            $("#submit_featureds").attr('data-id', '');
            description.root.innerHTML = '';
            $("#featureds_modal").modal('show');
        });
        // Open dialog modal data update
        $(document).delegate(".btn-update-featureds", "click", function () {
            var id = $(this).val();
            $("#submit_featureds").attr('data-action', 'update');
            $("#modal-title-featureds").text("Cập nhật dữ liệu");
            $("#submit_featureds").attr('data-action', 'update');
            $("#featureds_modal").modal('show');
            $.ajax({
                url: datas.routes.update,
                data: {
                    id: id
                },
                type: 'GET',
                dataType: 'JSON',
                success: function (data) {
                    console.log(data);
                    $("#submit_featureds").attr('data-url', datas.routes.update);
                    $("#submit_featureds").attr('data-id', data.data.id);
                    document.getElementById("featureds_title").value = data.data.title;
                    description.root.innerHTML = data.data.des;
                    $("#featureds_icon").val(data.data.icon).trigger('change');

                },
                error: function (error) {
                    console.log(error);
                }
            });
        });
        // Open dialog modal data delete
        $(document).delegate(".btn-delete-featureds", "click", function () {
            var id = $(this).val();
            $('#modal-title-featureds').text(" Bạn có muốn xóa không ?");
            $("#onDeleteFeatureds").attr('value', id);
            $("#modal-delete-featureds").modal('show');
        });
        // Delete data categories
        $("#onDeleteFeatureds").on("click", function (e) {
            e.preventDefault(e);
            var id = $(this).val();
            var result = AjaxDelete({
                id: id
            }, datas.routes.delete_featureds);
            if (result) {
                table.ajax.reload();
                $("#modal-delete-featureds").modal('hide');
            } else {
                $("#modal-delete-featureds").modal('hide');
            }
        });
        // Open dialog modal data update
        $(document).ready(function () {
            $('#featureds_icon').select2({
                dropdownParent: $('#featureds_modal')
            });

        });
        $("#featureds_icon").on("change", function () {
            $("#icon_featureds_icon").html(`<i class="${$(this).val()}"></i>`);
        });
        // Insert and Update data categories
        $('#featureds_form').validate({
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
                var getDescription = document.getElementById('featureds_des').value = description.root.innerHTML;
                var formData = new FormData($("#featureds_form")[0]);
                formData.append('id', $("#submit_featureds").attr('data-id'));
                formData.append('featureds_des', getDescription);
                var url = $('#submit_featureds').attr('data-url');
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
                            $('#featureds_form')[0].reset();
                            $('#featureds_modal').modal('hide');
                            table.ajax.reload();
                        }
                        else {
                            toastr.error(data.msg);
                            $('#featureds_modal').modal('hide');
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