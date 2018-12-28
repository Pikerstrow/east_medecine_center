<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 27.12.2018
 * Time: 20:44
 */

namespace Clinic\Classes;


class Avatar
{
    const MALE_AVATARS_ROOT = SITE_ROOT . "img" . DS . "male_avatars" ;
    const FEMALE_AVATARS_ROOT = SITE_ROOT . "img" . DS . "female_avatars" ;
    const MALE_AVATARS_URL = SITE_URL . "/img/male_avatars/";
    const FEMALE_AVATARS_URL = SITE_URL . "/img/female_avatars/";

    protected $gender;
    protected $maleAvatars = array();
    protected $femaleAvatars = array();

    public function __construct($gender)
    {
        $this->gender = $gender;
        $this->maleAvatars = array_diff(scandir(self::MALE_AVATARS_ROOT), array('.', '..'));
        $this->femaleAvatars = array_diff(scandir(self::FEMALE_AVATARS_ROOT), array('.', '..'));
    }

    public function setAvatar()
    {
        if($this->gender == 'чоловік' and count($this->maleAvatars) > 0){
            return self::MALE_AVATARS_URL . $this->maleAvatars[array_rand($this->maleAvatars)];
        }

        if($this->gender == 'жінка' and count($this->femaleAvatars) > 0){
            return self::FEMALE_AVATARS_URL . $this->femaleAvatars[array_rand($this->femaleAvatars)];
        }

        return null;
    }


}