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

<!-- Sidebar -->
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
                            <img src="{{ asset('assets/img/user.png') }}" alt="User Image" width="100%" style="border-radius:50%">
                        </td>
                        <td style="padding:0px;margin:0px;">
                            <p class="profile-title">{{ Str::limit($user->pname, 13) }}</p>
                            <p class="profile-subtitle">{{ Str::limit($user->pemail, 22) }}</p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="padding-bottom: 30px;">
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="logout-btn btn-primary-soft btn">Log out</button>
                            </form>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <!-- Sidebar Menu Items -->
        <tr class="menu-row">
            <td class="menu-btn menu-icon-home pt-4">
                <a href="{{ route('patient.index') }}" class="non-style-link-menu">
                    <div><p class="menu-text">Home</p></div>
                </a>
            </td>
        </tr>
        <tr class="menu-row">
            <td class="menu-btn menu-icon-doctor pt-4">
                <a href="{{ route('patient.doctors') }}" class="non-style-link-menu">
                    <div><p class="menu-text">Appointed Doctors</p></div>
                </a>
            </td>
        </tr>
        <tr class="menu-row">
            <td class="menu-btn menu-icon-session pt-4">
                <a href="{{ route('patient.schedule') }}" class="non-style-link-menu">
                    <div><p class="menu-text">Scheduled Sessions</p></div>
                </a>
            </td>
        </tr>
        <tr class="menu-row">
            <td class="menu-btn menu-icon-appoinment" style="padding-top: 25px;">
                <a href="{{ route('patient.appointment') }}" class="non-style-link-menu">
                    <div><p class="menu-text">My Bookings</p></div>
                </a>
            </td>
        </tr>
        <tr class="menu-row">
            <td class="menu-btn menu-icon-settings pt-4">
                <a href="{{ route('patient.settings') }}" class="non-style-link-menu">
                    <div><p class="menu-text">Settings</p></div>
                </a>
            </td>
        </tr>
    </table>
</div>

<!-- Main Content -->
<div class="dash-body">
    <table border="0" width="100%" style=" border-spacing: 0;margin:0;padding:0;margin-top:25px; ">
    <div class="header-container mt-2 anim" style="background-color: #161c2d;">
        <div class="title">Appointed Doctors</div>
        <div class="date d-flex align-items-center">
            <div>
                <p class="subtitle" style="color: #808A9A;">Today's Date</p>
                <p class="text-white">{{ now()->format('Y-m-d') }}</p>
            </div>
            <button class="btn-label ml-3" style="display: flex; justify-content: center; align-items: center;background-color: #BACAE1; pointer-events: none;">
                <img src="{{ asset('assets/img/calendar.svg') }}" width="100%">
            </button>
        </div>
    </div>

    
            <!-- <tr>
                <td colspan="4" style="padding-top:10px;">
                    <p class="heading-main12 anim" style="margin-left: 45px;font-size:18px; color: #0A76D8;">All Appointed Doctors ({{ $doctors->count() }})</p>
                </td>
            </tr> -->
        <!-- Search Form -->
         <tr>
            <td>
            <form action="{{ route('patient.doctors') }}" method="GET" class="header-search">
                @csrf
                <input type="Search" value="Search" class="input-text header-searchbar"
                    placeholder="Search Doctor name or Email" list="doctors">&nbsp;&nbsp;
                    <datalist id="doctors">
                    @foreach ($list as $item)
                        <option value="{{ $item->docname }}"></option>
                        <option value="{{ $item->docemail }}"></option>
                    @endforeach
                </datalist>
                <input type="Submit" value="Search" class="login-btn btn-primary btn anim"
                            style="padding-left: 25px;padding-right: 25px;padding-top: 10px;padding-bottom: 10px;">
            </form>
            </td>
         </tr>
            

            <tr>
                <td colspan="4" style="padding-top:10px;">
                    <p class="heading-main12 anim" style="margin-left: 45px;font-size:18px; color: #0A76D8;">
                        Appointed Doctors ({{ $list11->count() }})
                    </p>
                </td>
            </tr>
        <!-- Doctors Table -->
        <tr>
                <td colspan="4">
                    <center>
                        <div class="table-session scroll">
                            <table width="93%" class="sub-table scrolldown" border="0"
                                style="background-color: #161c2d;">
                                <thead>
                                    <tr>
                                        <th class="table-headin" style="color: #BACAE1;">
                                            Doctor Name
                                        </th>
                                        <th class="table-headin" style="color: #BACAE1;">
                                            Email
                                        </th>
                                        <th class="table-headin" style="color: #BACAE1;">
                                            Specialties
                                        </th>
                                        <th class="table-headin" style="color: #BACAE1;">
                                            Events
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($doctors as $doctor)
                                    <tr>
                                        <td style="color: white; text-align: center">{{ $doctor->docname }}</td>
                                        <td style="color: white; text-align: center">{{ $doctor->docemail }}</td>
                                        <td style="color: white; text-align: center">{{ $doctor->specialties }}</td>
                                        <td>
                                            <div style="display: flex; justify-content: center;">
                                            <button class="btn-primary-soft btn button-icon btn-view" style="padding-left: 40px; padding-top: 12px; padding-bottom: 12px; margin-top: 10px;" data-toggle="modal" data-target="#doctorModal{{ $doctor->docid }}">
                                                View Details
                                            </button>
                                            </div>
                                        </td>
                                    </tr>                                       
                                @endforeach
                                @foreach ($doctors as $doctor)
                                        <div class="modal fade" id="doctorModal{{ $doctor->docid }}" tabindex="-1" aria-labelledby="doctorModalLabel{{ $doctor->docid }}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <!-- Konten modal -->
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="doctorModalLabel{{ $doctor->docid }}">View Details</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <!-- Informasi dokter -->
                                                        <h3>MindMend Web App</h3>
                                                        <p><strong>View Details.</strong></p>
                                                        <p>
                                                            <strong>Name:</strong> {{ $doctor->docname }}
                                                            <br>
                                                            <strong>Email:</strong> {{ $doctor->docemail }}
                                                            <br>
                                                            <strong>Phone Number:</strong> {{ $doctor->doctel }}
                                                            <br>
                                                            <strong>Specialties:</strong> {{ $doctor->specialties }}
                                                        </p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                
                                </tbody>
                            </table>
                        </div>
                    </center>
                </td>
            </tr>
        </table>
    </div>
</div>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
