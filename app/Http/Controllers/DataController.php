<?php

namespace App\Http\Controllers;

use App\Models\Data;

class DataController extends Controller
{

    public function getInstanceSummary()
    {

        return Data::InstanceSummary();
        //return Data::select($response);

    }

    public function getPaginatedInstanceList()
    {

        return Data::PaginatedInstanceList();
        //return Data::select($response);

    }
}
