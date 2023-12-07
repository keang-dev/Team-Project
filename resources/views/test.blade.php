<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <table border="1" width="50%">
        @foreach($roles as $k => $role)
        <tr>
            <td>{{$k+1}}</td>
            <td>{{$role->name}}</td>
            <td>{{$role->total_user}}នាក់</td>
            <td>
                    <?php 
                        $percentages = 100 * $role->total_user / $total;
                        echo $percentages;
                    ?>
                %
            </td>
            <td>{{$role->total_male}}</td>
            <td>{{$role->total_female}}</td>
        </tr>
        @endforeach
        <tr>
            <td colspan="2">Total</td>
            <td>{{$total}}</td>
        </tr>
    </table>
</body>
</html>