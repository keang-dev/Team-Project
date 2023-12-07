<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;

use DataTables;

class LanguageController extends Controller
{
    public function switchLang($lang)
    {
        App::setlocale($lang);
        session()->put('locale', $lang);
        return redirect()->back();
    }

    public function createGreeting(){
        return view('languages.create');
    }

    public function greetingEn(Request $request){
        if($request->ajax()){
            try{
                $strkey = $request->key;
                $value = $request->text;
    
                $textStartWith = strtolower(trim($strkey[0])); //get the first letter of the string
                $filename = 'en_'.$textStartWith.'.php'; 
                $file_path = resource_path('../lang/en/alphabet/'.$filename); 
                // check if file exist 
                if(!file_exists($file_path)){
                    return response()->json(
                        [
                            'data' => '',
                            'status' =>  404,
                            'sms' => 'File not exist!',
                        ]
                    );
                }
    
                include_once($file_path);
                $greetingVariable = 'en_'.$textStartWith;  // array variable name
                $oldGreetingArr = $$greetingVariable;  // store temporary array

                if(isset($oldGreetingArr[$strkey])){
                    return response()->json(
                        [
                            'data' => '',
                            'status' =>  502,
                            'sms' => 'Greeting key already exist',
                        ]
                    );
                }
    
                $newGreetingText = "'$strkey' => '$value',\n\t'GREETINGTEXT'"; // prepare new greeting words
                $oldGreetingStr = file_get_contents($file_path);
    
                $content = str_replace(["'GREETINGTEXT'"], [$newGreetingText], $oldGreetingStr); // add new greeting work to file
    
                $fopen = fopen($file_path, 'w+'); //open file;
                fwrite($fopen, $content); // write file
                fclose($fopen); // save and close file
    
                return response()->json(
                    [
                        'data' => '',
                        'status' =>  200,
                        'sms' => 'success',
                    ]
                );
            }catch(\Exception $ex){
                return $ex;
            }
            
        }
    }

    public function greetingKh(Request $request){
        try{
            if($request->ajax()){
                $tran_en_texts = trans("t", [], "en");
                $tran_kh_texts = trans("t", [], "kh");

                $new_conllection = collect([]);
                foreach($tran_en_texts as $key => $value){
                    if($value == 'GREETINGTEXT'){
                        continue;
                    }

                    $new_conllection->push([
                        'key' => $key,
                        'en_word' => $tran_en_texts[$key],
                        'value' => $tran_kh_texts[$key] ?? ''
                    ]);
                }

                return DataTables::of($new_conllection)->make(true);

            }

            return view('languages.kh');
        }catch(Exception $e){
            return $e->getMessage();
        }
    }

    public function greetingkhSave(Request $request){
        if($request->ajax()){
            try{
                $strkey = $request->key;
                $value = $request->value;
    
                $textStartWith = strtolower(trim($strkey[0])); //get the first letter of the string
                $filename = 'kh_'.$textStartWith.'.php'; 
                $file_path = resource_path('../lang/kh/alphabet/'.$filename); 
                // check if file exist 
                if(!file_exists($file_path)){
                    return response()->json(
                        [
                            'data' => '',
                            'status' =>  404,
                            'sms' => 'File not exist!',
                        ]
                    );
                }
    
                include_once($file_path);
                
                $greetingVariable = 'kh_'.$textStartWith;  // array variable name
                $oldGreetingArr = $$greetingVariable;  // store temporary array

                if(isset($oldGreetingArr[$strkey])){
                    $old_val  = $oldGreetingArr[$strkey];

                    $old_str  = "'$strkey' => '$old_val";
                    $new_str  = "'$strkey' => '$value";

                    $oldGreetingStr = file_get_contents($file_path);
                    $content = str_replace([$old_str], [$new_str], $oldGreetingStr); // replace exiting value
                }else{
                    $newGreetingText = "'$strkey' => '$value',\n\t'GREETINGTEXT'"; // prepare new greeting words
                    $oldGreetingStr = file_get_contents($file_path);
        
                    $content = str_replace(["'GREETINGTEXT'"], [$newGreetingText], $oldGreetingStr); // add new greeting work to file
                }
    
               
    
                $fopen = fopen($file_path, 'w+'); //open file;
                fwrite($fopen, $content); // write file
                fclose($fopen); // save and close file
    
                return response()->json(
                    [
                        'data' => '',
                        'status' =>  200,
                        'sms' => 'success',
                    ]
                );
            }catch(\Exception $ex){
                return $ex;
            }
            
        }
    }
}
