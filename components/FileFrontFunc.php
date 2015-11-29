<?php
namespace app\components;

use app\models\DownloadRecord;
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
        $fileTypes = self::file_type(true);
        $ext = substr(strrchr($filename,'.'),1);
        if($ext!==false && isset($fileTypes[$ext])){
            return $fileTypes[$ext];
        }else{
            return 99;
        }
    }

    public static function getFileExt($fileType){
        $fileTypes = self::file_type();
        $fileType = intval($fileType);
        if(isset($fileTypes[$fileType])){
            return $fileTypes[$fileType];
        }else{
            return 'unknown';
        }
    }

    public static function getFilePath($path,$beaut=false){
        if($beaut)
            return yii::$app->params['qiniu-domain-beaut'].$path;
        else
            return yii::$app->params['qiniu-domain'].$path;
    }

    public static function getFilesByDirId($dir_id){
        return File::find()->where(['dir_id'=>$dir_id,'status'=>1])->orderBy('add_time desc')->all();
    }

    public static function insertDownloadRecord($file,$uid){
        $downloadRecord = new DownloadRecord();
        $downloadRecord->file_id = $file->id;
        $downloadRecord->uid = $uid;
        $downloadRecord->save();

        $file->clicks+=1;
        $file->save();
    }

}