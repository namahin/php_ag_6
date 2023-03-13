<?php

// check if form is submitted
if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {

    // validate form inputs
    if ( empty( $_POST['name'] ) || empty( $_POST['email'] ) || empty( $_POST['password'] ) || empty( $_FILES['picture'] ) ) {
        die( 'All fields are required.' );
    }

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $picture = $_FILES['picture'];

    // validate email format
    if ( !filter_var( $email, FILTER_VALIDATE_EMAIL ) ) {
        die( 'Invalid email format.' );
    }

    // save profile picture to server
    $upload_dir = 'uploads/';
    $filename = uniqid() . '_' . date( 'Y-m-d_H-i-s' ) . '_' . $picture['name'];

    if ( !move_uploaded_file( $picture['tmp_name'], $upload_dir . $filename ) ) {
        die( 'Error uploading file.' );
    }

    // save user's data to CSV file
    $data = array( $name, $email, $filename );
    $file = fopen( 'users.csv', 'a' );

    if ( fputcsv( $file, $data ) === false ) {
        die( 'Error writing to file.' );
    }

    fclose( $file );

    // start session and set cookie
    session_start();
    setcookie( 'username', $name );

    // redirect to success page
    header( 'Location: userList.php' );
    exit();
}