<?php
namespace Modules\General\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App;
use Lang;
use Modules\General\Models\Language;

class LocaleFileController extends Controller
{

    //------------------------------------------------------------------------------
    // Add or modify lang files content
    //------------------------------------------------------------------------------

    public function changeLang(Request $request)
    {
        $langs = Language::active()->get();
        $file = 'lang';
        $modules = ['general','main'];
        $module = $request->module ? $request->module : '';
        // dd($module) ;
        foreach($langs as $lang){
            $arrayLang[$lang->locale] = $this->read($lang->locale,$file,$module);
        }
        request()->flash();
        // dd($arrayLang) ;
        return view('general::admin.settings.change_lang', compact('arrayLang','module'));

     }
     public function saveChangeLang(Request $request)
     {
        $langs = Language::active()->get();
        $module = $request->module ;
        foreach($langs as $lang){
            // dd($request->get($lang->locale));
            $arrayLang = $request->get($lang->locale) ;
            $lang = $lang->locale ;

            switch ($module) {
                case "general":
                    $path =  base_path().'/Modules/General/Resources/lang/'.$lang.'/lang.php' ;
                    break;
                case "main":
                    $path =  base_path().'/Modules/Main/Resources/lang/'.$lang.'/lang.php' ;
                    break;
                default:
                    $path = base_path().'/resources/lang/'.$lang.'/lang.php' ;
              }

            $this->save($arrayLang,$path);
        }

        return back()->with('status', __('general::lang.saveChanged'));
        // dd($request) ;

    }

    //------------------------------------------------------------------------------
    // Add or modify lang files content
    //------------------------------------------------------------------------------

    private function changeLangFileContent($lang,$path,$file,$key,$value)
    {
        $arrayLang = $this->read($lang,$path,$file);
        // dd($this->arrayLang);
        $arrayLang[$key] = $value;
        $this->save($arrayLang,$path);
    }

    //------------------------------------------------------------------------------
    // Delete from lang files
    //------------------------------------------------------------------------------

    private function deleteLangFileContent($lang,$path,$file,$key)
    {
        $arrayLang = $this->read($lang,$path,$file);
        unset($arrayLang[$key]);
        $this->save($arrayLang,$path);
    }

    //------------------------------------------------------------------------------
    // Read lang file content
    //------------------------------------------------------------------------------

    private function read($lang,$file,$module = '')
    {
        if ($lang == '') $lang = App::getLocale();
        // $this->path = base_path().'/resources/lang/'.$lang.'/lang.php';
        // dd($lang) ;
        if($module){
            $arrayLang = Lang::get($module.'::'.$file,[],$lang);
        }else{
            $arrayLang = Lang::get($file,[],$lang);
        }
        return $arrayLang ;
    }

    //------------------------------------------------------------------------------
    // Save lang file content
    //------------------------------------------------------------------------------

    private function save($arrayLang,$path)
    {
        $content = "<?php\n\nreturn\n[\n";
        foreach ($arrayLang as $key => $value)
        {

            if(strpos($value, "'") !== false){
                $value =  str_replace("'","\'",$value);
                // dd($value) ;
            }
            $content .= "\t".$key." => '".$value."',\n";
        }
        $content .= "];";
        file_put_contents($path, $content);
    }
}
