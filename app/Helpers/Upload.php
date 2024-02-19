<?php

namespace App\Helpers;

class Upload
{
    protected $file;
    protected $uploadDirectory;
    protected $allowedExtensions;
    protected $errors = [];

    public function __construct($file, $uploadDirectory, $allowedExtensions = []) {
        $this->file = $file;
        $this->uploadDirectory = $uploadDirectory;
        $this->allowedExtensions = $allowedExtensions;
    }

    public function upload(): bool {
        $filename = $this->file['name'];
        $tmpFilePath = $this->file['tmp_name'];
        $fileType = $this->file['type'];
        $fileSize = $this->file['size'];

        // Kiểm tra phần mở rộng của tệp
        $fileExtension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
        if (!in_array($fileExtension, $this->allowedExtensions)) {
            $this->errors[] = "Định dạng tệp không được phép.";
            return false;
        }

        // Kiểm tra kích thước tệp
        if ($fileSize > 1000000) { // Giả sử giới hạn kích thước là 1MB
            $this->errors[] = "Kích thước tệp quá lớn. Vui lòng tải lên tệp nhỏ hơn.";
            return false;
        }

        // Di chuyển tệp tạm thời vào thư mục upload
        $destinationFilePath = $this->uploadDirectory . '/' . $filename;
        if (!move_uploaded_file($tmpFilePath, $destinationFilePath)) {
            $this->errors[] = "Đã xảy ra lỗi khi tải lên tệp.";
            return false;
        }

        return true;
    }

    public function errors() {
        return $this->errors;
    }
}
