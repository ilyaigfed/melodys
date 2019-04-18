<?php


namespace App\Helpers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class FileSaver
{
    public static function save(Model $model, string $field, UploadedFile $file, string $folder = 'common', string $disk = 'public'):string
    {
        $name = strtolower(str_random(16));
        $firsrtLetter = substr($name, 0, 1);
        $_folder = $folder.'/'.$firsrtLetter;
        $filename = $name.'.'.$file->getClientOriginalExtension();
        $file->storeAs($_folder, $filename, $disk);

        if(!is_null($model->$field))
            Storage::disk($disk)->delete($model->$field);

        return $_folder.'/'.$filename;
    }
}