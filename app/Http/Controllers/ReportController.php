<?php

namespace App\Http\Controllers;

header("Refresh: 60");

class ReportController extends Controller
{
    private $data;

    public function index()
    {
        $dataController = new DataController();
        $this->setData("instancias", $dataController->getInstanceSummary());
        $this->setData("listaInstancias", $dataController->getPaginatedInstanceList());

        return \view("report", [
            "data" => $this->data,
        ]);}

    public function setData($class, $cant)
    {

        if ($class == "instancias") {
            $this->data[$class]["active"] = $cant[0];
            $this->data[$class]["completed"] = $cant[1];
            $this->data[$class]["terminated"] = $cant[2];
            $this->data[$class]["failed"] = $cant[3];
            $this->data[$class]["suspended"] = $cant[4];

            //si la cantidad de failed es mayor a cero mostrar rojo
            if ($cant[3] > 0) {

                $this->data[$class]["color"] = "#DF0101";
                $this->data[$class]["class"] = "show";
            } else {
                $this->data[$class]["color"] = "#0c0c0cd3";
                $this->data[$class]["class"] = "hide";
            }

            //si la cantidad de active es mayor a cinco mostrar rojo
            if ($cant[0] > 5) {

                $this->data[$class]["colorActive"] = "#DF0101";
                $this->data[$class]["class"] = "show";
            } else {
                $this->data[$class]["colorActive"] = "#0c0c0cd3";
                $this->data[$class]["class"] = "hide";
            }
        } else if ($class == "listaInstancias") {

            $this->data[$class]["instanceList"] = $cant;
            $this->data[$class]["color"] = "#DF0101";
            $this->data[$class]["class"] = "show";

        }

        /*
    $this->data[$class]["fecha"] = "";
    $this->data[$class]["hora"]  = "";
    if ($cant > 0) {
    $this->data[$class]["color"] = "#DF0101";
    $this->data[$class]["class"] = "show";
    $this->data[$class]["fecha"] = substr($fecha["fechain"], 0, 10);
    $this->data[$class]["hora"]  = substr($fecha["fechain"], 11, 15);

    } else {
    $this->data[$class]["color"] = "#04B404";
    $this->data[$class]["class"] = "hide";
    }
     */

    }

}
