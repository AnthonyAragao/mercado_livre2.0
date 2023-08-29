<?php
namespace App\Helpers;

class Helper{

    public static function armazenarArquivo($arquivo,$endereco)
    {
        if (empty($arquivo)){
            return null;
        }

        $extension = $arquivo->extension();
        $fileName =
            md5(
                $arquivo->getClientOriginalName() . strtotime("now")
            ) .
            "." .
            $extension;
            $arquivo->move(public_path($endereco), $fileName);

        return $fileName;
    }
}
