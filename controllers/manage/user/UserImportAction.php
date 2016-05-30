<?php
namespace app\controllers\manage\user;

use app\components\PositionFunc;
use app\components\CommonFunc;
use app\models\Position;
use yii\base\Action;
use app\models\User;
use yii\data\Pagination;
use yii\helpers\ArrayHelper;
use Yii;

class UserImportAction extends Action{
    public function run(){
        $this->controller->view->title = '职员列表 - 批量导入';
        if(!empty($_POST)){
            $wrong = '';
            $list = [];
            $file = $_FILES['file'];
            if (empty ($file['tmp_name']) || substr($file['name'],-3)!='csv') {
                $wrong = '请选择正确的CSV文件！';
            }else{
                $handle = fopen($file['tmp_name'], 'r');
                $data = [];
                $usernameList = [];
                $wrongNum = 0;
                $result = CommonFunc::input_csv($handle); //解析csv
                $len_result = count($result);
                if($len_result>0){
                    //用户名(邮箱)、姓名、职位、性别、生日、手机、座机、入职日期、合同到期日期
                    for ($i = 1; $i < $len_result; $i++) { //循环获取各字段值
                        foreach($result[$i] as $j => $v){
                            //$result[$i][$j] = iconv(mb_detect_encoding($v, mb_detect_order(), true), 'utf-8', $v);
                            $result[$i][$j] = iconv('gbk', 'utf-8', $v);
                        }

                        $usernameWrong = false;
                        $username = $result[$i][0];
                        //检查用户名（邮箱）
                        if($username==''){
                            $usernameWrong = 1; //不能为空
                        }elseif(!preg_match( "/^([0-9A-Za-z\\-_\\.]+)@([0-9a-z]+\\.[a-z]{2,3}(\\.[a-z]{2})?)$/i", $username )){
                            $usernameWrong = 2; //邮箱格式错误
                        }elseif(in_array($username,$usernameList)){
                            $usernameWrong = 3; //用户名重复（当前导入文件）
                        }else{
                            $userExist = User::find()->where(['username'=>$username])->one();
                            if($userExist){  //用户名已存在
                                $usernameWrong = 4;
                            }else{
                                $usernameList[] = $username;
                            }
                        }
                        $nameWrong = false;
                        //$name = iconv('gb2312', 'utf-8', $result[$i][1]); //中文转码
                        $name = $result[$i][1]; //中文转码
                        if($name==''){
                            $nameWrong = 1; //不能为空
                        }

                        $positionWrong = false;
                        $position_id = $result[$i][2];
                        $positionName = $result[$i][3];
                        if($position_id!=''){
                            $posExist = Position::find()->where(['id'=>$position_id,'is_leaf'=>1])->one();
                            if(!$posExist){  //职位不存在
                                $positionWrong = 2;
                            }
                        }elseif($positionName!=''){
                            $positionNameTmp = explode('-',$positionName);
                            $p_id=0;
                            for($ii=0;$ii<count($positionNameTmp);$ii++){
                                $posTmp = Position::find()->where(['p_id'=>$p_id,'name'=>$positionNameTmp[$ii]])->one();
                                if($posTmp){
                                    $p_id = $posTmp->id;
                                }else{
                                    $positionWrong = 3;
                                }
                            }
                            if($positionWrong != 3){
                                $position_id = $p_id;
                            }
                        }else{
                            $positionWrong = 1; //不能为空
                        }


                        //$gender = CommonFunc::getGender2(iconv('gb2312', 'utf-8', $result[$i][3]));
                        $gender = CommonFunc::getGender2($result[$i][5]);
                        $birthday = strtotime($result[$i][6])>0?date('Y-m-d',strtotime($result[$i][6])):'';
                        $mobile = $result[$i][7];
                        $phone = $result[$i][8];
                        $join_date = strtotime($result[$i][9])>0?date('Y-m-d',strtotime($result[$i][9])):'';
                        $contract_date = strtotime($result[$i][10])>0?date('Y-m-d',strtotime($result[$i][10])):'';
                        //$data_values .= "('$name','$sex','$age'),";
                        $list[] = [
                            'username' => $username,
                            'usernameWrong' => $usernameWrong,
                            'name' => $name,
                            'nameWrong' => $nameWrong,
                            'position_id' => $position_id,
                            'positionWrong' => $positionWrong,
                            'positionName' => $positionName,
                            'gender' => $gender,
                            'birthday' => $birthday,
                            'mobile' => $mobile,
                            'phone' => $phone,
                            'join_date' => $join_date,
                            'contract_date' => $contract_date,
                            //'data22' => "('$username','$name','$position_id','$gender','$birthday','$mobile','$phone','$join_date','$contract_date','".(md5(CommonFunc::generateCode()))."')",
                            'data' => json_encode([$username,$name,$position_id,$gender,$birthday,$mobile,$phone,$join_date,$contract_date])
                        ];

                        if($usernameWrong!=false || $nameWrong!=false  ||$positionWrong!=false){
                            $wrongNum++;
                        }else{

                        }
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
                $params['wrongNum'] = $wrongNum;
            }

            $params['list'] = $list;
            $params['post'] = true;
            $params['wrong'] = $wrong;

        }else{
            $params['post'] = false;
        }



        return $this->controller->render('user/import',$params);
    }
}