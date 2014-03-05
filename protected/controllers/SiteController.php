<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->render('index');
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-Type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}

    protected function respondJSON($data)
    {
        header('Content-type: application/json');
        echo CJSON::encode($data);

        Yii::app()->end();
    }

    protected function outputExtJS($sets)
    {
        $data = array();

        foreach ($sets as $set)
        {
            foreach ($set['cities'] as $city)
            {
                foreach ($set['educations'] as $education)
                {
                    $data[] = array(
                        'name' => $set['user']['name'],
                        'education' => $education['name'],
                        'city' => $city['name']
                    );
                }
            }
        }

        return $data;
    }

    public function actionGetUsers()
    {
        if (Yii::app()->request->isAjaxRequest)
        {
            $results = UserModel::model()->findAll();

            $this->respondJSON($results);
        }
    }

    public function actionGetCities()
    {
        if (Yii::app()->request->isAjaxRequest)
        {
            $results = CityModel::model()->findAll();

            $this->respondJSON($results);
        }
    }

    public function actionGetEducations()
    {
        if (Yii::app()->request->isAjaxRequest)
        {
            $results = EducationModel::model()->findAll();

            $this->respondJSON($results);
        }
    }

    public function actionGetElements()
    {
        if (Yii::app()->request->isAjaxRequest)
        {
            $filter = Yii::app()->request->getQuery('filter', '');

            if (!empty($filter))
            {
                $post['users'] = Yii::app()->request->getQuery('users', '');
                $post['educations'] = Yii::app()->request->getQuery('educations', '');
                $post['cities'] = Yii::app()->request->getQuery('cities', '');

                $conditions["users"] = !empty($post['users'])? "t.id IN ({$post['users']})": "";
                $conditions["educations"] = !empty($post['educations'])? "educations.id IN ({$post['educations']})": "";
                $conditions["cities"] = !empty($post['cities'])? "cities.id IN ({$post['cities']})": "";

                $criteria = new CDbCriteria(array(
                    "condition" => $conditions["users"],
                    "with"      => array(
                        'educations'    => array("condition" => $conditions["educations"]),
                        'cities'        => array("condition" => $conditions["cities"])
                    ),
                ));
            }
            else
            {
                $criteria = new CDbCriteria(array(
                    'with'  => array(
                        'educations',
                        'cities'
                    ),
                ));
            }

            $dataProvider = new CActiveDataProvider('UserModel', array(
                'criteria' => $criteria,
            ));

            $results = $dataProvider->getData();
            //$results = UserModel::model()->findAll($criteria);

            foreach ($results as $result)
            {

                $users[] = array (
                    'user' => $result->attributes,
                    'educations' => $result->educations,
                    'cities' => $result->cities
                );

            }

            $json = $this->outputExtJS(($users));

            $this->respondJSON($json);
        }
    }
}