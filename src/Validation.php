<?php
namespace OneLogin\Model;

class Validation
{
    const ID_STEP = 8;
    const TIME_STEP = 2;
    const TIMER = 4;

    private static $personal = array(
        'cjp', 'love', 'cxp', '!'
    );

    public static function getSerialization($id)
    {
        $sId = self::serializeId($id);
        $sTime = self::serializeTime();
        $sString = '';
        for ($i = 0; $i < self::TIMER; $i++) {
            $sString .= self::$personal[$i];
            $sString .= $sId[$i];
            $sString .= $sTime[$i];
        }
        return $sString;
    }

    public static function checkValidation($token)
    {
        $unSerializationResult = self::getUnserialization($token);
        $now = (int)substr(time(), 2);
        if (($now - $unSerializationResult['time']) < 60*5) {
            //TODO read data from redis
            echo 'ok';
        } else {
            echo 'Time out';
        }
    }

    private static function getUnserialization($string)
    {
        $sId = '';
        $sTime = '';
        $codeWhere = 0;
        for ($i = 0; $i < self::TIMER; $i++) {
            $codeWhere += strlen(self::$personal[$i]);
            $sId .= substr($string, $codeWhere, self::ID_STEP);
            $codeWhere += self::ID_STEP;
            $sTime .= substr($string, $codeWhere, self::TIME_STEP);
            $codeWhere += self::TIME_STEP;
        }
        return array(
            'id' => $sId,
            'time' => (int)$sTime
        );
    }

    private static function serializeId($id)
    {
        $md5Id = md5($id);
        $sId = array();
        for ($i = 0; $i < self::TIMER; $i++) {
            $sId[] = substr($md5Id, $i*self::ID_STEP, self::ID_STEP);
        }
        return $sId;
    }

    private static function serializeTime()
    {
        $timeStampe = time();
        $sTime = array();
        for ($i = 1; $i <= self::TIMER; $i++) {
            $sTime[] = substr($timeStampe, (-1)*self::TIME_STEP*$i, self::TIME_STEP);
        }
        return array_reverse($sTime);
    }
}
