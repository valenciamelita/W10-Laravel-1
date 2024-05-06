<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class ContactController extends Controller
{
    private function data()
    {
        if (!Cookie::has('contact'))
        {
            return [];
        }

        // Terima as JSON
        $data = Cookie::get('contact');
        $data = \json_decode($data, true);
        return $data;
    }

    public function View()
    {
        return \view('contact');
    }

    public function ActionContact(Request $request)
    {
        $data = $this->data();
        $d = [
            "name" => $request->input('name'),
            "email" => $request->input('email'),
            "phone" => $request->input('phone'),
            "message" => $request->input('message'),
        ];

        $data[] = $d;

        $data = \json_encode($data);
        $c = Cookie::make("contact", $data, 60*24*30);
        return redirect()->route('contact.list')->cookie($c);
        // Cookie::queue($c);

        // dd($request->all());
        // dd(Cookie::get('contact'));
        return 'Success';
    }

    public function ContactList(Request $request)
    {
        // dd($request->cookie('contact'));
        $contacts = $this->data();
        return view('contactList', compact('contacts'));

    }

    public function destroy($index)
    {
        $data = $this->data();

        // Hapus data sesuai dengan indeks
        unset($data[$index]);

        // Simpan kembali data dalam cookie

        $jsonData = json_encode($data);
        $c = Cookie::make("contact", $jsonData, 60*24*30);
        return redirect()->route('contact.list')->with('success', 'Data berhasil dihapus')->withCookie($c);

    }
}
