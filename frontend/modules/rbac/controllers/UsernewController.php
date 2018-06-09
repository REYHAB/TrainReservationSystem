<?php

namespace frontend\modules\rbac\controllers;

use Yii;
use frontend\modules\rbac\models\Usernew;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\User;
use frontend\modules\rbac\models\PasswordForm;
use yii\web\UploadedFile;

/**
 * UsernewController implements the CRUD actions for Usernew model.
 */
class UsernewController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Usernew models.
     * @return mixed
     */
    public function actionIndex()
    {
        $model= new Usernew();
        $dataProvider = $model::find()->all();

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Usernew model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    //renders view to the user to update their login details
    public function actionSelfupdate($id){

        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {

              $model->IMAGEPATH= UploadedFile::getInstance($model, 'IMAGEPATH');
             if($model->IMAGEPATH){

                    $time = time();
                    $model->save();
                    $model->IMAGEPATH->saveAs('userimages/' .$time. '.' . $model->IMAGEPATH->extension);
                    $model->IMAGEPATH = 'userimages/' .$time. '.' . $model->IMAGEPATH->extension;

             }

           // $password=$model->password_hash;
            $model->status=10;
            $model->auth_key=Yii::$app->security->generateRandomString();
           // $model->password_hash=Yii::$app->security->generatePasswordHash($password);

            if($model->save(false)){
                 Yii::$app->session->setFlash('success', "You have updated your login credentials Successfully");
            return $this->redirect(['selfupdate','id'=>$id]);
            }
        } else {
            return $this->render('userupdateself', [
                'model' => $model,

            ]);
        }
    }
    
    public function actionChangepassword($id){
          $model = $this->findModel($id);
          $oldhash= $model->password_hash;

        if ($model->load(Yii::$app->request->post())) {
            
            $post=Yii::$app->request->post();
            $userpasswordstring=$model->password_hash;
            $useremail=$model->email;
            $newpasswordhash=Yii::$app->security->generatePasswordHash($model->password_hash);
            
           if($userpasswordstring==$post['confirmpassword']){
           if (Yii::$app->getSecurity()->validatePassword($post['oldpassword'], $oldhash)) {
            $model->password_hash=$newpasswordhash;
            if($model->save(false)){
               // send email with password
                
            Yii::$app
            ->mailer
            ->compose()
            ->setFrom('muriithi.peter@ekenya.co.ke')
            ->setTo($useremail)
            ->setSubject('Account login details')
                ->setTextBody('Plain text content')
           ->setHtmlBody('Hi'.' '.$model->username. ' '. 'Your esb account portal username is'.' '. $model->username.' ' .'and password is'.' '. $userpasswordstring .' '.
                  '</br> '. 'Please do not share your password with anyone')
            ->send();
                
            Yii::$app->session->setFlash('success', "You have Changed your password successfully");
            return $this->redirect(['/site/logout']);
            
                        }
                    }
             else {

            Yii::$app->session->setFlash('error', "Failed. Wrond Old Password. Please Try Again");
            return $this->redirect(['changepassword','id'=>$id]);
             }
        
        
        
        }
        
        
        else{
            
             Yii::$app->session->setFlash('error', "Failed.New password must match confirm passoword");
              return $this->redirect(['changepassword','id'=>$id]);
        }
        
             }else {
            return $this->render('passwordchage', [
                'model' => $model,
               
            ]);
        }
    }
    
    //passwordreset
    
    public function actionResetpassword($id){
        
         $model = $this->findModel($id);
         if($model){
             $passwordstring=Yii::$app->getSecurity()->generateRandomString(6);
             
             $model->password_hash=\Yii::$app->security->generatePasswordHash($passwordstring);
             $model->APPROVED=0;
             if($model->save(FALSE)){
                 //send email to the user with the password string
                 
           Yii::$app
            ->mailer
            ->compose()
            ->setFrom('pmuchemi5@gmail.com')
            ->setTo($model->email)
            ->setSubject('Password reset' )
                ->setTextBody($passwordstring)
           ->setHtmlBody('Your password was reset by the admin.'.' '.'New password is='.' '.$passwordstring.' '.'Your Username is='.$model->username)
            ->send();
                 
           Yii::$app->session->setFlash('success', "Password was reset successfully and sent to the user email");
            return $this->redirect(['index']);
             }
             
             else{
                 
             Yii::$app->session->setFlash('error', "Password reset failed.");
            return $this->redirect(['index']); 
             }
             
         }
         
           else{
                 
             Yii::$app->session->setFlash('error', "Password reset failed.");
            return $this->redirect(['index']); 
             }
        
    }
      
    //renders a view to see user details.
    
    public function actionUserprofile($id){
          $model = $this->findModel($id);
        
         return $this->render('useprofile',[
             'model'=>$model,
         ]);
    }
    
    //approve system users
    
      public function actionUserapprove($id){
          $model = $this->findModel($id);
          $model1= new Usernew();
          $model1= $model1->find()->where(['APPROVED'=>0])->all();
           if ($model->load(Yii::$app->request->post())) {
               $model->APPROVED=1;
               
               $model->APPROVEDBY=  Yii::$app->user->identity->username;
               if($model->save(false)){
                   
             Yii::$app
            ->mailer
            ->compose()
            ->setFrom('muriithi.peter@ekenya.co.ke')
            ->setTo($model->email)
            ->setSubject('Login Approved')
                ->setTextBody('Plain text content')
           ->setHtmlBody('Hi'.' '.$model->username. ' '. 'Your esb admin portal account has been approved. You can now login. '.
                  '</br> '. 'Please do not share your password with anyone')
            ->send();
                     
                   Yii::$app->session->setFlash('success', "User Approved Successfully. Awaiting Activation");
                  return $this->redirect(['approveusers']); 
               }
           }
         return $this->render('_form_2',[
             'model'=>$model,
             'model1'=>$model1,
         ]);
    }
    
    //decline user approval
    //
    public function actionUserapprovedecline($id){
          $model = $this->findModel($id);
          $model1= new Usernew();
          $model1= $model1->find()->where(['APPROVED'=>0])->all();
           if ($model->load(Yii::$app->request->post())) {
               $model->APPROVED=2;
               
               $model->APPROVEDBY=Yii::$app->user->identity->username;
               if($model->save(false)){
                   
             Yii::$app
            ->mailer
            ->compose()
            ->setFrom('muriithi.peter@ekenya.co.ke')
            ->setTo($model->email)
            ->setSubject('Account Approval Denied')
                ->setTextBody('Plain text content')
           ->setHtmlBody('Hi'.' '.$model->username. ' '. 'Your esb admin portal account has been denied approval')
            ->send();
                     
                   Yii::$app->session->setFlash('success', "User Approval Declined Successfully.");
                  return $this->redirect(['approveusers']); 
               }
           }
         return $this->render('_form_3',[
             'model'=>$model,
             'model1'=>$model1,
         ]);
    }
    
    //activate approved users account
    public function actionAccountactivation($id){
          $model = $this->findModel($id);
          $model1= new Usernew();
          $model1= $model1->find()->where(['APPROVED'=>1])->all();
           if ($model->load(Yii::$app->request->post())) {
               $model->ACTIVATED=1;
               
               $model->APPROVEDBY=Yii::$app->user->identity->username;
               if($model->save(false)){
                   
             Yii::$app
            ->mailer
            ->compose()
            ->setFrom('muriithi.peter@ekenya.co.ke')
            ->setTo($model->email)
            ->setSubject('Account Activation')
                ->setTextBody('Plain text content')
           ->setHtmlBody('Hi'.' '.$model->username. ' '. 'Your esb admin portal account has been activated. Pending approval. '.
                  '</br> '. 'Please do not share your password with anyone')
            ->send();
                     
                   Yii::$app->session->setFlash('success', "User Activated Successfully. Awaiting Approval");
                  return $this->redirect(['activateusers']); 
               }
           }
         return $this->render('_form_4',[
             'model'=>$model,
             'model1'=>$model1,
         ]);
    }
    
    //approve activated users account
    public function actionActivationapproval($id){
          $model = $this->findModel($id);
          $model1= new Usernew();
          $model1= $model1->find()->where(['ACTIVATED'=>1])->andWhere(['APPROVEACTIVATATION'=>0])->all();
           if ($model->load(Yii::$app->request->post())) {
               $model->APPROVEACTIVATATION=1;
               
               $model->APPROVEDBY=Yii::$app->user->identity->username;
               if($model->save(false)){
                   
             Yii::$app
            ->mailer
            ->compose()
            ->setFrom('muriithi.peter@ekenya.co.ke')
            ->setTo($model->email)
            ->setSubject('Account Activation Approval')
                ->setTextBody('Plain text content')
           ->setHtmlBody('Hi'.' '.$model->username. ' '. 'Your esb admin portal account has been activated. You can now login. '.
                  '</br> '. 'Please do not share your password with anyone')
            ->send();
                     
                   Yii::$app->session->setFlash('success', "User Account  Activated Successfully.");
                  return $this->redirect(['approveactivatedusers']); 
               }
           }
         return $this->render('_form_5',[
             'model'=>$model,
             'model1'=>$model1,
         ]);
    }
    
    
    //admin lock account
    public function actionLockaccount($id){
        $model= $this->findModel($id);
        $model->LOCKED=1;
        if($model->save(false)){
            
               Yii::$app
            ->mailer
            ->compose()
            ->setFrom('muriithi.peter@ekenya.co.ke')
            ->setTo($model->email)
            ->setSubject('Account Lock')
                ->setTextBody('Plain text content')
           ->setHtmlBody('Hi'.' '.$model->username. ' '. 'Your esb admin portal account has been locked. Please contact admin')
            ->send();
            
             Yii::$app->session->setFlash('success', "User Account Locked Successfully");
              return $this->redirect(['blockuser']);
        }
        else{
            
            Yii::$app->session->setFlash('error', "User Account Lock Failed ");
                  return $this->redirect(['index']); 
            
        }
        
    }
    
    //admin unlock user account
    
        public function actionUnlockaccount($id){
        $model= $this->findModel($id);
        $model->LOCKED=0;
        $model->LOGINTRIAL=0;
        if($model->save(false)){
            
                 Yii::$app
            ->mailer
            ->compose()
            ->setFrom('muriithi.peter@ekenya.co.ke')
            ->setTo($model->email)
            ->setSubject('Account UnLock')
                ->setTextBody('Plain text content')
           ->setHtmlBody('Hi'.' '.$model->username. ' '. 'Your esb admin portal account has been Unlocked. You can now login')
            ->send();
             Yii::$app->session->setFlash('success', "User Account UnLocked Successfully");
                  return $this->redirect(['index']);
        }
        else{
            
            Yii::$app->session->setFlash('error', "User Account UnLock Failed ");
                  return $this->redirect(['index']); 
            
        }
        
    }
    /**
     * Creates a new Usernew model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Usernew();
        
           $dataProvider = new ActiveDataProvider([
            'query' => Usernew::find(),
        ]);

        if ($model->load(Yii::$app->request->post())) {
            
             $model->IMAGEPATH= UploadedFile::getInstance($model, 'IMAGEPATH');
             if($model->IMAGEPATH){
                 
                    $time = time();
                    $model->IMAGEPATH->saveAs('userimages/' .$time. '.' . $model->IMAGEPATH->extension);
                    $model->IMAGEPATH = 'userimages/' .$time. '.' . $model->IMAGEPATH->extension;
                    
             }
            $useremail=$model->email;
            $model->APPROVED=0;
            $password=$model->password_hash;
            $model->ADDEDBY=Yii::$app->user->identity->username;
            $model->status=10;
            $model->auth_key=Yii::$app->security->generateRandomString();
            $model->password_hash=Yii::$app->security->generatePasswordHash($password);
            
        if($model->save(FALSE)){
            
            //send login details
            
              Yii::$app
            ->mailer
            ->compose()
            ->setFrom('pmuchemi5@gmail.com')
            ->setTo($useremail)
            ->setSubject('Account login details')
                ->setTextBody('Plain text content')
           ->setHtmlBody('Hi'.' '.$model->username. ' '. 'Your esb account portal username is='.' '. $model->username.' ' .'and password is='.' '. $password .' '.
                  '</br> '. 'Account pending approval and activation. Please do not share your password with anyone.')
            ->send();
            
            Yii::$app->session->setFlash('success', "User Created Successfully");
            return $this->redirect(['index']);
        }
        } else {
            return $this->render('create', [
                'model' => $model,
                'dataProvider'=>$dataProvider,
            ]);
        }
    }

    /**
     * Updates an existing Usernew model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
         $dataProvider = new ActiveDataProvider([
            'query' => Usernew::find(),
        ]);
         
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            
            //$password=$model->password_hash;
            $model->status=10;
            $model->APPROVED=0;
           // $model->auth_key=Yii::$app->security->generateRandomString();
           // $model->password_hash=Yii::$app->security->generatePasswordHash($password);
             
            if($model->save(false)){
                      Yii::$app->session->setFlash('success', "User Updated  Successfully");
           return $this->redirect(['index']);
            }
        } else {
            return $this->render('update', [
                'model' => $model,
                'dataProvider'=>$dataProvider,
            ]);
        }
    }

    /**
     * Deletes an existing Usernew model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
     Yii::$app->session->setFlash('success', "User Deleted Successfully");
        return $this->redirect(['index']);
    }
   
    //renders approve users view
    //a list of all unapproved users
    public function actionApproveusers(){
        $model= new Usernew();
        $model= $model->find()->where(['APPROVED'=>0])->all();
        
        return $this->render('approveusers',[
            'model'=>$model,
            ]);
        
    }

    //renders activate users view
    //a list of all approved users
    
    public function actionActivateusers(){
        
        $model= new Usernew();
       
        $model= $model->find()->where(['APPROVED'=>1])->andWhere(['ACTIVATED'=>0])->all();
        
        return $this->render('activateusers',[
            'model'=>$model,
            ]);
    }
    
    //renders view to approve activated user accounts
    //a list of all activated user accounts
      public function actionApproveactivatedusers(){
        
        $model= new Usernew();
       
        $model= $model->find()->where(['ACTIVATED'=>1])->andWhere(['APPROVEACTIVATATION'=>0])->all();
        
        return $this->render('approveactivatedusers',[
            'model'=>$model,
            ]);
    }
    //renders view to deactivate user accounts
    public function actionDeactivateaccounts(){
            $model= new Usernew();
       
        $model= $model->find()->where(['ACTIVATED'=>1])->all();
        
        return $this->render('deactivateusers',[
            'model'=>$model,
            ]);
        
    }
    //actual deactivate
    public function actionDeactivate($id){
         $model= new Usernew();
       
        $model= $model->findOne($id);
        
        $model->ACTIVATED=0;
        $model->APPROVEACTIVATATION=0;
        
        if($model->update(FALSE)){
            
            Yii::$app->session->setFlash('success', "Account Deactivated  Successfully");
            
            return $this->redirect('deactivateaccounts');
            
        }
        
        else{
            Yii::$app->session->setFlash('error', "Account failed to Deactivate  ");
             
            return $this->redirect('deactivateaccounts');
            
        }
        
    }
    
    //block/lock users
    
    public function actionBlockuser(){
      
        $model= new Usernew();
       
        $model= $model->find()->where(['APPROVEACTIVATATION'=>1])->andWhere(['LOCKED'=>0])->all();
        
        return $this->render('blockusers',[
            'model'=>$model,
            ]);
    }
    
    /**
     * Finds the Usernew model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Usernew the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Usernew::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
