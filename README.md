# Overview
An attempt to reproduce the multiple set-cookies from here
https://groups.google.com/forum/#!topic/simplesamlphp/Zhpc78whHNU

# Steps to reproduce

Run an SSP docker instance and add in the test-cookie.php. This assumes you can listen on port 443.

    docker run --name cookie-test -d -p 443:443 -v $PWD/www/cookie-test.php:/var/simplesamlphp/www/cookie-test.php cirrusid/ssp-base

Then user `curl` to get the headers

```bash
$ curl -i -k https://127.0.0.1/simplesaml/cookie-test.php
HTTP/1.1 200 OK
Date: Fri, 24 Aug 2018 21:02:38 GMT
Server: Apache/2.4.10 (Debian)
X-Powered-By: PHP/5.6.33
Set-Cookie: test=b40a4f83c1ad7543f805567891a2c306; path=/
Expires: Thu, 19 Nov 1981 08:52:00 GMT
Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0
Pragma: no-cache
Set-Cookie: SimpleSAML=c55c2c9718495c9b21e27332a79a2cdc; path=/; HttpOnly
Set-Cookie: test=b40a4f83c1ad7543f805567891a2c306; path=/
Set-Cookie: test=b2bb22e62f5b0d98e5be87d4a560a852; path=/
Content-Length: 2
Content-Type: text/html; charset=UTF-8
```

In the above I see the `test` cookie is set 3 times

# Browsing the config

The SSP image is based on https://github.com/cirrusidentity/docker-simplesamlphp/blob/master/ssp-base/Dockerfile
It has minimal configuration changes from a clean install. You can view the changes by diffing

     docker exec -it cookie-test diff /var/simplesamlphp/config/config.php  /var/simplesamlphp/config/config.php.bak


If you need on the container you can do.

     docker exec -it cookie-test bash
