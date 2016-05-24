<?php
namespace app\controllers\manage\user;

use app\components\PositionFunc;
use app\components\CommonFunc;
use yii\base\Action;
use app\models\User;
use yii\data\Pagination;
use yii\helpers\ArrayHelper;
use Yii;

class UserImportAction extends Action{
    public function run(){
        $this->controller->view->title = '职员列表 - 批量导入';
        if(!empty($_POST)){
            $filename = $_FILES['file']['tmp_name'];
            if (empty ($filename)) {
                echo '请选择要导入的CSV文件！';
                exit;
            }
            $handle = fopen($filename, 'r');
            $list = [];
            $data_values = '';
            $result = CommonFunc::input_csv($handle); //解析csv
            $len_result = count($result);
            if($len_result>0){
                //用户名(邮箱)、姓名、职位、性别、生日、手机、座机、入职日期、合同到期日期
                for ($i = 1; $i < $len_result; $i++) { //循环获取各字段值
                    $username = $result[$i][0];
                    $name = iconv('gb2312', 'utf-8', $result[$i][1]); //中文转码
                    $position_id = $result[$i][2];
                    $gender = CommonFunc::getGender2(iconv('gb2312', 'utf-8', $result[$i][3]));
                    //$data_values .= "('$name','$sex','$age'),";
                    $list[] = [
                        'username' => $username,
                        'name' => $name,
                        'position_id' => $position_id,
                        'gender' => $gender
                    ];
                }
            //$data_values = substr($data_values,0,-1); //去掉最后一个逗号
            fclose($handle); //关闭指针
            /*var_dump($list);exit;
            var_dump($data_values);exit;*/
            /*$query = mysql_query("insert into student (name,sex,age) values $data_values");//批量插入数据表中
            if($query){
                echo '导入成功！';
            }else{
                echo '导入失败！';
            }*/
            }
            $params['list'] = $list;
            $params['post'] = true;
        }else{
            $params['post'] = false;
        }



        return $this->controller->render('user/import',$params);
    }
}