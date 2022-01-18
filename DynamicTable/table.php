<?php


$users = [
    (object)[
        'id' => 1,
        'name' => 'ahmed',
        "gender" => (object)[
            'gender' => 'm'
        ],
        'hobbies' => [
            'football', 'swimming', 'running'
        ],
        'activities' => [
            "school" => 'drawing',
            'home' => 'painting'
        ],

    ],
    (object)[
        'id' => 2,
        'name' => 'mohamed',
        "gender" => (object)[
            'gender' => 'm'
        ],
        'hobbies' => [
            'swimming', 'running',
        ],
        'activities' => [
            "school" => 'painting',
            'home' => 'drawing'
        ]

    ],
    (object)[
        'id' => 3,
        'name' => 'mena',
        "gender" => (object)[
            'gender' => 'f'
        ],
        'hobbies' => [
            'running',
        ],
        'activities' => [
            "school" => 'painting',
            'home' => 'drawing'
        ]
    ]
];

//echo $users[0]->gender->gender;


?>

<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>

    <table class="table table-dark" border="1">

        <tr>
            <?php foreach ($users[0] as $key => $value) {

                echo " <td>" . $key . "</td>";
            }

            ?>
        </tr>

        <tr>
            <?php

            foreach ($users as $index => $value) {
                $infoarray = [];

                foreach ($value as $interValue => $inervalue) {


                    // echo implode("");
                    //    echo is_array($);
                    // $info = $inervalue;


                    // foreach ($array_St as $keys  => $values) {

                    //     echo "<td> " . $values . "</td>";
                    //     // array_push($value);

                    // }

                    // foreach ($value->gender as $gender => $kind) {
                    //     $info .= $kind . " ";
                    // }
                    // foreach ($value->hobbies as $hopy => $type) {
                    //     $info .= $type . ",";
                    // }
                    // foreach ($value->activities as $activity => $sport) {
                    //     $info .= " " . $sport;
                    // }
                    // $array_St = explode(' ', $info);

                       //    echo $inervalue ." ";
                        array_push( $infoarray,$inervalue);
                        //print_r($infoarray);
                        

                }

              //      echo "<td> " . $values . "</td>";
            }

            ?>

        </tr>
    </table>





    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>