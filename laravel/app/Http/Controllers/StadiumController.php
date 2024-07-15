<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stadium;
use Carbon\Carbon;

class StadiumController extends Controller
{
    public function stadium()
    {
        return view('stadium');
    }
    public function getStadiumDates(Request $request)
    {
        $stadiumName = $request->query('name');
        $dates = Stadium::where('name', $stadiumName)->pluck('availability')->toArray();

        return response()->json(['dates' => $dates]);
    }


    public function stadiumAdd(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|exists:stadiums,name',
            'address' => 'required',
            'availability' => 'required|date|after:today',
            'phone_number' => 'required',
            'price' => 'required|integer'
        ]);


        // Récupérer le nom du stade et la date de disponibilité
        $stadiumName = $request->input('name');
        $availabilityDate = $request->input('availability');

        // Vérifier si la date est déjà utilisée pour ce stade
        $existingStadium = Stadium::where('name', $stadiumName)
            ->whereDate('availability', $availabilityDate)
            ->first();

        if ($existingStadium) {
            return back()->withErrors(['availability' => 'La date est déjà prise pour ce stade.']);
        }


        Stadium::create($validatedData);

        return redirect('/stadiumdisplay')->with('success', 'Stadium added successfully!');
    }
    public function stadiumdisplay(Request $request)
    {
        $stadiums = Stadium::all();
        return view('stadiumdisplay', ['stadiums' => $stadiums]);
    }
    public function stadiumDelete(Stadium $stadium)
    {
            $stadium->delete();
            return redirect('/stadiumdisplay')->with('success', 'Stadium deleted successfully!');

    }
    public function stadiumUpdate(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|exists:stadiums,name',
            'address' => 'required',
            'availability' => 'required|date|after:today',
            'phone_number' => 'required',
            'price' => 'required|integer'
        ]);

        $stadiumName = $request->input('name');
        $availabilityDate = $request->input('availability');

        $stadium = Stadium::where('name', $stadiumName)
            ->where('availability', $availabilityDate)
            ->first();

        if ($stadium) {
            $stadium->update($validatedData);
            return redirect('/stadiumdisplay')->with('success', 'Stadium updated successfully!');
        }

        return back()->withErrors(['availability' => 'Stadium not found.']);
    }

}
