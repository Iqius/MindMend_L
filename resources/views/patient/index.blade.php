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
        .dashbord-tables {
            animation: transitionIn-Y-over 0.5s;
        }
        .filter-container {
            animation: transitionIn-Y-bottom 0.5s;
        }
        .sub-table, .anime {
            animation: transitionIn-Y-bottom 0.5s;
        }
    </style>
</head>
<body>

<!-- <div class="modal" id="myModal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <form action="{{ route('upload.file') }}" method="post" enctype="multipart/form-data">
            @csrf
            <h2>Upload File</h2>
            <input type="file" name="fileToUpload" id="fileToUpload" required>
            <br><br>
            <input type="submit" value="Upload File" name="submit">
        </form>
    </div>
</div> -->

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
                                    @csrf
                                    <button type="submit" class="logout-btn btn-primary-soft btn">Log out</button>
                                </form>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr class="menu-row">
                <td class="menu-btn menu-icon-home menu-active menu-icon-home-active" style="padding-top: 25px;">
                    <a href="{{ route('patient.index') }}" class="non-style-link-menu non-style-link-menu-active">
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
                <td class="menu-btn menu-icon-session" style="padding-top: 25px;">
                    <a href="{{ route('patient.schedule') }}" class="non-style-link-menu">
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
                    </a>
    </div>
    </td>
    </tr>
    <tr class="menu-row">
        <td class="menu-btn menu-icon-settings" style="padding-top: 25px;">
            <a href="{{ route('patient.setting') }}" class="non-style-link-menu">
                <div>
                    <p class="menu-text">Settings</p>
            </a>
            </div>
        </td>
    </tr>
    </table>
    </div>

    <div class="dash-body">
        <div class="header-container mt-2 anim" style="background-color: #161c2d;">
            <div class="title">Home</div>
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
        <td colspan="4">
                    <center>
                        <table class="filter-container doctor-header" style="border: none;width:95%; height: 70%"
                            border="0">
                            <tr>
                                <td class=""
                                    style="padding-left: 30px; padding-top: 25px; padding-bottom: 15px; padding-right: 30px">
                                    <h3>Welcome!</h3>
                                    <h1>{{ $user->pname }}.</h1>
                                    <p>Thank you for joining us. We strive to provide you with comprehensive service.
                                        <br>
                                        You can view your appontments with your doctor of your choice!
                                    </p>
                                    <a href="appointment.php" class="non-style-link"><button class="btn-primary btn"
                                            style="width:20%; margin-top: 15px">View My Appointments</button></a>
                                    <br>
                                    <br>
                                </td>
                            </tr>
                        </table>
                    </center>
                </td>
        <div class="row">
            <div class="col-md-3 anim">
                <div class="upload-container mt-4 container-card" style="height: 220px;">
                    <form action="upload.php" method="post" enctype="multipart/form-data">
                        <label class="upload-label">Upload Sound</label>
                        <div class="form-group d-flex justify-content-center">
                            <input type="file" class="form-control-file mt-4" id="fileToUpload" name="fileToUpload">
                        </div>
                        <div class="d-flex justify-content-center">
                            <!-- Menambahkan div dengan class d-flex justify-content-center -->
                            <button type="submit" class="btn btn-primary mt-4">Upload</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-3 anim">
                <div class="mt-4 container-color" style="height: 220px; width: 1100px;">
                    <label class="upload-label">Appointed Doctor</label>
                    <div class="search-bar mt-2">
                        <a href="appointment.php" class="btn btn-primary mt-4">Find your suitable doctor</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>