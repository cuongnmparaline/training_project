<?php
require_once('models/UserModel.php');
require_once('components/ValidationComponent.php');
require_once('components/ValidationComponent.php');
class BaseController
{
    protected $folder;

    function render($file, $data = array())
    {

        $view_file = 'views/' . $this->folder . '/' . $file . '.php';
        if (is_file($view_file)) {

            extract($data);
            // Sau đó lưu giá trị trả về khi chạy file view template với các dữ liệu đó vào 1 biến chứ chưa hiển thị luôn ra trình duyệt
            ob_start();
            require_once($view_file);
            $content = ob_get_clean();
            // Sau khi có kết quả đã được lưu vào biến $content, gọi ra template chung của hệ thống đế hiển thị ra cho người dùng
            require_once('views/layouts/application.php');
        } else {
            // Nếu file muốn gọi ra không tồn tại thì chuyển hướng đến trang báo lỗi.
            header('Location: search.php?controller=pages&action=error');
        }
    }
}