function news() {
    // CKEDITOR.replace('content');
    // CKEDITOR.replace('summary');
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
        var table = $("#newsTable").DataTable({
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
                        category: $("#category").val(),
                    });
                }
            },
            order: [0, "desc"],
            columns: [
                {
                    title: "Tiêu đề",
                    data: "title",
                    name: "title",
                    className: "",
                    render: function (data, type, row, meta) {
                        if (data === null) {
                            return 'Chưa có dữ liệu';
                        } else {
                            return data + '<br/>' + '<i>' + '<b>Danh mục:</b>' + row.categories.name + '</i>';
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
                    className: "text-center",
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
            ['bold', 'italic', 'underline', 'strike'],        // toggled buttons
            ['blockquote', 'code-block'],

            [{ 'header': 1 }, { 'header': 2 }],               // custom button values
            [{ 'list': 'ordered' }, { 'list': 'bullet' }],
            [{ 'script': 'sub' }, { 'script': 'super' }],      // superscript/subscript
            [{ 'indent': '-1' }, { 'indent': '+1' }],          // outdent/indent
            [{ 'direction': 'rtl' }],                         // text direction

            [{ 'size': ['small', false, 'large', 'huge'] }],  // custom dropdown
            [{ 'header': [1, 2, 3, 4, 5, 6, false] }],

            [{ 'color': [] }, { 'background': [] }],          // dropdown with defaults from theme
            [{ 'font': [] }],
            [{ 'align': [] }],

            ['clean']                                         // remove formatting button
        ];
        // var summary = new Quill('#summary_quill', {
        //     theme: 'snow'
        // });

        var content = new Quill('#content_quill', {

            modules: {
                toolbar: toolbarOptions,

            },
            theme: 'snow'
        });
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
            document.querySelector('input[type="file"]').addEventListener('change', function () {
                if (this.files && this.files[0]) {
                    var img = document.querySelector('#image_preview');
                    img.onload = () => {
                        URL.revokeObjectURL(img.src);
                    }

                    img.src = URL.createObjectURL(this.files[0]);
                }
            });
        });
        // // Search data by submit
        // $("#search").on("click", function () {
        //     table.ajax.reload();
        // });
        $("#category").on("change", function () {
            table.ajax.reload();
        });
        // //Tìm kiếm bằng phím Enter
        // document.getElementById("search").addEventListener("keyup", function (event) {
        //     if (event.keyCode === 13) {
        //         table.ajax.reload();
        //         return false;
        //     }
        // });
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
                    $('#image_view').attr("src", "/uploads/post/" + data.data.image);
                    $('#title_view').html(data.data.title);
                    $('#description_view').html(data.data.content);
                },
                error: function (error) {
                    console.log(error);
                }
            });
        });
        // Open diallog modal data insert
        $("#btn-insert").on("click", function () {
            $("#submit").attr('data-url', datas.routes.insert);
            $("#modal-title").text("Thêm mới bài viết mới");
            $("#submit").attr('data-action', 'insert');
            $("#submit").attr('data-id', '');
            $("#title").val('');
            $("#category_id").val('');
            $.ajax({
                url: datas.routes.image,
                type: "GET",
                dataType: 'JSON',
                success: function (data) {
                    $('#image_preview').attr("src", "/uploads/" + data.guest_logo_header);
                }
            })


            // CKEDITOR.instances['content'].setData('');
            // CKEDITOR.instances['summary'].setData('');
            // summary.root.innerHTML = '';
            content.root.innerHTML = '';
            $("#newsModal").modal('show');
        });
        //
        // Open dialog modal data update
        $(document).delegate(".btn-update", "click", function () {
            var id = $(this).val();
            $("#submit").attr('data-action', 'update');
            $("#modal-title").text("Cập nhật bài viết");
            $("#submit").attr('data-action', 'update');
            $("#newsModal").modal('show');
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
                    $('#title').val(data.data.title);
                    $('#category_id').val(data.data.category_id);
                    $('#summary').val(data.data.summary);
                    $('#image_preview').attr("src", "/uploads/post/" + data.data.image);
                    // CKEDITOR.instances['content'].setData(data.data.content);
                    // CKEDITOR.instances['summary'].setData(data.data.summary);
                    // summary.root.innerHTML = data.data.summary;
                    content.root.innerHTML = data.data.content;
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
        $('#newsForm').validate({
            rules: {
                title: {
                    required: true,
                    maxlength: 100,
                    validateScript: true
                },
                category_id: {
                    required: true,
                    maxlength: 100,
                    validateScript: true
                },
                summary: {
                    required: true,
                    maxlength: 100,
                    validateScript: true
                }


            },
            messages: {
                title: {
                    required: "Tiêu đề không được trống !",
                    maxlength: "Tiêu đề không được quá 150 ký tự !"
                },
                summary: {
                    required: "Tóm lược không được trống !",
                    maxlength: "Tóm lược không được quá 100 ký tự !"
                },
                content: {
                    required: "Nội dung không được trống !",
                    maxlength: "Nội dung không được quá 150 ký tự !"
                },
                category_id: {
                    required: "Danh mục không được trống !",
                    maxlength: "Danh mục không được quá 150 ký tự !"
                },
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
            onfocusout: function (element) { return false; },
            submitHandler: function (e) {
                // var getSummary = document.getElementById("summary").value = summary.root.innerHTML;
                var getContent = document.getElementById("content").value = content.root.innerHTML;
                // var getSummary = CKEDITOR.instances['summary'].getData();
                // var getContent = CKEDITOR.instances['content'].getData();
                var formData = new FormData($("#newsForm")[0]);
                formData.append('image', $('#image')[0].files[0]);
                formData.append('content', getContent);
                // formData.append('summary', getSummary);
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
                            $('#newsForm')[0].reset();
                            $('#newsModal').modal('hide');
                            table.ajax.reload();
                        }
                        else {
                            toastr.error(data.msg);
                            $('#newsModal').modal('hide');
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