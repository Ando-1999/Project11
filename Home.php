<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Index (Home)</title>

    <!-- CSS Links -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" type="text/css" href="assets/css/style.css" />

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
</head>
<body>

    <!-- Side Menu -->
    <section id="menu">
        <div class="logo">
            <img src="assets/img/logo.png" />
            <h2>Project 11 Dashboard</h2>
        </div>

        <div class="items">
            <li><i class="fa-solid fa-house"></i><a href="Home.php">Home</a></li>
            <li><i class="fa-solid fa-chart-pie"></i><a href="Dashboard.php">Dashboard</a></li>
            <li><i class="fa-solid fa-magnifying-glass-chart"></i><a href="Analysis.php">Data Analysis</a></li>
            <li><i class="fa-solid fa-users"></i><a href="Management.php">User Management</a></li>
            <li><i class="fa-solid fa-file-excel"></i><a href="Excel.php">Excel</a></li>
        </div>
    </section>

    <!-- Interface -->
    <section id="interface">
        <div class="navigation">

            <!-- Search -->
            <div class="n1">
                <div>
                    <i id="menu-btn" class="fa-solid fa-bars"></i>
                </div>
                <div class="search">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <form>
                        <input type="text" placeholder="Search..." />
                    </form>
                </div>
            </div>

            <!-- Profile (We will likey use something else here)-->
            <div class="profile">
                <i class="fa-solid fa-bell"></i>
                <img src="assets/img/userimg.png"/>
            </div>
        </div>

        <!-- Title -->
        <h3 class="i-name">Dashboard</h3>

        <!-- Cards -->
        <div class="values">

            <div class="val-box">
                <i class="fa-solid fa-users"></i>
                <div>
                    <h3>8,255</h3>
                    <span>Users</span>
                </div>
            </div>

            <div class="val-box">
                <i class="fa-solid fa-users"></i>
                <div>
                    <h3>8,255</h3>
                    <span>Users</span>
                </div>
            </div>

            <div class="val-box">
                <i class="fa-solid fa-users"></i>
                <div>
                    <h3>8,255</h3>
                    <span>Users</span>
                </div>
            </div>

            <div class="val-box">
                <i class="fa-solid fa-users"></i>
                <div>
                    <h3>8,255</h3>
                    <span>Users</span>
                </div>
            </div>

        </div>

        <!-- Table (Useful for User Management/Adaptation to Display Enviro Data) -->
        <div class="board">
            <table width="100%">
                <thead>
                    <tr>
                        <td>Name</td>
                        <td>Title</td>
                        <td>Role</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="people">
                            <p><img src="assets/img/userimg.png" /></p>
                            <div class="people-desc">
                                <h5>John</h5>
                                <p>john@email.com</p>
                            </div>
                        </td>

                        <td class="people-des">
                            <h5>Environmental Analyst</h5>
                            <p>UTAS</p>
                        </td>

                        <td class="active">
                            <p>Active</p>
                        </td>

                        <td class="role">
                            <p>Advisor</p>
                        </td>

                        <td class="edit">
                            <p><a href="#">Edit</a></p>
                        </td>
                    </tr>


                    <tr>
                        <td class="people">
                            <p><img src="assets/img/userimg.png" /></p>
                            <div class="people-desc">
                                <h5>Jane</h5>
                                <p>jane@email.com</p>
                            </div>
                        </td>

                        <td class="people-des">
                            <h5>Environmental Analyst</h5>
                            <p>UTAS</p>
                        </td>

                        <td class="inactive">
                            <p>Inactive</p>
                        </td>

                        <td class="role">
                            <p>Project Manager</p>
                        </td>

                        <td class="edit">
                            <p><a href="#">Edit</a></p>
                        </td>
                    </tr>


                    <tr>
                        <td class="people">
                            <p><img src="assets/img/userimg.png" /></p>
                            <div class="people-desc">
                                <h5>Tom</h5>
                                <p>tom@email.com</p>
                            </div>
                        </td>

                        <td class="people-des">
                            <h5>Environmental Analyst</h5>
                            <p>UTAS</p>
                        </td>

                        <td class="active">
                            <p>Active</p>
                        </td>

                        <td class="role">
                            <p>Advisor</p>
                        </td>

                        <td class="edit">
                            <p><a href="#">Edit</a></p>
                        </td>
                    </tr>


                    <tr>
                        <td class="people">
                            <p><img src="assets/img/userimg.png" /></p>
                            <div class="people-desc">
                                <h5>Dick</h5>
                                <p>dick@email.com</p>
                            </div>
                        </td>

                        <td class="people-des">
                            <h5>Environmental Analyst</h5>
                            <p>UTAS</p>
                        </td>

                        <td class="active">
                            <p>Active</p>
                        </td>

                        <td class="role">
                            <p>Advisor</p>
                        </td>

                        <td class="edit">
                            <p><a href="#">Edit</a></p>
                        </td>
                    </tr>


                    <tr>
                        <td class="people">
                            <p><img src="assets/img/userimg.png" /></p>
                            <div class="people-desc">
                                <h5>Harry</h5>
                                <p>harry@email.com</p>
                            </div>
                        </td>

                        <td class="people-des">
                            <h5>Environmental Analyst</h5>
                            <p>UTAS</p>
                        </td>

                        <td class="active">
                            <p>Active</p>
                        </td>

                        <td class="role">
                            <p>Advisor</p>
                        </td>

                        <td class="edit">
                            <p><a href="#">Edit</a></p>
                        </td>
                    </tr>


                    <tr>
                        <td class="people">
                            <p><img src="assets/img/userimg.png" /></p>
                            <div class="people-desc">
                                <h5>Mike</h5>
                                <p>mike@email.com</p>
                            </div>
                        </td>

                        <td class="people-des">
                            <h5>Environmental Analyst</h5>
                            <p>UTAS</p>
                        </td>

                        <td class="active">
                            <p>Active</p>
                        </td>

                        <td class="role">
                            <p>Advisor</p>
                        </td>

                        <td class="edit">
                            <p><a href="#">Edit</a></p>
                        </td>
                    </tr>


                    <tr>
                        <td class="people">
                            <p><img src="assets/img/userimg.png" /></p>
                            <div class="people-desc">
                                <h5>Will</h5>
                                <p>will@email.com</p>
                            </div>
                        </td>

                        <td class="people-des">
                            <h5>Environmental Analyst</h5>
                            <p>UTAS</p>
                        </td>

                        <td class="active">
                            <p>Active</p>
                        </td>

                        <td class="role">
                            <p>Advisor</p>
                        </td>

                        <td class="edit">
                            <p><a href="#">Edit</a></p>
                        </td>
                    </tr>


                    <tr>
                        <td class="people">
                            <p><img src="assets/img/userimg.png" /></p>
                            <div class="people-desc">
                                <h5>Steve</h5>
                                <p>steve@email.com</p>
                            </div>
                        </td>

                        <td class="people-des">
                            <h5>Environmental Analyst</h5>
                            <p>UTAS</p>
                        </td>

                        <td class="active">
                            <p>Active</p>
                        </td>

                        <td class="role">
                            <p>Advisor</p>
                        </td>

                        <td class="edit">
                            <p><a href="#">Edit</a></p>
                        </td>
                    </tr>

                    <tr>
                        <td class="people">
                            <p><img src="assets/img/userimg.png" /></p>
                            <div class="people-desc">
                                <h5>Jack</h5>
                                <p>jack@email.com</p>
                            </div>
                        </td>

                        <td class="people-des">
                            <h5>Environmental Analyst</h5>
                            <p>UTAS</p>
                        </td>

                        <td class="inactive">
                            <p>Inactive</p>
                        </td>

                        <td class="role">
                            <p>Advisor</p>
                        </td>

                        <td class="edit">
                            <p><a href="#">Edit</a></p>
                        </td>
                    </tr>

                    <tr>
                        <td class="people">
                            <p><img src="assets/img/userimg.png" /></p>
                            <div class="people-desc">
                                <h5>Stu</h5>
                                <p>stu@email.com</p>
                            </div>
                        </td>

                        <td class="people-des">
                            <h5>Environmental Analyst</h5>
                            <p>UTAS</p>
                        </td>

                        <td class="active">
                            <p>Active</p>
                        </td>

                        <td class="role">
                            <p>Advisor</p>
                        </td>

                        <td class="edit">
                            <p><a href="#">Edit</a></p>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>



    </section>

    <!-- JS Link for BS 5.2 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    
    <script>
        $('#menu-btn').click(function () {
            $('#menu').toggleClass('active');
        })
    </script>

</body>
</html>