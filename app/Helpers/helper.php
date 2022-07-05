<?php

use App\Models\Follow;
use App\Models\User;
use App\Models\Post;
use App\Models\PostLike;
use App\Models\PostInvite;
use App\Models\Notification;
use App\Services\FCMService;
use Illuminate\Support\Facades\DB;

if (!function_exists('pre')) {
    /**
     * To check is data is isset and empty
     * @param $data
     * @param $isInt, int=> true, string = false
     */
    function pre($data)
    {
        echo "<pre>";
        print_r($data);
        die;
    }
}


if (!function_exists('checkIfEmpty')) {
    /**
     * To check is data is isset and empty
     * @param $data
     * @param $isInt, int=> true, string = false
     */
    function checkIfEmpty($data, $isInt = false)
    {
        if (isset($data) && !empty($data) &&  $data != "null" &&  $data != null) {
            return $data;
        } else {
            return ($isInt == true ? 0 : "");
        }
    }
}

if (!function_exists('get_current_date_time')) {
    function get_current_date_time($date = null)
    {
        $timeZone  = get_time_zone();
        if (isset($timeZone) && !empty($timeZone)) {
            $date = $date ?? now();
            $timestamp  = strtotime($date);
            $dt         = new DateTime("now", new DateTimeZone($timeZone)); //first argument "must" be a string
            $dt->setTimestamp($timestamp); //adjust the object to correct timestamp
            return $dt->format('Y-m-d H:i:s');
        }
        return $date;
    }
}


if (!function_exists('get_current_date_time_timezone')) {
    function get_current_date_time_timezone($date = null, $timeZone)
    {
        if (isset($timeZone) && !empty($timeZone)) {
            $date = $date ?? now();
            $timestamp  = strtotime($date);
            $dt         = new DateTime("now", new DateTimeZone($timeZone)); //first argument "must" be a string
            $dt->setTimestamp($timestamp); //adjust the object to correct timestamp
            return $dt->format('Y-m-d H:i:s');
        }
        return $date;
    }
}

if (!function_exists('get_current_date_time_without_format')) {
    function get_current_date_time_without_format($date = null)
    {
        $timeZone  = get_time_zone();
        $date = $date ?? now();
        $timestamp  = strtotime($date);
        $dt         = new DateTime("now", new DateTimeZone($timeZone)); //first argument "must" be a string
        $dt->setTimestamp($timestamp); //adjust the object to correct timestamp
        return $dt;
    }
}


if (!function_exists('get_device_id')) {
    function get_device_id()
    {
        return request()->header('Device-Id');
    }
}


if (!function_exists('get_time_zone')) {
    function get_time_zone()
    {
        return request()->header('Time-Zone');
    }
}


if (!function_exists('genrate_random_string')) {
    function genrate_random_string(int $lenth)
    {
        $random = str_shuffle('abcdefghjklmnopqrstuvwxyzABCDEFGHJKLMNOPQRSTUVWXYZ234567890!$%^&!$%^&');
        return substr($random, 0, $lenth);
    }
}

/**
 * To get time ago
 */
function time_elapsed_string($datetime, $full = false)
{
    $now = new \DateTime();
    $ago = new \DateTime($datetime);
    $diff = $now->diff($ago);
    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;
    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}



if (!function_exists('convert_bits')) {
    function convert_bits($bits)
    {
        $one_mb = 1000000; // 1mb = 1000000 bytes
        $one_kb = 1000; // 1kb = 1000 bytes
        if ($bits < $one_mb) {
            return round($bits / $one_kb, 1) . " kb";
        }
        if ($bits > $one_mb) {
            return round($bits / $one_mb, 1) . " mb";
        }
    }
}


/**
 * To check chat allowed or not on any post
 * @param int $currentLoggedInUserID
 * @param /App/Models/Post $post
 */
if (!function_exists('chat_allowed')) {
    function chat_allowed($currentUserId, $post)
    {
        $isAllowed = false;
        if ($currentUserId == $post->user_id || $post->group_chat_option == 1) {
            $isAllowed = true;
        } elseif ($post->group_chat_option == 2 || $post->group_chat_option == 3) {
            $isAllowed = PostInvite::where(['sender_id' => $currentUserId, 'post_id' => $post->id, 'status' => 'accepted'])->exists();
        }

        return $isAllowed;
    }
}


/**
 * To check User is private or public
 * 
 */
if (!function_exists('profile_type')) {

    function profile_type($type)
    {
        if ($type){
        
            return "private";
        
        }

        return "public";
    }
}



function likeDislikeNotificationPost($postLike){

    /*** Sending notification to user -Start ***/
    $postCreator = Post::whereId($postLike->post_id)->first()->user_id;
    $receiver = User::find($postCreator);
    $iosDevices = $receiver->userDeviceTokens('ios');
    $androidDevices = $receiver->userDeviceTokens('android');

    if ((is_countable($iosDevices) && count($iosDevices) > 0) ||  (is_countable($androidDevices) && count($androidDevices) > 0)) {
        $fcm = $this->fcmService->setTitle('Like')
            ->setBody(" is liked your Post.")
            ->setType("liked")
            ->setTypeData(new UserResource($user))
            ->setSourceType("liked")
            ->setSourceId(1)
            ->setUserId($receiver->id)
            ->setIosTokens($iosDevices)
            ->setAndroidTokens($androidDevices)
            ->create()->push();
    }
    return $postLike;
}
