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
            'documents','txt','jpg','jpeg','png','gif','bmp','tif','tiff',
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

    public static function getFiles($dir_id,$p_id,$pages,$order='add_time desc',$search=''){
        $files = File::find();
        if($p_id>0)
            $files = $files->where(['p_id'=>$p_id,'status'=>1]);
        else
            $files = $files->where(['dir_id'=>$dir_id,'status'=>1]);
        if($search!==false)
            $files = $files->andWhere(['like','filename',$search]);
        $files = $files->orderBy($order)
            ->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        return $files;
    }

    public static function getFilesNum($dir_id,$p_id,$search=false){
        $count = File::find();
        if($p_id>0)
            $count = $count->where(['p_id'=>$p_id,'status'=>1]);
        else
            $count = $count->where(['dir_id'=>$dir_id,'status'=>1]);
        if($search!==false)
            $count = $count->andWhere(['like','filename',$search]);
        return $count->count();
    }


    public static function insertDownloadRecord($file,$uid){
        $downloadRecord = new DownloadRecord();
        $downloadRecord->file_id = $file->id;
        $downloadRecord->uid = $uid;
        $downloadRecord->save();

        $file->clicks+=1;
        $file->save();
    }

    public static function sizeFormat($size)
    {
        if($size<1024)
        {
            return $size." B";
        }
        else if($size<(1024*1024))
        {
            $size=round($size/1024,1);
            return $size." KB";
        }
        else if($size<(1024*1024*1024))
        {
            $size=round($size/(1024*1024),1);
            return $size." MB";
        }
        else
        {
            $size=round($size/(1024*1024*1024),1);
            return $size." GB";
        }
    }


    /*
     * 函数getParents ,实现根据 当前p_id 递归获取全部父层级 id
     *
     * @param integer p_id
     * return array
     */
    public static function getParents($p_id){
        $arr = [];
        $curDir = File::find()->where(['id'=>$p_id,'status'=>1])->one();
        if($curDir){
            $arr[] = $curDir;
            $arr2 = self::getParents($curDir->p_id);
            $arr = BaseArrayHelper::merge($arr2,$arr);
        }

        ksort($arr);
        return $arr;
    }


    public static function getDownloadList($dir_ids){
        $files = File::find()
            ->where(['in','dir_id',$dir_ids])
            ->andWhere(['>','filetype',0])
            ->andWhere(['status'=>1])
            ->orderBy('clicks desc')
            ->all();
        return $files;
    }

    public static function getRecentList($dir_ids){
        $files = File::find()
            ->where(['in','dir_id',$dir_ids])
            ->andWhere(['>','filetype',0])
            ->andWhere(['status'=>1])
            ->orderBy('add_time desc')
            ->all();
        return $files;
    }
}