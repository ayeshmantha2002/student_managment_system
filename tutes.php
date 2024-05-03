<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> TUTES </title>
    <link rel="stylesheet" href="assect/css/style.css">
</head>

<body>
    <div class="webcontent">
        <?php
        include("includes/sidenav.php");
        ?>

        <section class="content">
            <div class="date">
                <h1> TUTES </h1>
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
                        <h2> Add Tutes </h2>
                        <br>
                        <form method="post">
                            <p>
                                <label for="tname"> Tute Name : </label>
                                <input type="text" name="tname" id="tname" placeholder="Tute Name" required>
                            </p>
                            <br>
                            <p>
                                <label for="num_tutes"> Number of tute : </label>
                                <input type="number" name="num_tutes" id="num_tutes" placeholder="Number of tute" required>
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
                                <label for="date"> Delivery start date : </label>
                                <input type="date" name="date" id="date" min="<?= date("Y-m-d") ?>" required>
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
                            <th> Tude Number </th>
                            <th> Tute Name </th>
                            <th> Class </th>
                            <th> Total Tutes </th>
                            <th> Delivery start date </th>
                            <th> Remaining </th>
                            <th colspan="2"> Action </th>
                        </tr>
                        <tr>
                            <td> 01 </td>
                            <td> Shakthi widyawa </td>
                            <td> 2024 </td>
                            <td> 25 / 200 </td>
                            <td> 2024-05-02 </td>
                            <td> 175 </td>
                            <td> <a href="#">Edit</a> </td>
                            <td> <span class="delete"> <a href="#">Delete</a> </span> </td>
                        </tr>
                        <tr>
                            <td> 02 </td>
                            <td> Shakthi widyawa </td>
                            <td> 2024 </td>
                            <td> 25 / 200 </td>
                            <td> 2024-05-02 </td>
                            <td> 175 </td>
                            <td> <a href="#">Edit</a> </td>
                            <td> <span class="delete"> <a href="#">Delete</a> </span> </td>
                        </tr>
                        <tr>
                            <td> 01 </td>
                            <td> Shakthi widyawa </td>
                            <td> 2024 </td>
                            <td> 25 / 200 </td>
                            <td> 2024-05-02 </td>
                            <td> 175 </td>
                            <td> <a href="#">Edit</a> </td>
                            <td> <span class="delete"> <a href="#">Delete</a> </span> </td>
                        </tr>
                        <tr>
                            <td> 01 </td>
                            <td> Shakthi widyawa </td>
                            <td> 2024 </td>
                            <td> 25 / 200 </td>
                            <td> 2024-05-02 </td>
                            <td> 175 </td>
                            <td> <a href="#">Edit</a> </td>
                            <td> <span class="delete"> <a href="#">Delete</a> </span> </td>
                        </tr>
                    </table>
                </div>
            </div>
        </section>
    </div>

    <script src="assect/js/jquery.min.js"></script>
    <script src="assect/js/secu.js"></script>
    <script src="assect/js/main.js"></script>
</body>

</html>