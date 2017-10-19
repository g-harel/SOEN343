<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use App\Gateway\DesktopGateway;

Function console_log($str) {
    echo "<script>console.log('".addslashes(json_encode($str))."')</script>\n";
}

class ItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $t = new DesktopGateway();

        $I = array(
            "id" => 0,
            "category" => "monitor",
            "brand" => "brand",
            "price" => 10.0,
            "quantity" => 10,
            "processor_type" => "ptype",
            "display_size" => 10,
            "ram_size" => 10,
            "cpu_cores" => 10,
            "weight" => 10,
            "width" => 10,
            "height" => 10,
            "thickness" => 10,
            "battery" => "battery",
            "os" => "os",
            "type" => "type",
            "camera" => "camera",
            "touchscreen" => true,
        );

        console_log($t->getAll());
        console_log($t->getById(1));
        console_log($t->insert($I));
        console_log($t->update($I));

        $items = Item::all();
        return view('items.index')->with('items', $items);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('items.create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'brand' => 'required',
            'price' => 'required',
            'type' => 'required'
        ]);
        //Create Item
        $item = new Item;
        $item->brand = $request->input('brand');
        $item->price = $request->input('price');
        $item->type = $request->input('type');
        $item->save();
        return redirect('/items')->with('success', 'Item Created');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = Item::find($id);
        return view('items.show')->with('item', $item);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}