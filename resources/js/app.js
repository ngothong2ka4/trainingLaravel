    import './bootstrap';
    // Ví dụ khởi tạo trong app.js
    import toastr from 'toastr';

    toastr.options = {
        closeButton: true,
        progressBar: true,
        positionClass: 'toast-top-right',
        preventDuplicates: true,
        timeOut: 5000
    };

    window.toastr = toastr;

