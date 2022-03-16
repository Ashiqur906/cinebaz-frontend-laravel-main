<template>
    <div class="container">
        <video id="video" width="640" height="480" crossorigin="anonymous" controls>
            Your browser does not support HTML5 video.
        </video>
    </div>
</template>

<script>

const AWS = require('aws-sdk');

const privateKey = `-----BEGIN RSA PRIVATE KEY-----
MIIEowIBAAKCAQEAhxfvKpWSs8buUFZwBK+xPE6aSYdSJxBPCeX9RTnDKTMYtAaz
LBHnBgTorBACboBjZK+kOy7tJ1swe49T8Zcn9H9+YzwT5R4sl2VHtjfKA1ElPbRZ
9q9eaSrEPCAhvHPj3AuAUF3xRPx3Qt7QySjx5i9QzE6TD4wkAdywpLQVG87Mh2OD
bk8V0vo7QBMaNbVDaSH5Uc4NVQnjcIRi8d2jbzumlNnpyRk/eY50yZKURUYpMis3
x6QD/hKRs0JnFKijMyYC2WpRPPfTvZgYtlyx10scyL+fOlA3SyQTesDD4VhMhH4M
ID59xQW+wMQVhLJdYYLrSLyLpsW4cmm4k2LHjwIDAQABAoIBAHDKvPczFt9fEo6k
/LYM8s/FWPBXOXJAHZ3IFqR7y8RUUyXMCkCbWeYepx0x6LXWICZqt5ZqYbtgWaRw
UMf/Sm7LG/1CpeHARb7J4wvynIoUcCGKuSpL1Wm9OUZyFXjA0dhhCesP5GeS2whL
/MpXk1B65N0QJZzvhwi++AUsDgu+Zdt7z0EmZCRhRbynY01hiW7ZRi5eItGUn7m7
1N2Z4jSTO0+hiv3WJlnVoqrfWRt4pfpKso3g+lMtN9vaRqwJbQzT7t0/+QHcAutG
RrkqzChhZpTK7Wgzepe1sTqyxPd94ef/J2krE8os1JX8Mxa9lvWTPcOd/nHNeb2H
bsaAR+ECgYEA8/rcNqApRD/p72JcSZS5OMOSVxUxXGhjtJIzrxetqzVEswHkZ9so
EsMLT72TJoBL30S1ieVKq35xApiZoKQQLWBieBws9/Y/xjo2OoUlDdjSBSMZzW9T
ttOq3qhPZqIGAhPK2yjpw+hkoZF6GGYC/jkckmIXHLQewv2tz6mRo6cCgYEAjb/E
9arytrKGXP/L8YPtSoHEWL0aEfyRcRPNZFt4cOcB7YZ9zLbLqUsCTg53zFZlorjE
Ukj/i4M3jEX2kT5Rzy6eGK4uIghsmABLJiQvaNeuQTXS33Luo+pBWX/6n+fnXGzS
ONpGZVfLJHOLjtxz2lHGm0RBZY3nrwx42wvmWdkCgYAj9z4RO2j566YTqN9L5YWs
bYAcID6njaftDYRa8lWioHahIM1H1hHBOklnlt2jVlRY9GsCie+I+lm0dURoXucX
mVbKt/SVFRLvqNMnq0r8EJNdOIBsPVYM5IUSz6Ls0UOreLl1t0FGpPJ4stZZ1Gfq
jAa/OYCItbC3M+g0bZ3PjwKBgQCIeDCwNL0omAg0UTGQfGtgaD8ZEDahSoDcVSxR
ip8SU9XPUMSc6wB5JPY7IELGQAfp+elJL26YauR38IPKoi0xQriDGm7f5SxnyyCO
wBfE4KGrtp4m8wg+V7JC8Kvid+qPWVWr1rofp760gWnDSQthDYogwj4T/+Mm7OMO
QQ6tQQKBgBNnxCrzE4ZJMWCNDZIXqiYXbS8uyBlT4GUJC/ojllRKmQBQAJD8hd7d
YA7cMXN3ftctAKm7T2BbngGeGVtlBQIIsviMSbQ6XQ9RBKHhmg24nIIMn1XpU+zH
hH58hNYnLP4+hK7/cVpQApEYlVaVJod1mP/QTFw7RB+V5IhBY+zo
-----END RSA PRIVATE KEY-----`;

const publicKey = `-----BEGIN PUBLIC KEY-----
MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAhxfvKpWSs8buUFZwBK+x
PE6aSYdSJxBPCeX9RTnDKTMYtAazLBHnBgTorBACboBjZK+kOy7tJ1swe49T8Zcn
9H9+YzwT5R4sl2VHtjfKA1ElPbRZ9q9eaSrEPCAhvHPj3AuAUF3xRPx3Qt7QySjx
5i9QzE6TD4wkAdywpLQVG87Mh2ODbk8V0vo7QBMaNbVDaSH5Uc4NVQnjcIRi8d2j
bzumlNnpyRk/eY50yZKURUYpMis3x6QD/hKRs0JnFKijMyYC2WpRPPfTvZgYtlyx
10scyL+fOlA3SyQTesDD4VhMhH4MID59xQW+wMQVhLJdYYLrSLyLpsW4cmm4k2LH
jwIDAQAB
-----END PUBLIC KEY-----`;
const Public_Access_Key = 'APKAIIG4TPMK45KRBLEQ';


const cloudFront = new AWS.CloudFront.Signer(Public_Access_Key,privateKey);

const expire =Math.floor((new Date()).getTime() / 1000) + (60 * 60 * 1);

// console.log(expire);
cloudFront.getSignedUrl({
     url: 'https://d3hxdpowu5t8n7.cloudfront.net/demo1/chokh.m3u8.m3u8',
     expires: expire
    }, (err, url) => {
        if (err) throw err;
        console.log(url);
    }
);


export default {
    //


    // data() {
    //     return {
    //         url: 'https://d3hxdpowu5t8n7.cloudfront.net/demo1/chokh.m3u8.m3u8',
    //     };
    // }
};

</script>

