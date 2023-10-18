<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <style>
        html,
        body {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }
    </style>
</head>

<body>
    <table dir="rtl" style="width: 100%;">
        <tr>
            <td>
                <div style="background-color: #e5e7eb; padding: 64px 16px;">
                    <img src="{{ asset('img/logo.png') }}"
                        style="display:block;width: 160px; margin: 0 auto 20px auto" />
                    <section
                        style="
								background-color: #f9fafb;
								color: #030712;
								border-radius: 16px;
								border: 2px solid #bf995c;
								width: 500px;
								max-width: 100%;
								margin: 0 auto;
								padding: 32px;
							">
                        <h1
                            style="
									font-family: Tahoma, Verdana, Segoe, sans-serif;
									font-size: 25px;
									font-weight: 900;
									letter-spacing: normal;
									margin: 0;
									padding: 0 0 16px 0;
								">
                            {{ $data['main'] }}
                        </h1>
                        <img alt="{{ $data['title'] }}" src="{{ asset('storage/files/' . $data['image']) }}"
                            style="width: 100%; background-color: #e5e7eb; object-fit: contain; display: block; height: 300px" />
                        <p style="margin: 0; font-size: 20px; padding: 16px 0;">
                            {{ $data['title'] }}
                        </p>
                        <table style="width: 100%; border-collapse: collapse;">
                            <tr>
                                <td colspan="2">
                                    <div style="width: 100%; padding: 0.5px 0; background-color: #bf995c;"></div>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding: 10px 0px 16px 0;">
                                    <div style="font-size: 16px;">الدخول</div>
                                    <div style="font-size: 18px;">{{ $data['startDate'] }}</div>
                                </td>
                                <td style="text-align: left; padding: 10px 0 16px 0px;">
                                    <div style="font-size: 16px;">الخروج</div>
                                    <div style="font-size: 18px;">{{ $data['endDate'] }}</div>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding: 0;">
                                    <div style="font-size: 18px;">العنوان</div>
                                </td>
                                <td style="text-align: left; padding:0px;">
                                    <a href="https://www.google.com/maps/search/?api=1&query={{ urlencode($data['map']) }}"
                                        style="
												font-size: 16px;
												background-color: #751d4f;
												padding: 4px 6px;
												color: #f9fafb;
												border-radius: 10px;
												text-decoration: none;
											">الاتجاهات</a>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" style="padding: 6px 0px 10px 0px;">
                                    <div style="font-size: 16px;">{{ $data['address'] }}</div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" style="padding-bottom: 10px;">
                                    <div style="width: 100%; padding: 0.5px 0; background-color: #bf995c;"></div>
                                </td>
                            </tr>
                            @php
                                $icecream = array_filter(
                                    $data['extra'],
                                    function ($ext) {
                                        return $ext->name === 'icecream';
                                    },
                                    1,
                                );
                                $kayak = array_filter(
                                    $data['extra'],
                                    function ($ext) {
                                        return $ext->name === 'kayak';
                                    },
                                    1,
                                );
                                if (!empty($icecream)) {
                                    $icecream = reset($icecream);
                                } else {
                                    $icecream = null;
                                }
                                if (!empty($kayak)) {
                                    $kayak = reset($kayak);
                                } else {
                                    $kayak = null;
                                }
                            @endphp
                            @if ($icecream)
                                <tr>
                                    <td style="padding-bottom: 10px;">
                                        <div style="font-size: 14px;">ماكينة الايس كريم لمدة {{ $icecream->days }}
                                            أيام</div>
                                    </td>
                                    <td style="font-size: 14px; text-align: left; padding-bottom: 10px;">
                                        {{ $icecream->total }} ريال
                                    </td>
                                </tr>
                            @endif
                            @if ($kayak)
                                <tr>
                                    <td style="padding-bottom: 10px;">
                                        <div style="font-size: 14px;">قارب كاياك لمدة {{ $kayak->days }} أيام</div>
                                    </td>
                                    <td style="font-size: 14px; text-align: left; padding-bottom: 10px;">
                                        {{ $kayak->total }} ريال
                                    </td>
                                </tr>
                            @endif
                            <tr>
                                <td style="padding-bottom: 10px;">
                                    <div style="font-size: 14px;">الايجار</div>
                                </td>
                                <td style="font-size: 14px; text-align: left; padding-bottom: 10px;">
                                    {{ $data['price'] }} ريال
                                </td>
                            </tr>
                            <tr>
                                <td style="padding-bottom: 10px;">
                                    <div style="font-size: 14px;">التأمين</div>
                                </td>
                                <td style="font-size: 14px; text-align: left; padding-bottom: 10px;">
                                    {{ App\Models\Setting::first()->assurance }} ريال
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div style="font-size: 20px;">المبلغ الإجمالي</div>
                                </td>
                                <td style="text-align: left;">
                                    <div style="font-size: 20px;">
                                        {{ $data['price'] + $data['ext_price'] + App\Models\Setting::first()->assurance }}
                                        ريال</div>
                                </td>
                            </tr>
                            @if (strlen(App\Models\Setting::first()->terms))
                                <tr>
                                    <td colspan="2" style="padding: 10px 0;">
                                        <div style="width: 100%; padding: 0.5px 0; background-color: #bf995c;"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="padding: 0;">
                                        <div style="font-size: 18px;">الشروط والأحكام</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="padding: 20px 0px 0px 0px;">
                                        <div style="font-size: 16px;">{!! Mark::parse(App\Models\Setting::first()->terms) !!}</div>
                                    </td>
                                </tr>
                            @endif
                        </table>
                    </section>
                    </main>
            </td>
        </tr>
    </table>
</body>

</html>
