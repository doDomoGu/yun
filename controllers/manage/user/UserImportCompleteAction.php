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

use app\components\MyMail;

class UserImportCompleteAction extends Action{
    public $sendMail = false;
    public function run(){
        if(!empty($_POST)){
            $post = true;
            $wrong = '';
            $list = [];
            if(!empty($_POST['data'])){
                $data = $_POST['data'];
                //$values = implode(',',$data);
                //var_dump($data);exit;

                foreach($data as $d){
                    $val = json_decode($d,true);
                    $user = new User();
                    $user->username = $val[0];
                    $user->name = $val[1];
                    $user->position_id = $val[2];
                    $user->gender = $val[3];
                    $user->birthday = $val[4];
                    $user->mobile = $val[5];
                    $user->phone = $val[6];
                    $user->join_date = $val[7];
                    $user->contract_date = $val[8];
                    $password = CommonFunc::generateCode();
                    $user->password = md5($password);
                    $user->password_true = $password;
                    $user->ord = 1;
                    $user->status = 1;
                    if($user->save()){
                        if($this->sendMail){
                            $mail = new MyMail();
                            $mail->to = $user->username;
                            $mail->subject = '【颂唐云】新职员注册成功';
                            $mail->htmlBody = '职员['.$user->name.'],您好：<br/>颂唐云网址为：http://yun.songtang.net 您的登录用户名为 '.$user->username.' 密码为 '.$password;
                            $mail->send();
                        }
                        $list[] = $user;
                    }
                }
                /*exit;
                Yii::$app->db->createCommand()->batchInsert(
                    'user',
                    [
                        'username',
                        'name',
                        'position_id',
                        'gender',
                        'birthday',
                        'mobile',
                        'phone',
                        'join_date',
                        'contract_date',
                    ],
                    $value
                )->execute();

                Yii::$app->db->createCommand(
                    "insert into `user` (username,name,position_id,gender,birthday,mobile,phone,join_date,contract_date,password) values ".$values)->execute();*/
            }else{

            }
            $params['list'] = $list;
            $params['post'] = $post;
            $params['wrong'] = $wrong;
            return $this->controller->render('user/import_complete',$params);
        }else{
            echo 'wrong';exit;
        }
    }
}