<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CipherEnkripsi;

class CipherController extends Controller
{
    //
    public $enkripsi_key, $dekripsi_key;
    public $plainteks, $cipherteks;
    public $result;

    public function index()
    {
        return view('docs', $this->plainteks);
    }

    public function enkripsi(Request $request)
    {
        $this->validate($request, [
            'plainteks'     => 'required|mimes:txt',
            'enkripsi_key'   => 'required|min:1'
        ]);

        $text = $request->file('plainteks');
        $text->storeAs('public/plainteks', $text->hashName());
        $this->plainteks = file_get_contents($text);
        $this->enkripsi_key = $request->enkripsi_key;

        // dd($plainteks, $enkripsi_key);
        $result = $this->ciphertext($this->plainteks, $this->enkripsi_key);
        $result['plainteks'] = $this->plainteks;
        $store = CipherEnkripsi::create([
            'plainteks' => $this->plainteks,
            'enkripsi_key' => $this->enkripsi_key,
            'cipherteks' => $result['result'],
            'dekripsi_key' => $result['key']
        ]);

        return back()->with($result);
    }

    public function ciphertext($string, $kunci)
    {
        $string;
        $kunci;
        $array_result = [];
        $string = str_replace(' ', '', $string);

        // tambah karakter x
        $mod = strlen($string) % $kunci;
        if ($mod != 0) {
            for ($k = 0; $k < ($kunci - $mod); $k++) {
                $string = $string . "x";
            }
        }

        // matriks
        $array = str_split($string, $kunci);
        $array_result["key"] = count($array);
        $data = array();
        for ($i = 0; $i < count($array); $i++) {
            $data[] = str_split($array[$i], 1);
        }

        // print
        $result = "";
        for ($j = 0; $j < $kunci; $j++) {
            for ($i = 0; $i < count($data); $i++) {
                $result = $result . $data[$i][$j];
            }
            // $result = $result . " ";
        }

        $array_result["result"] = $result;
        // result
        return $array_result;
    }

    public function dekripsi(Request $request)
    {
        $this->validate($request, [
            'cipherteks'     => 'required|mimes:txt',
            'dekripsi_key'   => 'required|min:1'
        ]);
        $text = $request->file('cipherteks');
        $text->storeAs('public/cipherteks', $text->hashName());
        $this->cipherteks = file_get_contents($text);
        $this->dekripsi_key = $request->dekripsi_key;
        $cek = CipherEnkripsi::select('plainteks')->where('cipherteks',$this->cipherteks)->where('dekripsi_key',$this->dekripsi_key)->count();
        if(!$cek)
        {
            $dekrip = $this->ciphertext($this->cipherteks,$this->dekripsi_key);
            $result['hasil_dekripsi'] = $dekrip['result'];
            $result['ciphertext'] = $this->cipherteks;

        } else 
        {
            $result['hasil_dekripsi'] = CipherEnkripsi::select('plainteks')
                                    ->where('cipherteks',$this->cipherteks)
                                    ->where('dekripsi_key',$this->dekripsi_key)
                                    ->first()->plainteks;
            $result['ciphertext'] = $this->cipherteks;
        }
        // dd($result);
        return back()->with($result);
    }
}
