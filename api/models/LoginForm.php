<?php
namespace api\models;

use Yii;
use yii\base\Model;
use common\models\User;

/**
 * Login form
 */
class LoginForm extends Model
{
    public $email;
    public $password;
    public $rememberMe = true;

    private $_user;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['rememberMe', 'default', 'value' => true],
            // username and password are both required
            [['email', 'password'], 'required','message' => '{attribute} can not be blank'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
        ];
    }

    /**
     * @attributes name
     */
    public function attributeLabels()
    {
        return [
            'email' => 'Email Address',
            'password' => 'Password'

        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || $user->pin != $this->password) {
                $this->addError($attribute, 'Incorrect email or password.');
            }
        }
    }



    /**
     * Logs in a user using the provided username and password.
     *
     * @return boolean whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate())
        {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 1800);
        }
        else
            {
            return false;
        }
    } 
    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    protected function getUser()
    {
        if ($this->_user === null) {
            $this->_user = User::findByStudyID($this->email);
        }

        return $this->_user;
    }
}
