<?php
namespace frontend\tests;

use common\fixtures\UserFixture;
use frontend\models\SignupForm;
use common\models\User;

class SignUpTest extends \Codeception\Test\Unit
{
    /**
     * @var \frontend\tests\UnitTester
     */
    protected $tester;

    protected function _before()
    {
        $this->tester->haveFixtures([
            'user' => [
                'class' => UserFixture::className(),
                'dataFile' => codecept_data_dir() . 'user.php'
            ]
        ]);
    }

    protected function _after()
    {
    }

    // tests
    public function testSomeFeature()
    {

    }

    // public function testValidation()
    // {
    //     $user = new User;

    //     $user->setName(null);
    //     $this->assertFalse($user->validate(['username']));

    //     $user->setName('toolooooongnaaaaaaameeee');
    //     $this->assertFalse($user->validate(['username']));

    //     $user->setName('davert');
    //     $this->assertTrue($user->validate(['username']));
    // }
}