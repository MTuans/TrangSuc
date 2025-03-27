<?php

namespace App\Controllers;

use App\Models\Product;
use Framework\Viewer;

class Home
{
  public function index()
  {
    $model = new Product();
    $data['productNew'] = $model->getNewProducts();
    $viewer = new Viewer();
    echo $viewer->render("page-home.php",$data);
  }
  public function about()
  {
    $viewer = new Viewer();
    echo $viewer->render("page-about.php");
  }
  public function contact()
  {
    $viewer = new Viewer();
    echo $viewer->render("page-contact.php");
  }
}
