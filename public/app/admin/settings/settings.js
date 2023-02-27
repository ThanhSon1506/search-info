function settings() {
    // CKEDITOR.replace('services_description');
    this.datas = null;
    var datas = null;
    this.init = function () {
        datas = this.datas;
        var me = this;
        me.action();
    }

    // Action
    this.action = function () {
        //Header quill js
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
        var header = new Quill('#header_des_quill', {
            modules: {
                toolbar: toolbarOptions,

            },
            theme: 'snow'
        });
        //Skill quill js
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
        var skill = new Quill('#skill_des_quill', {
            modules: {
                toolbar: toolbarOptions,

            },
            theme: 'snow'
        });
        //featureds quill js
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
        var featureds = new Quill('#des_featureds_quill', {
            modules: {
                toolbar: toolbarOptions,

            },
            theme: 'snow'
        });
        //awesome quill js
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
        var awesome = new Quill('#des_awesome_quill', {
            modules: {
                toolbar: toolbarOptions,

            },
            theme: 'snow'
        });
        //funfact quill js
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
        var funfact = new Quill('#des_funfact_quill', {
            modules: {
                toolbar: toolbarOptions,

            },
            theme: 'snow'
        });
        //clients quill js
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
        var clients = new Quill('#des_clients_quill', {
            modules: {
                toolbar: toolbarOptions,

            },
            theme: 'snow'
        });

        $(document).ready(function () {
            $('.js-example-basic-single').select2();
        });
        // Thêm và cập nhật dữ liệu
        $('#update_website').validate({
            rules: {
                title: {
                    required: true,
                },
            },
            messages: {
                title: {
                    required: "Tên không được trống !",
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

                var formData = new FormData($("#update_website")[0]);
                formData.append('id', $("#id_setting").val());
                $.ajax({
                    url: datas.routes.update_website,
                    data: formData,
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        location.assign("/"+document.getElementById("route_admin").value+'/settings');
                        toastr.success(data.message);
                    },
                    error: function (error) {
                        console.log("Lỗi");
                    }
                });
            }

        });
        $('#updateHeader').validate({
            rules: {
                title: {
                    required: true,
                },
            },
            messages: {
                title: {
                    required: "Tên không được trống !",
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
                var getDescription = document.getElementById('header_des').value = header.root.innerHTML;
                var formData = new FormData($("#updateHeader")[0]);
                formData.append('id', $("#id_setting").val());
                formData.append('des', getDescription);
                $.ajax({
                    url: datas.routes.update_header,
                    data: formData,
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        toastr.success(data.message);
                    },
                    error: function (error) {
                        console.log("Lỗi");
                    }
                });
            }

        });
        // Thêm và cập nhật dữ liệu skill area
        $('#skillAreaForm').validate({
            rules: {
                title_skill_area: {
                    required: true,
                },
            },
            messages: {
                title_skill_area: {
                    required: "Tiêu đề không được trống !",
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
                var getSkill = document.getElementById('skill_des').value = skill.root.innerHTML;
                var formData = new FormData($("#skillAreaForm")[0]);
                formData.append('des_skill_area', getSkill);
                formData.append('id', $("#id_setting").val());
                $.ajax({
                    url: datas.routes.skill_area,
                    data: formData,
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        toastr.success(data.message);
                    },
                    error: function (error) {
                        console.log("Lỗi");
                    }
                });
            }

        });
        // Thêm và cập nhật dữ liệu featureds
        $('#featuredsForm').validate({
            rules: {
                title_featureds: {
                    required: true,
                },
            },
            messages: {
                title_featureds: {
                    required: "Tiêu đề không được trống !",
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
                var getFeatureds = document.getElementById('des_featureds').value = featureds.root.innerHTML;
                var formData = new FormData($("#featuredsForm")[0]);
                formData.append('des_featureds', getFeatureds);
                formData.append('id', $("#id_setting").val());
                $.ajax({
                    url: datas.routes.featureds,
                    data: formData,
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        toastr.success(data.message);
                    },
                    error: function (error) {
                        console.log("Lỗi");
                    }
                });
            }

        });
        // Thêm và cập nhật dữ liệu skill awesome
        $('#awesomeForm').validate({
            rules: {
                title_featureds: {
                    required: true,
                },
            },
            messages: {
                title_featureds: {
                    required: "Tiêu đề không được trống !",
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
                var getAwesome = document.getElementById('des_awesome').value = awesome.root.innerHTML;
                var formData = new FormData($("#awesomeForm")[0]);
                formData.append('des_awesome', getAwesome);
                formData.append('id', $("#id_setting").val());
                $.ajax({
                    url: datas.routes.awesome,
                    data: formData,
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        toastr.success(data.message);
                    },
                    error: function (error) {
                        console.log("Lỗi");
                    }
                });
            }

        });
        // Thêm và cập nhật dữ liệu funfact
        $('#funfactForm').validate({
            rules: {
                title_funfact: {
                    required: true,
                },
            },
            messages: {
                title_funfact: {
                    required: "Tiêu đề không được trống !",
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
                var getFunfact = document.getElementById('des_funfact').value = funfact.root.innerHTML;
                var formData = new FormData($("#funfactForm")[0]);
                formData.append('des_funfact', getFunfact);
                formData.append('id', $("#id_setting").val());
                $.ajax({
                    url: datas.routes.funfact,
                    data: formData,
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        toastr.success(data.message);
                    },
                    error: function (error) {
                        console.log("Lỗi");
                    }
                });
            }

        });
        // Thêm và cập nhật dữ liệu clients
        $('#clientsForm').validate({
            rules: {
                title_clients: {
                    required: true,
                },
            },
            messages: {
                title_clients: {
                    required: "Tiêu đề không được trống !",
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
                var getClients = document.getElementById('des_clients').value = funfact.root.innerHTML;
                var formData = new FormData($("#clientsForm")[0]);
                formData.append('des_clients', getClients);
                formData.append('id', $("#id_setting").val());
                $.ajax({
                    url: datas.routes.clients,
                    data: formData,
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        toastr.success(data.message);
                    },
                    error: function (error) {
                        console.log("Lỗi");
                    }
                });
            }

        });
        // Validate kiểm tra định dạng ký tự
        jQuery.validator.addMethod("validateScript", function (value, element) {
            return !(value.includes("script>") ||
                value.includes("script&gt;") ||
                value.includes("<?") ||
                value.includes("&lt;?"));
        }, "Vui lòng nhập đúng định dạng chữ");


    }


}