<?php

$pfxFile = 'certificate.pfx';
// Enter the password used when creating the PFX file
$password = 'your_pfx_password';

// check if openssl is installed
if (!extension_loaded('openssl')) {
    die('The OpenSSL extension is not loaded.');
}

// check if file exists
if (!file_exists($pfxFile)) {
    die('The PFX file not found.');
}

// Load the PFX file
if (openssl_pkcs12_read(file_get_contents($pfxFile), $certs, $password)) {
    $privateKey = $certs['pkey']; // Private key
    $certificate = $certs['cert']; // Certificate

    // Save or use the private key and certificate as needed
    // For example, you can save them to files or use them for TLS/SSL connections.

    // // Save private key to a file
    // file_put_contents('private_key.pem', $privateKey);
    // echo "Private key";

    // // Save certificate to a file
    // file_put_contents('certificate.pem', $certificate);
    // echo "Certificate";

    echo "Private key and certificate extracted and saved.";
} else {
    echo "Failed to read the PFX file or incorrect password.";
}

