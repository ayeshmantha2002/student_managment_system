<?php
include("includes/connection.php");

if (isset($_POST['query'])) {
    $query = mysqli_real_escape_string($connection, $_POST['query']);

    $sql = "SELECT * FROM `student` WHERE (`Student_ID` LIKE '%{$query}%' OR `First_name` LIKE '%{$query}%' OR `Last_name` LIKE '%{$query}%') ORDER BY `Class` DESC, `Student_ID` DESC";
    $result = mysqli_query($connection, $sql);

    if (mysqli_num_rows($result) > 0) {
        echo "<table>
                <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Class</th>
                    <th colspan='3' style='text-align: center;'> Action </th>
                </tr>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                    <td>{$row['Student_ID']}</td>
                    <td>{$row['First_name']}</td>
                    <td>{$row['Last_name']}</td>
                    <td>{$row['Class']}</td>
                    <td>
                        <a href='user-list.php?edit_student_id={$row['ID']}'>Edit</a>
                    </td>
                    <td>
                        <span class='delete'> <a href='user-list.php?remove_student_id={$row['ID']}' class='delete' onclick='return confirm(\"Are you sure you want to delete this student?\");'>Delete</a> </span>
                    </td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No students found.</p>";
    }
}
