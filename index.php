<?php

ob_start();
session_start();
include_once "./views/layout-header.php";
spl_autoload_register(function ($className) {
  require "src/$className.php";
});

use Framework\Router;

$router = new Router();
$router->add("/", ["controller" => "home", "action" => "index"]);
// $router->add("/home/index", ["controller" => "home", "action" => "index"]);
$router->add("/trang-suc", ["controller" => "products", "action" => "index"]);
$router->add("/trang-suc/tim-kiem", ["controller" => "products", "action" => "search"]);
$router->add("/trang-suc/danh-muc/{id:\d+}", ["controller" => "products", "action" => "index"]);
$router->add("/trang-suc/chi-tiet/{id:\d+}", ["controller" => "products", "action" => "detail"]);
$router->add("/gioi-thieu", ["controller" => "home", "action" => "about"]);
$router->add("/lien-he", ["controller" => "home", "action" => "contact"]);
$router->add("/gio-hang", ["controller" => "carts", "action" => "index"]);
$router->add("/gio-hang/check-out", ["controller" => "carts", "action" => "checkout"]);
$router->add("/gio-hang/add/{id:\d+}", ["controller" => "carts", "action" => "addToCart"]);
$router->add("/gio-hang/xoa/{id:\d+}", ["controller" => "carts", "action" => "removeFromCart"]);

$router->add("/don-hang", ["controller" => "orders", "action" => "index"]);
$router->add("/don-hang/chi-tiet/{id:\d+}", ["controller" => "orders", "action" => "detail"]);
$router->add("/don-hang/huy/{id:\d+}", ["controller" => "orders", "action" => "cancel"]);

$router->add("/dang-nhap", ["controller" => "users", "action" => "login"]);
$router->add("/dang-ky", ["controller" => "users", "action" => "register"]);
$router->add("/dang-xuat", ["controller" => "users", "action" => "logout"]);
$router->add("/admin", ["controller" => "admins", "action" => "index"]);

$router->add("/admin-pro", ["controller" => "products", "action" => "adminPro"]);
$router->add("/admin-add-pro", ["controller" => "products", "action" => "adminAddPro"]);
$router->add("/admin-edit-pro/{id:\d+}", ["controller" => "products", "action" => "adminEditPro"]);
$router->add("/admin-delete-pro/{id:\d+}", ["controller" => "products", "action" => "deleteP"]);

$router->add("/admin-cate", ["controller" => "categorys", "action" => "adminCate"]);
$router->add("/admin-add-cate", ["controller" => "categorys", "action" => "adminAddCate"]);
$router->add("/admin-edit-cate/{id:\d+}", ["controller" => "categorys", "action" => "adminEditCate"]);
$router->add("/admin-delete-cate/{id:\d+}", ["controller" => "categorys", "action" => "deleteC"]);

$router->add("/admin-user", ["controller" => "admins", "action" => "adminUser"]);
$router->add("/admin-add-user", ["controller" => "admins", "action" => "addUser"]);
$router->add("/admin-edit-user/{id:\d+}", ["controller" => "admins", "action" => "editAdminUser"]);
$router->add("/admin-delete-user/{id:\d+}", ["controller" => "admins", "action" => "deleteU"]);

$router->add("/admin-order", ["controller" => "admins", "action" => "adminOrders"]);
$router->add("/admin-order-update/{id:\d+}", ["controller" => "admins", "action" => "updateOrderStatus"]);
$router->add("/admin-order-detail/{id:\d+}", ["controller" => "admins", "action" => "adminOrderDetail"]);
$router->add("/admin-order-confirm/{id:\d+}", ["controller" => "admins", "action" => "confirmOrder"]);
$router->add("/admin-order-cancel/{id:\d+}", ["controller" => "admins", "action" => "cancelOrder"]);

$path = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
$params = $router->match($path);
$action = $params["action"];
$controller = ucfirst($params["controller"]);
unset($params['controller'], $params["action"]);

$controller_object = new ("App\Controllers\\" . $controller)();
$controller_object->$action(...$params);
include_once "./views/layout-footer.php";
