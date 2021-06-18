<?php

namespace App\Http\Controllers;

use App\Models\VendorItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VendorItemController extends Controller
{
    
    
  public function store(){
    // store Items.
    $vend_i = new VendorItem();
    $vend_i->name = request('name');
    $vend_i->name = request('description');
    $vend_i->name = request('units');
    $vend_i->name = request('price');
    
    $vend_i->save();

  }
  public function index(){
      //get all items
      $vend_i = VendorItem::get();
  }
}
