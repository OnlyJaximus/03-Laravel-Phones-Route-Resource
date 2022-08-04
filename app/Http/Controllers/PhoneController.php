<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\ErrorHandler\Debug;

class PhoneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 1 nacin komunikacije sa bazom
        //get phones
        // ROWSQL
        // $newPhone =  DB::insert("INSERT INTO phones (name, brand, price) VALUES ('Note 11', 'Samsung', 98000), ('T8','Mi',26000)");
        // dd($newPhone);

        //   $all_phones = DB::select("SELECT * FROM phones");
        // dd($all_phones);

        //2 nacin komunikacije sa bazom
        /**/
        $all_phones = DB::table('phones')->get();
        $one_with_id = DB::table('phones')->find(1);
        $phones_just_price = DB::table('phones')->select('price as cena')->get();
        $cene = DB::table('phones')->pluck('price');
        $count = DB::table('phones')->count();
        $max_price = DB::table('phones')->max('price');
        $sum_price = DB::table('phones')->sum('price');
        $avg_price = DB::table('phones')->avg('price');

        $note12 = DB::table('phones')->where('name', 'Note 12')->first();
        $note12_cena = DB::table('phones')->where('name', 'Note 12')->value('price');
        $low_cost_phones = DB::table('phones')->where('price', '<', 70000)->get();
        $low_cost_samsung = DB::table('phones')->where([['price', '<', 70000], ['brand', 'Samsung']])->get();
        $low_cost_apple = DB::table('phones')->where([['price', '>', 70000], ['brand', 'Apple']])->get();
        $lost_cost_or_iPhone = DB::table('phones')->where('price', '<', 73000)->orWhere('brand', 'Apple')->get();
        $apple_and_samsung = DB::table('phones')->whereIn('brand', ['Apple', 'Samsung'])->get();

        $all_names = DB::table('phones')->select('brand')->distinct()->get();
        $desc = DB::table('phones')->orderBy('price', 'desc')->get(); // max -> low



        \Debugbar::info($desc);
        return view("phones.index", ["all_phones" => $desc]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('phones.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "name" => "required",
            "brand" => "required",
            "price" => "required"
        ]);


        // 1 nacin komunikacije sa bazom ROW SQL
        /*
        DB::insert("INSERT INTO phones (name, brand, price) VALUES ('$request->name', '$request->brand', $request->price)");
        return redirect('/phones')->with("create", "Success! The phone was created successfully!");
        */
        // 2 nacin komunikacije sa bazom Query Builder
        DB::table('phones')->insert([
            "name" => $request->name,
            "brand" => $request->brand,
            "price" => $request->price

        ]);
        return redirect('/phones')->with("create", "Success! The phone was created successfully!");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $phone = DB::select("SELECT * FROM phones WHERE id= :id", ["id" => $id])[0];

        return view('phones.edit', ["phone" => $phone]);
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
        $request->validate([
            "name" => "required",
            "brand" => "required",
            "price" => "required"
        ]);

        DB::update(
            "UPDATE phones SET name=:name, brand=:brand, price=:price WHERE id=:id",
            ["name" => $request->name, "brand" => $request->brand, "price" => $request->price, "id" => $id]
        );
        return redirect('/phones')->with("update", "Success! The phone has been successfully updated!");;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::delete("DELETE FROM phones WHERE id = ?", [$id]);
        return redirect('/phones')->with("delete", "Success! The phone has been removed successfully!");;
    }
}
