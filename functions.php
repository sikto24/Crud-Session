<?php
define("DB_NAME", "C:\\xampp\\htdocs\\learnphp\\crud\\data\\data.csv");
function seed()
{
    $data = array(
        array(
            "fName" => "Md Abu Al",
            "lName" => "Sayed",
            "roll" => "82",
            "id" => "1",
        ),
        array(
            "fName" => "shafayat",
            "lName" => "Hossain",
            "roll" => "91",
            "id" => "2",
        ),
        array(
            "fName" => "Sufol",
            "lName" => "Mondol",
            "roll" => "99",
            "id" => "3",
        ),
        array(
            "fName" => "Jahanara",
            "lName" => "Ferdous",
            "roll" => "90",
            "id" => "4",
        ),
        array(
            "fName" => "Ibrahim",
            "lName" => "Kholil",
            "roll" => "18",
            "id" => "5",
        ),
        array(
            "fName" => "Mosiur",
            "lName" => "Rahman",
            "roll" => "42",
            "id" => "6",
        ),

    );

    $dataJson = json_encode($data);

    file_put_contents(DB_NAME, $dataJson, LOCK_EX);
}

function getReport()
{

    if (file_exists(DB_NAME)) {
        $fileName = file_get_contents(DB_NAME);
        $students = json_decode($fileName, true);
    }

    if (!empty($fileName)) :
?>

        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Roll</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>

                <?php

                // usort($students, function ($a, $b) {
                //     if ($b['roll'] == $a['roll']) return 0;
                //     return ($b['roll'] < $a['roll']) ? -1 : 1;
                // });


                foreach ($students as $student) {
                ?>
                    <tr>

                        <td><?php printf("%s %s", $student['fName'], $student['lName']); ?></td>
                        <td><?php printf("%s", $student['roll']); ?></td>
                        <td><?php printf("<a href='index.php?task=edit&id=%s'>Edit</a> | <a class='delete' href='index.php?task=delete&id=%s'>Delete</a>", $student['id'], $student['id']); ?></td>
                    </tr>

                <?php
                }
                ?>


            </tbody>


        </table>


<?php
    endif;
}


function addStudent($fName, $lName,  $roll)
{
    $found = false;
    if (file_exists(DB_NAME)) {
        $fileName = file_get_contents(DB_NAME);
        $students = json_decode($fileName, true);
    }
    foreach ($students as $_student) {
        if ($_student['roll'] == $roll) {
            $found = true;
            break;
        }
    }
    if (!$found) {

        $newID = getNewId($students);
        $student = array(
            "fName" => $fName,
            "lName" => $lName,
            "roll" => $roll,
            "id" => $newID,
        );



        array_push($students, $student);
        $dataJson = json_encode($students);
        file_put_contents(DB_NAME, $dataJson, LOCK_EX);

        return true;
    }
    return false;
}


function getStudent($id)
{
    if (file_exists(DB_NAME)) {
        $fileName = file_get_contents(DB_NAME);
        $students = json_decode($fileName, true);
    }
    foreach ($students as $student) {
        if ($student['id'] == $id) {
            return $student;
        }
    }
    return false;
}


function updateStudent($fName, $lName, $roll, $id)
{
    $found = false;
    if (file_exists(DB_NAME)) {
        $fileName = file_get_contents(DB_NAME);
        $students = json_decode($fileName, true);
    }

    foreach ($students as $student) {
        if ($student['roll'] == $roll &&  $student['id'] != $id) {
            $found = true;
            break;
        }
    }

    if (!$found) {
        $students[$id - 1]['fName'] = $fName;
        $students[$id - 1]['lName'] = $lName;
        $students[$id - 1]['roll'] = $roll;

        $dataJson = json_encode($students);
        file_put_contents(DB_NAME, $dataJson, LOCK_EX);
        return true;
    }
    return false;
}


function deleteUser($id)
{
    if (file_exists(DB_NAME)) {
        $fileName = file_get_contents(DB_NAME);
        $students = json_decode($fileName, true);
        foreach ($students as $offset => $student) {
            if ($student['id'] == $id) {
                unset($students[$offset]);
            }
        }
        $dataJson = json_encode($students);
        file_put_contents(DB_NAME, $dataJson, LOCK_EX);
    }
}





// function getNewId($students)
// {
//     $maxId = max(array_column($students, 'id'));
//     $max = $maxId + 1;
//     return $max;
// }
$maxId = 0;
function getNewId(array $students): int
{
    global $maxId;
    foreach ($students as $student) {
        if ($student['id'] > $maxId) {
            $maxId = $student['id'];
        }
    }
    return $maxId + 1;
}



function hello()
{
    $fileName = file_get_contents(DB_NAME);
    $students = json_decode($fileName, true);
    $newIds = getNewId($students);
    echo $newIds;
}
function printRaw()
{
    if (file_exists(DB_NAME)) {
        $fileName = file_get_contents(DB_NAME);
        $students = json_decode($fileName, true);

        print_r($students);
    }
}
