<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> STUDENTS LIST </title>
    <link rel="stylesheet" href="assect/css/style.css">
</head>

<body>
    <div class="webcontent">
        <?php
        include("includes/sidenav.php");
        ?>

        <section class="content">
            <div class="date">
                <h1> STUDENTS LIST </h1>
                <h1> <?php echo date("Y-m-d"); ?> </h1>
            </div>
            <br>
            <div class="search">
                <form method="post">
                    <p> <input type="search" name="search" placeholder="Search student number or name."> </p>
                </form>
            </div>
            <br>
            <div class="main_airea">
                <div class="filters">
                    <div>
                        <h2> Filter Option </h2>
                        <br>
                        <ul>
                            <li> <a href="#"> 2024 </a> </li>
                            <li> <a href="#"> 2025 </a> </li>
                            <li> <a href="#"> 2026 </a> </li>
                        </ul>
                    </div>
                    <div>
                        <h2> Add Student </h2>
                        <br>
                        <form method="post">
                            <p>
                                <label for="number"> Student ID : </label>
                                <input type="text" name="number" id="number" placeholder="Student ID" required>
                            </p>
                            <br>
                            <p>
                                <label for="fname"> First name : </label>
                                <input type="text" name="fname" id="fname" placeholder="First name" required>
                            </p>
                            <br>
                            <p>
                                <label for="Lname"> Last name : </label>
                                <input type="text" name="Lname" id="Lname" placeholder="Last name" required>
                            </p>
                            <br>
                            <p>
                                <label for="year"> Chooce Year : </label>
                                <select name="year" required>
                                    <option value=""> Chooce Year </option>
                                    <option value="2024"> 2024 </option>
                                    <option value="2025"> 2025 </option>
                                    <option value="2026"> 2026 </option>
                                </select>
                            </p>
                            <br>
                            <p>
                                <input type="submit" value="Add Student">
                            </p>
                        </form>
                    </div>
                </div>
                <div class="students">
                    <table>
                        <tr>
                            <th> ID </th>
                            <th> First Name </th>
                            <th> Last Name </th>
                            <th> Class </th>
                            <th colspan="2" style="text-align: center;"> Action </th>
                        </tr>
                        <tr>
                            <td> 01 </td>
                            <td> Sameera </td>
                            <td> Ayeshmantha </td>
                            <td> 2024 </td>
                            <td style="text-align: center; max-width: 50px;"> <a href="#">Edit</a> </td>
                            <td style="text-align: center; max-width: 50px;"> <span class="delete"> <a href="#">Delete</a> </span> </td>
                        </tr>
                        <tr>
                            <td> 02 </td>
                            <td> Saman </td>
                            <td> Kumara </td>
                            <td> 2024 </td>
                            <td style="text-align: center; max-width: 50px;"> <a href="#">Edit</a> </td>
                            <td style="text-align: center; max-width: 50px;"> <span class="delete"> <a href="#">Delete</a> </span> </td>
                        </tr>
                        <tr>
                            <td> 03 </td>
                            <td> Kasun </td>
                            <td> Kalhara </td>
                            <td> 2024 </td>
                            <td style="text-align: center; max-width: 50px;"> <a href="#">Edit</a> </td>
                            <td style="text-align: center; max-width: 50px;"> <span class="delete"> <a href="#">Delete</a> </span> </td>
                        </tr>
                        <tr>
                            <td> 04 </td>
                            <td> Pradeep </td>
                            <td> Rangana </td>
                            <td> 2024 </td>
                            <td style="text-align: center; max-width: 50px;"> <a href="#">Edit</a> </td>
                            <td style="text-align: center; max-width: 50px;"> <span class="delete"> <a href="#">Delete</a> </span> </td>
                        </tr>
                        <tr>
                            <td> 05 </td>
                            <td> Piyath </td>
                            <td> Rajapaksha </td>
                            <td> 2024 </td>
                            <td style="text-align: center; max-width: 50px;"> <a href="#">Edit</a> </td>
                            <td style="text-align: center; max-width: 50px;"> <span class="delete"> <a href="#">Delete</a> </span> </td>
                        </tr>
                        <tr>
                            <td> 06 </td>
                            <td> Sumudu </td>
                            <td> Perera </td>
                            <td> 2024 </td>
                            <td style="text-align: center; max-width: 50px;"> <a href="#">Edit</a> </td>
                            <td style="text-align: center; max-width: 50px;"> <span class="delete"> <a href="#">Delete</a> </span> </td>
                        </tr>
                        <tr>
                            <td> 07 </td>
                            <td> Gayan </td>
                            <td> Kanishka </td>
                            <td> 2024 </td>
                            <td style="text-align: center; max-width: 50px;"> <a href="#">Edit</a> </td>
                            <td style="text-align: center; max-width: 50px;"> <span class="delete"> <a href="#">Delete</a> </span> </td>
                        </tr>
                        <tr>
                            <td> 08 </td>
                            <td> Ruwan </td>
                            <td> Hettiarachchi </td>
                            <td> 2024 </td>
                            <td style="text-align: center; max-width: 50px;"> <a href="#">Edit</a> </td>
                            <td style="text-align: center; max-width: 50px;"> <span class="delete"> <a href="#">Delete</a> </span> </td>
                        </tr>
                        <tr>
                            <td> 09 </td>
                            <td> Thisara </td>
                            <td> Perera </td>
                            <td> 2024 </td>
                            <td style="text-align: center; max-width: 50px;"> <a href="#">Edit</a> </td>
                            <td style="text-align: center; max-width: 50px;"> <span class="delete"> <a href="#">Delete</a> </span> </td>
                        </tr>
                        <tr>
                            <td> 10 </td>
                            <td> Vimukthi </td>
                            <td> Lakshan </td>
                            <td> 2024 </td>
                            <td style="text-align: center; max-width: 50px;"> <a href="#">Edit</a> </td>
                            <td style="text-align: center; max-width: 50px;"> <span class="delete"> <a href="#">Delete</a> </span> </td>
                        </tr>
                        <tr>
                            <td> 11 </td>
                            <td> Teshan </td>
                            <td> Silva </td>
                            <td> 2024 </td>
                            <td style="text-align: center; max-width: 50px;"> <a href="#">Edit</a> </td>
                            <td style="text-align: center; max-width: 50px;"> <span class="delete"> <a href="#">Delete</a> </span> </td>
                        </tr>
                        <tr>
                            <td> 12 </td>
                            <td> Shiran </td>
                            <td> Madhuwantha </td>
                            <td> 2024 </td>
                            <td style="text-align: center; max-width: 50px;"> <a href="#">Edit</a> </td>
                            <td style="text-align: center; max-width: 50px;"> <span class="delete"> <a href="#">Delete</a> </span> </td>
                        </tr>
                    </table>
                </div>
            </div>
        </section>
    </div>

    <script src="assect/js/secu.js"></script>
    <script src="assect/js/jquery.min.js"></script>
    <script src="assect/js/main.js"></script>
</body>

</html>