
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
</head>
    <body>
        <table border=1px solid>
        <tr>
            <th> Nama </th>
            <th> Domisili </th>
            <th> Jenis Kelamin </th>
        </tr>
        <?php
        $Dosen = [
            'nama' => 'Elok Nur Hamdana',
            'domisili' => 'Malang',
            'jenis kelamin' => 'perempuan'
            ];
        echo "<tr>";
            echo "<td>{$Dosen['nama']}</td>"; 
            echo "<td>{$Dosen['domisili']}</td>"; 
            echo "<td>{$Dosen['jenis kelamin']}</td>"; 
        echo "</tr>"
        ?>
        </table>
    </body>
</html>
