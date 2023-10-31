<?php

namespace mhgolij\base\http\Controller\Admin;

class Dashboard extends \App\Http\Controllers\Controller
{
    public function dashboard()
    {
        return view('mhgolijBase::admin.dashboard');
    }
}
