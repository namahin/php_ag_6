<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Success</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <section class="">
        <div class="">
            <h1>Registration successfully done</h1>
            <p>Thank you for registering!</p>

            <table class="user-table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Profile Picture</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
				// read users data from CSV file
				$file = fopen('users.csv', 'r');

				while (($data = fgetcsv($file)) !== false) {
					echo "<tr>";
                    echo "<td>{$data[0]}</td>";
                    echo "<td><a href='mailto:{$data[1]}'>{$data[1]}</a></td>";
                    echo "<td><img src='uploads/{$data[2]}'></td>";
					echo "</tr>";
				}

				fclose($file);
			?>
                </tbody>
            </table>
        </div>
    </section>
</body>

</html>