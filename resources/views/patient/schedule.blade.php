<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/animations.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/admin.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/sidebar.css') }}">
    <title>Dashboard</title>
    <style>
            .popup {
            animation: transitionIn-Y-bottom 0.5s;
        }

        .sub-table {
            animation: transitionIn-Y-bottom 0.5s;
        }

        .anim {
            animation: transitionIn-Y-bottom 0.5s;
        }

        .header-searchbar {
            animation: transitionIn-Y-bottom 0.5s;
            width: 500px;
            /* Adjust the width as needed */
            padding: 5px;
            /* Adjust the padding as needed */
            font-size: 14px;
            /* Adjust the font size as needed */
        }

        .login-btn {
            padding: 5px 15px;
            /* Adjust the padding as needed */
            font-size: 14px;
            /* Adjust the font size as needed */
        }

        .table-session {
            width: 100%;
            height: 100%;
            overflow: auto;
            margin: 0;
        }

        .sub-table thead th {
            border-bottom: 2px solid #465060;
            /* Tambahkan border bawah biru pada header tabel */
            padding: 10px;
            /* Atur padding jika diperlukan */
        }

        .sub-table {
            border: 0px solid #161c2d;
            border-radius: 8px;
            margin: 0;
        }
    </style>
</head>

<body>
<div class="menu sb-color">
    <div style="padding-top: 31px; text-align: center;">
        <p style="color: white; font-weight: bold; font-size: 36px; margin-bottom: 40px; margin-top: 0px;">
            <span style="color: white; margin-right: -4px;">MIND</span>
            <span style="color: #007bff; margin-left: -4px;">MEND</span>
        </p>
    </div>
    <table class="menu-container" style="margin-top: 0px;" border="0">
        <tr>
            <td style="padding:0px" colspan="2">
                <table border="0" class="profile-container">
                    <tr>
                        <td width="30%" style="padding-left:20px">
                            <img src="{{ asset('assets/img/user.png') }}" alt="" width="100%" style="border-radius:50%">
                        </td>
                        <td style="padding:0px;margin:0px;">
                            <p class="profile-title">{{ Str::limit($user->pname, 13) }}</p>
                            <p class="profile-subtitle">{{ Str::limit($user->pemail, 22) }}</p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="padding-bottom: 30px;">
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf <!-- Laravel CSRF protection -->
                                <button type="submit" class="logout-btn btn-primary-soft btn">Log out</button>
                            </form>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr class="menu-row">
            <td class="menu-btn menu-icon-home" style="padding-top: 25px;">
                <a href="{{ route('patient.index') }}" class="non-style-link-menu">
                    <div>
                        <p class="menu-text">Home</p>
                    </div>
                </a>
            </td>
        </tr>
        <tr class="menu-row">
            <td class="menu-btn menu-icon-doctor" style="padding-top: 25px;">
                <a href="{{ route('patient.doctors') }}" class="non-style-link-menu">
                    <div>
                        <p class="menu-text">Appointed Doctors</p>
                    </div>
                </a>
            </td>
        </tr>
        <tr class="menu-row">
            <td class="menu-btn menu-icon-session menu-active menu-icon-session-active" style="padding-top: 25px;">
                <a href="{{ route('patient.schedule') }}" class="non-style-link-menu non-style-link-menu-active">
                    <div>
                        <p class="menu-text">Scheduled Sessions</p>
                    </div>
                </a>
            </td>
        </tr>
        <tr class="menu-row">
            <td class="menu-btn menu-icon-appoinment" style="padding-top: 25px;">
                <a href="{{ route('patient.appointment') }}" class="non-style-link-menu">
                    <div>
                        <p class="menu-text">My Bookings</p>
                    </div>
                </a>
            </td>
        </tr>
        <tr class="menu-row">
            <td class="menu-btn menu-icon-settings" style="padding-top: 25px;">
                <a href="{{ route('patient.setting') }}" class="non-style-link-menu">
                    <div>
                        <p class="menu-text">Settings</p>
                    </div>
                </a>
            </td>
        </tr>
    </table>
    </div>

    <div class="dash-body">
        <table border="0" width="100%" style=" border-spacing: 0;margin:0;padding:0;margin-top:25px;">
            <div class="header-container mt-2 anim" style="background-color: #161c2d;">
                <div class="title">Scheduled Sessions</div>
                <div class="date" style="display: flex; align-items: center;">
                    <div>
                        <p class="subtitle" style="color: #808A9A">Today's Date</p>
                        <p class="heading-sub12" style="padding: 0;margin: 0;color: white;">
                            {{ now()->format('Y-m-d') }}
                        </p>
                    </div>
                    <button class="btn-label ml-3"
                        style="display: flex; justify-content: center; align-items: center; background-color: #BACAE1; pointer-events: none;">
                        <img src="{{ asset('assets/img/calendar.svg') }}" width="100%">
                    </button>
                </div>
            </div>
            <tr>
                <td>
                <form action="{{ route('patient.schedule') }}" method="GET" class="header-search">
    @csrf <!-- Laravel CSRF protection -->
    
    <input type="search" name="search" class="input-text header-searchbar"
           placeholder="Search Doctor name or Email or Date (YYYY-MM-DD)" list="doctors">&nbsp;&nbsp;
    
    <datalist id="doctors">
        <!-- Populate datalist options -->
        @foreach ($doctors as $doctor)
            <option value="{{ $doctor->docname }}">
        @endforeach
    </datalist>
    
    <input type="submit" value="Search" class="login-btn btn-primary btn anim"
           style="padding-left: 25px; padding-right: 25px; padding-top: 10px; padding-bottom: 10px;">
