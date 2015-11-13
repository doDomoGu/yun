<?php
namespace app\components;

use app\models\File;
use yii\base\Component;
use yii\helpers\BaseArrayHelper;
use Yii;

class FileFrontFunc extends Component {
    public static function file_type($reverse=false){
        $arr = array(
            'dir','txt','jpg','jpeg','png','gif','bmp','tif','tiff',
            'doc','ppt','xls','docx','pptx','xlsx','psd','ai','html','htm',
            'mp3','avi','mp4','rmvb','wma','pdf',
        );
        if($reverse){
            $arr = array_flip($arr);
        }
        return $arr;
    }

    public static function getFileType($filename){
        $fileType = self::file_type(true);
        $ext = substr(strrchr($filename,'.'),1);
        if($ext!==false && isset($fileType[$ext])){
            return $fileType[$ext];
        }else{
            return 99;
        }
    }

    /*public static function getFolderType($name){
        $folderType = self::folder_type(true);
        if(isset($folderType[$name])){
            return $folderType[$name];
        }else{
            return 0;
        }
    }*/

}