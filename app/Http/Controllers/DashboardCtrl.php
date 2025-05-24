<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DashboardCtrl extends Controller
{
    public function page()
    {
        return collect([
            "name" => "Dashboard",
            "icon" => "bi bi-home",
        ]);
    }

    public function index() 
    {
        $name = $this->page()["name"];
        $slug = Str::slug($this->page()["name"]);
        $icon = $this->page()["icon"];
        $title  = "Dashboard";
        $pageTitle  = "Hallo, ".Auth()->user()->nama;
        $pageSubTitle  = "Selamat menikmati hari";

        return view("$slug.index", [
            "name" => $name,
            "slug" => $slug,
            "icon" => $icon,
            "title" => $title,
            "pageTitle" => $pageTitle,
            "pageSubTitle" => $pageSubTitle,
        ]);
    }
}
