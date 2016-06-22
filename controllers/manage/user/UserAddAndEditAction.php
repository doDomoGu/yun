<?php
namespace app\controllers\manage\user;

use app\components\CommonFunc;
use app\components\MyMail;
use Yii;
use yii\base\Action;
use app\models\UserForm;
use app\models\User;

class UserAddAndEditAction extends Action{
    public $sendMail = true;
    public function run(){
        $model = new UserForm();
        $user = null;
        $updatePassword = true;
        $passwordTmp = null;
        $id = Yii::$app->request->get('id');
        if($id!=''){
            $user = User::find()->where(['id'=>$id])->one();
            if($user){
                $this->controller->view->title = '职员 - 编辑';
                $model->setScenario('update');
                $model->setAttributes($user->attributes);
                $model->password = '';
                //$user->setScenario('update');
            }else{
                Yii::$app->response->redirect('user')->send();
            }
        }else{
            $this->controller->view->title = '职员 - 添加';
            $model->setScenario('create');
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if($user == null){
                $user = new User();
                //$user->setScenario('create');
            }
            if($model->getScenario()=='update'){
                if($model->password=='' || $model->password2==''){
                    $model->password = $user->password;
                    $updatePassword = false;
                }
            }elseif($model->getScenario()=='create'){
                $model->password = CommonFunc::generateCode(); //新增职员 自动创建随机密码
            }

            $user->setAttributes($model->attributes);

            if($updatePassword===true){
                $passwordTmp = $user->password;
                $user->password_true = $user->password;
                $user->password = md5($user->password);

            }

            if($user->save()){
                if($this->sendMail){
                    //发送邮件
                    if($model->getScenario()=='create'){
                        $mail = new MyMail();
                        $mail->to = $user->username;
                        $mail->subject = '【颂唐云】新职员注册成功';
                        $mail->htmlBody = '职员['.$user->name.'],您好：<br/>颂唐云网址为：http://yun.songtang.net 您的登录用户名为 '.$user->username.' 密码为 '.$passwordTmp;
                        $mail->send();
                    }elseif($model->getScenario()=='update'){
                        $mail = new MyMail();
                        $mail->to = $user->username;
                        if($updatePassword==true){
                            $mail->subject = '【颂唐云】职员信息变更(包括密码)';
                        }else{
                            $mail->subject = '【颂唐云】职员信息变更';
                        }
                        $mail->htmlBody = '职员['.$user->name.'],您好：<br/> 您的职员信息发生了更改。';
                        if($updatePassword==true){
                            $mail->htmlBody.=' <br/>您的登录密码变为 '.$passwordTmp;
                        }
                        $mail->send();
                    }
                }
                Yii::$app->response->redirect('user')->send();
            }
        }

        $params['model'] = $model;
        return $this->controller->render('user/add_and_edit',$params);
    }
}