<?php
if (class_exists('mysqli')) {
    echo json_encode(["status" => "ok", "message" => "mysqli aktif"]);
} else {
    echo json_encode(["status" => "error", "message" => "mysqli belum aktif"]);
}
