<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use mysqli;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    public function showItems(){
        $mysqli = new mysqli("localhost", "root", "", "soen343");

              /* check connection */
        if ($mysqli->connect_errno) {
            printf("Connect failed: %s\n", $mysqli->connect_error);
            exit();
        }

        $query = "SELECT * FROM `items` WHERE 1";
        $data = array();
        if ($result = $mysqli->query($query)) {

            /* fetch associative array */
            $i = 0;
            while ($row = $result->fetch_assoc()) {
                //var_dump($row);
                    $data[$i]['id'] = $row['id'];
                    $data[$i]['brand'] = $row['brand'];
                    $data[$i]['price'] = $row['price'];
                    $data[$i]['type'] = $row['type'];
                    $data[$i]['created_at'] = $row['created_at'];
                    $i++;

            }

        }

        /* close connection */
        $mysqli->close();

        return view('pages.view')->with('data', $data);

    }
}
