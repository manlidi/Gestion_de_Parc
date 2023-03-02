<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body style="font-size: 17px;">
    <div
    style="box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif,'Apple Color Emoji','Segoe UI Emoji','Segoe UI Symbol';background-color:#ffffff;color:#718096;height:100%;line-height:1.4;margin:0;padding:0;width:100%!important">

    <table width="100%" cellpadding="0" cellspacing="0" role="presentation"
        style="box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif,'Apple Color Emoji','Segoe UI Emoji','Segoe UI Symbol';background-color:#edf2f7;margin:0;padding:0;width:100%">
        <tbody>
            <tr>
                <td align="center"
                    style="box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif,'Apple Color Emoji','Segoe UI Emoji','Segoe UI Symbol'">
                    <table width="100%" cellpadding="0" cellspacing="0" role="presentation"
                        style="box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif,'Apple Color Emoji','Segoe UI Emoji','Segoe UI Symbol';margin:0;padding:0;width:100%">
                        <tbody>
                            <tr>
                                <td
                                    style="box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif,'Apple Color Emoji','Segoe UI Emoji','Segoe UI Symbol';padding:25px 0;text-align:center">
                                    <a href="{{ config('app.url') }}" >
                                        {{ config('app.name') }}
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td width="100%" cellpadding="0" cellspacing="0"
                                    style="box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif,'Apple Color Emoji','Segoe UI Emoji','Segoe UI Symbol';background-color:#edf2f7;border-bottom:1px solid #edf2f7;border-top:1px solid #edf2f7;margin:0;padding:0;width:100%">
                                    <table class="m_-2201159301075213469inner-body" align="center" width="570"
                                        cellpadding="0" cellspacing="0" role="presentation"
                                        style="box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif,'Apple Color Emoji','Segoe UI Emoji','Segoe UI Symbol';background-color:#ffffff;border-color:#e8e5ef;border-radius:2px;border-width:1px;margin:0 auto;padding:0;width:570px">
                                        <tbody>
                                            <tr>
                                                <td
                                                style="box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif,'Apple Color Emoji','Segoe UI Emoji','Segoe UI Symbol';max-width:100vw;padding:32px">
                                                <h1
                                                    style="box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif,'Apple Color Emoji','Segoe UI Emoji','Segoe UI Symbol';color:#0068c9;font-size:18px;font-weight:bold;margin-top:0;text-align:left">
                                                    Notification 
                                                    @if ($contenu['type'] == 'vidange')
                                                        Piece Véhicule
                                                    @elseif ($contenu['type'] == 'assurance')
                                                        Assurances Voiture 
                                                    @elseif ($contenu['type'] == 'visite')
                                                        Visite Technique
                                                    @elseif ($contenu['type'] == 'demande')
                                                        Voitures
                                                    @else 
                                                        Piece Véhicule
                                                    @endif
                                                    </h1>
                                                <h4
                                                    style="box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif,'Apple Color Emoji','Segoe UI Emoji','Segoe UI Symbol';color:#232629;font-size:18px;font-weight:bold;margin-top:0;text-align:left">
                                                    Bien à vous monsieur/madame.</h4>
                                                    
                                                <p style="box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif,'Apple Color Emoji','Segoe UI Emoji','Segoe UI Symbol';font-size:16px;line-height:1.5em;margin-top:0;text-align:left">

                                                    @foreach ($notification as $notif)
                                                        @if ($contenu['type'] == 'vidange')
                                                            La voiture <strong class="text-primary">{{ $notif['marque'] }}</strong>
                                                            immatriculé <strong
                                                                class="text-primary">{{ $notif['immatriculation'] }}</strong>
                                                            doit aller en vidange car son kilomettrage a atteint
                                                            <strong class="text-primary">{{ $notif['kmvidange'] }}</strong>
                                                            depuis le dernier vidange.
                                                        @elseif ($contenu['type'] == 'assurance')
                                                                L'assurance de la voiture <strong>{{ $notif['marque'] }}</strong>
                                                            immatriculé <strong
                                                                class="text-primary">{{ $notif['immatriculation'] }}</strong>
                                                            @if ($notif['jourRestant'] < 0)
                                                                est expirée depuis
                                                                {{ $notif['jourRestant'] * -1 }} jour
                                                            @else
                                                                expire dans moins d'une semaine
                                                            @endif
                                                            précisement le <strong
                                                                class="text-primary">{{ $notif['datefinA'] }}
                                                        @elseif ($contenu['type'] == 'visite')
                                                                La prochaine vitsite technique de la voiture <strong
                                                                class="text-primary">{{ $notif['marque'] }}</strong>
                                                            immatriculé <strong
                                                                class="text-primary">{{ $notif['immatriculation'] }}</strong>
                                                            @if ($notif['jourRestant'] < 0)
                                                                est passée il y a {{ $notif['jourRestant'] * -1 }}
                                                            @else
                                                                est dans moins d'une semaine
                                                            @endif
                                                            précisement le <strong
                                                                class="text-primary">{{ $visite['date_next_visite'] }}</strong>
                                                        @elseif ($contenu['type'] == 'demande')
                                                            Les voitures de la demande <strong class="text-primary">{{ $notif['objetnotif'] }}</strong>
                                                            faite par <strong
                                                                class="text-primary">{{ $notif['name'] }}</strong>
                                                            n'ont pas été rendues. La mission est terminé depuis le
                                                            <strong class="text-primary">{{ $notif['datefin'] }}</strong>.
                                                        @else 
                                                            La piece <strong class="text-primary">{{ $notif['nompiece'] }}</strong>
                                                            @if ($notif['jourRestant'] < 0)
                                                                est expirée depuis {{ $notif['jourRestant'] * -1 }} jour
                                                            @else
                                                                expire dans moins d'une semaine
                                                            @endif
                                                            précisement le <strong class="text-primary">{{ $piece['datefin'] }}</strong>
                                                        @endif
                                                    @endforeach                                                
                                                </p>
                                                    <p
                                                        style="box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif,'Apple Color Emoji','Segoe UI Emoji','Segoe UI Symbol';font-size:16px;line-height:1.5em;margin-top:0;text-align:left">
                                                        Merci,<br>
                                                        {{ config('app.name') }}</p>


                                                    <table width="100%" cellpadding="0" cellspacing="0"
                                                        role="presentation"
                                                        style="box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif,'Apple Color Emoji','Segoe UI Emoji','Segoe UI Symbol';border-top:1px solid #e8e5ef;margin-top:25px;padding-top:25px">
                                                        <tbody>
                                                            <tr>
                                                                <td align="center"
                                                                    style="box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif,'Apple Color Emoji','Segoe UI Emoji','Segoe UI Symbol'">
                                                                    <table width="100%" border="0" cellpadding="0"
                                                                        cellspacing="0" role="presentation"
                                                                        style="box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif,'Apple Color Emoji','Segoe UI Emoji','Segoe UI Symbol'">
                                                                        <tbody>
                                                                            <tr>
                                                                                <td align="center"
                                                                                    style="box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif,'Apple Color Emoji','Segoe UI Emoji','Segoe UI Symbol'">
                                                                                    <table border="0"
                                                                                        cellpadding="0" cellspacing="0"
                                                                                        role="presentation"
                                                                                        style="box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif,'Apple Color Emoji','Segoe UI Emoji','Segoe UI Symbol'">
                                                                                        <tbody>
                                                                                            <tr>
                                                                                                <td
                                                                                                    style="box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif,'Apple Color Emoji','Segoe UI Emoji','Segoe UI Symbol'">
                                                                                                    <a href="{{ config('app.url') }}"
                                                                                                        style="box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif,'Apple Color Emoji','Segoe UI Emoji','Segoe UI Symbol';border-radius:4px;color:#fff;display:inline-block;overflow:hidden;text-decoration:none;background-color:#2d3748;border-bottom:8px solid #2d3748;border-left:18px solid #2d3748;border-right:18px solid #2d3748;border-top:8px solid #2d3748">
                                                                                                        Continuer vers le site
                                                                                                    </a>
                                                                                                </td>
                                                                                            </tr>
                                                                                        </tbody>
                                                                                    </table>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td
                                    style="box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif,'Apple Color Emoji','Segoe UI Emoji','Segoe UI Symbol'">
                                    <table class="m_-2201159301075213469footer" align="center" width="570"
                                        cellpadding="0" cellspacing="0" role="presentation"
                                        style="box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif,'Apple Color Emoji','Segoe UI Emoji','Segoe UI Symbol';margin:0 auto;padding:0;text-align:center;width:570px">
                                        <tbody>
                                            <tr>
                                                <td align="center"
                                                    style="box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif,'Apple Color Emoji','Segoe UI Emoji','Segoe UI Symbol';max-width:100vw;padding:32px">
                                                    <p
                                                        style="box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif,'Apple Color Emoji','Segoe UI Emoji','Segoe UI Symbol';line-height:1.5em;margin-top:0;color:#b0adc5;font-size:12px;text-align:center">
                                                        © {{ date('Y') }} {{ config('app.name') }}. @lang('All rights reserved.')</p>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
</div>
</body>

</html>
