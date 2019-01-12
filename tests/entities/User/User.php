<?php
namespace sorokinmedia\promocodes\tests\entities\User;

use sorokinmedia\user\entities\User\AbstractUser;

/**
 * Class User
 * @package sorokinmedia\promocodes\tests\entities\User
 */
class User extends AbstractUser
{
    use RelationClassTrait;

    const ROLE_ADMIN = 'roleAdmin';
    const ROLE_OWNER = 'roleOwner';
    const ROLE_WORKER = 'roleWorker';

    public function afterSignUp(string $role = null)
    {
        return true;
    }

    public function afterSignUpEmail(string $role = null)
    {
        return true;
    }

    public function sendEmailConfirmation() : bool
    {
        return true;
    }

    public function sendEmailConfirmationWithPassword(string $password) : bool
    {
        return true;
    }

    public function sendPasswordResetMail() : bool
    {
        return true;
    }

    public function getPrimaryRole() : string
    {
        return self::ROLE_ADMIN;
    }

    public static function getRoleLink(string $role = null)
    {
        $roles = [
            self::ROLE_ADMIN => 'admin'
        ];
        if ($role !== null){
            return $roles[$role];
        }
        return $roles;
    }

    public static function getRolesArray(string $role = null)
    {
        $roles = [
            self::ROLE_ADMIN => \Yii::t('app', 'Администратор')
        ];
        if ($role !== null){
            return $roles[$role];
        }
        return $roles;
    }

    public function telegramOn() : bool
    {
        return true;
    }

    public function telegramOff() : bool
    {
        return true;
    }

    public function processInvites()
    {
        
    }
}