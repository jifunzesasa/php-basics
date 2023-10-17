# open ssl with php

To generate a PFX key using OpenSSL and then read it in PHP, you can follow these steps:

1. Generate a self-signed certificate and private key using OpenSSL:

```bash
openssl req -x509 -nodes -days 365 -newkey rsa:2048 -keyout certificate.key -out certificate.crt
```

This command generates a self-signed certificate (`certificate.crt`) and a private key (`certificate.key`).

2. Combine the certificate and private key into a PFX file:

```bash
openssl pkcs12 -export -out certificate.pfx -inkey certificate.key -in certificate.crt
```

This command creates a PFX file (`certificate.pfx`) that contains both the private key and the certificate.

3. Now, let's write PHP code to read the PFX file and extract the private key and certificate:

```php
<?php
$pfxFile = 'certificate.pfx';
$password = 'your_pfx_password'; // Enter the password used when creating the PFX file

// Load the PFX file
if (openssl_pkcs12_read(file_get_contents($pfxFile), $certs, $password)) {
    $privateKey = $certs['pkey']; // Private key
    $certificate = $certs['cert']; // Certificate

    // Save or use the private key and certificate as needed
    // For example, you can save them to files or use them for TLS/SSL connections.

    // Save private key to a file
    file_put_contents('private_key.pem', $privateKey);

    // Save certificate to a file
    file_put_contents('certificate.pem', $certificate);

    echo "Private key and certificate extracted and saved.";
} else {
    echo "Failed to read the PFX file or incorrect password.";
}
?>
```

Make sure to replace `'your_pfx_password'` with the actual password you used when creating the PFX file. 

This code will read the PFX file, extract the private key and certificate, and save them to separate files, but you can modify it to suit your specific use case.