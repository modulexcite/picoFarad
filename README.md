PicoFarad: A minimalist micro-framework for PHP
===============================================

A very simple library to build a REST API or a small webapp.

Features
--------

- No dependency
- Easy to use, fast and very lightweight
- Only 4 files: Request, Response, Router and Session

Requirements
------------

- PHP >= 5.3 or 5.4

Router
------

Response
--------

### Send a JSON response

    use PicoFarad\Response;

    $data = array(....);

    // Output the encoded JSON data with a HTTP status 200 Ok
    Response\json($data);

    // Change the default HTTP status code by a 400 Bad Request
    Response\json($data, 400);

### Send text response

    Response\text('my text data');

### Send HTML response

    Response\html('<html...>');

### Send XML response

    Response\xml('<xml ... >');

### Send binary response

    Response\binary($my_file_content);

### Force browser download

    Response\force_download('The name of the ouput file');

### Change the HTTP status code

    Response\status(403);

### Redirection

    Response\redirect('http://....');

### Secure headers

    // Send the header X-Content-Type-Options: nosniff
    Response\nosniff();

    // Send the header X-XSS-Protection: 1; mode=block
    Response\xss()

    // Send the header Strict-Transport-Security: max-age=31536000
    Response\function hsts();

    // Send the header X-Frame-Options: DENY
    Response\xframe();

### Content Security Policies

    Response\csp(array(
        'img-src' => '*'
    ));

    // Send these headers:
    // Content-Security-Policy: img-src *; default-src 'self';
    // X-Content-Security-Policy: img-src *; default-src 'self';
    // X-WebKit-CSP: img-src *; default-src 'self';

Request
-------

### Get querystring variables

    use PicoFarad\Request;

    // Get from the URL: ?toto=value
    echo Request\param('toto');

    // Get only integer value: ?toto=2
    echo Request\int_param('toto');

### Get the raw body

    echo Request\body();

### Get decoded JSON body or form values

If a form is submited, you got an array of values.
If the body is a JSON encoded string you got an array of the decoded JSON.

    print_r(Request\values());

### Get the content of a uploaded file

    echo Request\file_content('field_form_name');

Session
-------

### Open and close a session

The session cookie have the following settings:

- Cookie lifetime: 2678400 seconds (31 days)
- Limited to a specified path (http://domain/mywebapp/) or not (http://domain/)
- If the connection is HTTPS, the cookie use the secure flag
- The cookie is HttpOnly, not available from Javascript

Example:

    use PicoFarad\Session;

    // Session start
    Session\open('mywebappdirectory');

    // Destroy the session
    Session\close();

### Flash messages

Set the session variables: `$_SESSION['flash_message']` and `$_SESSION['flash_error_message']`.
In your template, use a helper to display and delete these messages.

    // Standard message
    Session\flash('My message');

    // Error message
    Session\flash_error('My error message');