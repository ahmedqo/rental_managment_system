<?php

namespace App\Functions;

use App\Mail\ContactMail;
use App\Mail\SendMail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use Illuminate\Support\Str;
use App\Mail\ResetMail;
use App\Models\Property;
use Carbon\Carbon;


class MailFunction
{
    public static function forgot($email)
    {
        $user = User::where('email', $email)->first();

        if (!$user) {
            return false;
        }

        $token = Str::random(20);

        DB::table('password_resets')->insert([
            'email' => $user->email,
            'token' => $token,
        ]);

        $mail = new ResetMail(['token' => $token]);

        Mail::to($user->email)->send($mail);
        return true;
    }

    public static function contact($data)
    {
        $mail = new ContactMail($data);
        Mail::to(env('MAIL_CONTACT_ADDRESS'))->send($mail);
        return true;
    }

    public static function _data($data)
    {
        $days = [
            'Monday' => 'الاثنين',
            'Tuesday' => 'الثلاثاء',
            'Wednesday' => 'الأربعاء',
            'Thursday' => 'الخميس',
            'Friday' => 'الجمعة',
            'Saturday' => 'السبت',
            'Sunday' => 'الأحد',
            'Mon' => 'الاثنين',
            'Tue' => 'الثلاثاء',
            'Wed' => 'الأربعاء',
            'Thu' => 'الخميس',
            'Fri' => 'الجمعة',
            'Sat' => 'السبت',
            'Sun' => 'الأحد',
        ];
        $months = [
            'January' => 'يناير',
            'February' => 'فبراير',
            'March' => 'مارس',
            'April' => 'أبريل',
            'May' => 'مايو',
            'June' => 'يونيو',
            'July' => 'يوليو',
            'August' => 'أغسطس',
            'September' => 'سبتمبر',
            'October' => 'أكتوبر',
            'November' => 'نوفمبر',
            'December' => 'ديسمبر',
            'Jan' => 'يناير',
            'Feb' => 'فبراير',
            'Mar' => 'مارس',
            'Apr' => 'أبريل',
            'May' => 'مايو',
            'Jun' => 'يونيو',
            'Jul' => 'يوليو',
            'Aug' => 'أغسطس',
            'Sep' => 'سبتمبر',
            'Oct' => 'أكتوبر',
            'Nov' => 'نوفمبر',
            'Dec' => 'ديسمبر',
        ];

        $pattern_1 = '/\b(' . implode('|', array_keys($days)) . ')\b/iu';
        $pattern_2 = '/\b(' . implode('|', array_keys($months)) . ')\b/iu';
        $replacement_1 = function ($matches) use ($days) {
            return $days[$matches[1]];
        };
        $replacement_2 = function ($matches) use ($months) {
            return $months[$matches[1]];
        };

        $getDate = function ($date) use ($replacement_1, $replacement_2, $pattern_1, $pattern_2) {
            $str = preg_replace_callback($pattern_1, $replacement_1, $date);
            return preg_replace_callback($pattern_2, $replacement_2, $str);
        };

        $property = Property::findorfail($data['id']);
        $startDate = Carbon::parse($data['reservation']->startDate);
        $endDate = Carbon::parse($data['reservation']->endDate);
        $extra = array_reduce(json_decode($data['reservation']->extra), function ($carry, $ext) {
            return $carry + $ext->total;
        });
        $price =  DateFunction::price(DateFunction::period($startDate, $endDate), $property->normalPrice, $property->specialPrice);
        $image = FileFunction::all($data['id'])[0]->name;

        return [
            'main' => $data['title'],
            'subject' => $data['subject'],
            'title' => $property->title,
            'map' => $property->map,
            'address' => $property->address . ', ' . $property->city . ', ' . $property->state . ', ' . $property->zipcode,
            'startDate' =>  $getDate($startDate->format('l d, M Y')),
            'endDate' => $getDate($endDate->format('l d, M Y')),
            'price' => $price,
            'image' => $image,
            'ext_price' => +$extra,
            'extra' => json_decode($data['reservation']->extra),
        ];
    }

    public static function send($email, $data, $attach = true)
    {
        $mail = new SendMail(MailFunction::_data($data));
        // if($attach) 
        //     $mail->attach(public_path('contract/file.pdf'), ['as' => 'contract.pdf']);
        Mail::to($email)->send($mail);
        return true;
    }
}