</form>


                </td>
            </tr>

            <tr>
                <td colspan="4" style="padding-top:10px;">
                    <p class="heading-main12 anim" style="margin-left: 45px;font-size:18px; color: #0A76D8;">
                        All Sessions ({{ $list11->count() }})
                    </p>
                </td>
            </tr>




            <tr>
                <td colspan="4">
                    <center>
                        <div class="abc scroll">
                            <table width="100%" class="sub-table scrolldown" border="0"
                                style="padding: 50px;border:none">
                                <tbody>
                                    @if ($schedules->isEmpty())
                                    <tr>
                                        <td colspan="4">
                                            <br><br><br><br>
                                            <center>
                                                <img src="{{ asset('assets/img/notfound.svg') }}" width="25%">
                                                <br>
                                                <p class="heading-main12"
                                                    style="margin-left: 45px;font-size:20px;color: #071327">
                                                    We couldn't find anything related to your keywords!
                                                </p>
                                                <a class="non-style-link" href="{{ route('patient.schedule') }}">
                                                    <button class="login-btn btn-primary btn anim">
                                                        &nbsp; Show all Sessions &nbsp;
                                                    </button>
                                                </a>
                                            </center>
                                            <br><br><br><br>
                                        </td>
                                    </tr>
                                    @else
                                    @foreach ($schedules as $schedule)
                                    <tr>
                                        <td style="width: 25%;">
                                            <div class="dashboard-items search-items"
                                                style="background-color: #161c2d;">
                                                <div style="width:100%">
                                                    <div class="h1-search">
                                                    
                                                        {{ substr($schedule->title, 0, 21) }}
                                                    </div><br>
                                                    <div class="h3-search">
                                                        {{ substr($schedule->docname, 0, 30) }}
                                                    </div>
                                                    <div class="h4-search">
                                                    Dokter: {{ $schedule->doctor->docname }}<br>
                                                        {{ $schedule->scheduledate }}<br>Starts:
                                                        <b>{{ substr($schedule->scheduletime, 0, 5) }}</b>
                                                        (24h)
                                                    </div>
                                                    <br>
                                                    
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </center>
                </td>
            </tr>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
