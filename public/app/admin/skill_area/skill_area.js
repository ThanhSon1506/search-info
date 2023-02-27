function skill_area() {
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
        var table = $("#skill_area_table").DataTable({
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
                    title: "Tiêu đề",
                    data: "title",
                    name: "tile",
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
                            class: 'btn-update-skill-area',
                            value: row.id,
                            title: 'Sửa',
                            icon: 'fas fa-edit',
                            color: 'primary'
                        },
                        {
                            class: 'btn-delete-skill-area',
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
        $("#btn_insert_skill_area").on("click", function () {
            $("#submit_skill_area").attr('data-url', datas.routes.insert);
            $("#modal-title-skill-area").text("Thêm mới");
            $("#submit_skill_area").attr('data-action', 'insert');
            $("#submit_skill_area").attr('data-id', '');
            $("#skill_area_modal").modal('show');
        });
        // Open dialog modal data update
        $(document).delegate(".btn-update-skill-area", "click", function () {
            var id = $(this).val();
            $("#submit_skill_area").attr('data-action', 'update');
            $("#modal-title-skill-area").text("Cập nhật dữ liệu");
            $("#submit_skill_area").attr('data-action', 'update');
            $("#skill_area_modal").modal('show');
            $.ajax({
                url: datas.routes.update,
                data: {
                    id: id
                },
                type: 'GET',
                dataType: 'JSON',
                success: function (data) {
                    console.log(data);
                    $("#submit_skill_area").attr('data-url', datas.routes.update);
                    $("#submit_skill_area").attr('data-id', data.data.id);
                    document.getElementById("skill_area_title").value = data.data.title;
                },
                error: function (error) {
                    console.log(error);
                }
            });
        });
        // Open dialog modal data delete
        $(document).delegate(".btn-delete-skill-area", "click", function () {
            var id = $(this).val();
            $('#modal-text-delete-skill-area').text(" Bạn có muốn xóa không ?");
            $("#onDeleteSkillArea").attr('value', id);
            $("#modal-delete-skill-area").modal('show');
        });
        // Delete data categories
        $("#onDeleteSkillArea").on("click", function (e) {
            e.preventDefault(e);
            var id = $(this).val();
            var result = AjaxDelete({
                id: id
            }, datas.routes.delete_skill_area);
            if (result) {
                table.ajax.reload();
                $("#modal-delete-skill-area").modal('hide');
            } else {
                $("#modal-delete-skill-area").modal('hide');
            }
        });

        // Insert and Update data categories
        $('#skill_area_form').validate({
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
                var formData = new FormData($("#skill_area_form")[0]);
                formData.append('id', $("#submit_skill_area").attr('data-id'));
                var url = $('#submit_skill_area').attr('data-url');
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
                            $('#skill_area_form')[0].reset();
                            $('#skill_area_modal').modal('hide');
                            table.ajax.reload();
                        }
                        else {
                            toastr.error(data.msg);
                            $('#skill_area_modal').modal('hide');
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