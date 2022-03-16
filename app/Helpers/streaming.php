<?php

use Aws\CloudFront\CloudFrontClient;
use Aws\Exception\AwsException;

function signCookie($cloudFrontClient, $resourceKey, $expires, 
    $privateKey, $keyPairId)
{
    try {
        $result = $cloudFrontClient->getSignedCookie([
            'url' => $resourceKey,
            'expires' => $expires, 
            'private_key' => $privateKey,
            'key_pair_id' => $keyPairId
        ]);

        return $result;

    } catch (AwsException $e) {
        return [ 'Error' => $e->getAwsErrorMessage() ];
    }
}

function GetPrivateKey()
{
    $merchantPrivateKey = "MIIEogIBAAKCAQEAn6l8qufj1kyFoVRbsalwXdhf+eWG++p5TIIFXloFg+qKevA7ZGgc5D1PuMG5y02+ulprB87chV7T5V6fVqJ1EyThC8mxJMp1/IRmCavfQPFcQPGxC3StC/yI+W8oqLhwsQkXD14i9NROWkzNYImtN+04AD9zFYoyuapfEMGEKOQinaPkmWydGkMrXRRXSihwCDTORAh3NGx7+gx/RTA/rDnoRhSj382vozsKP7IJRLDtOLHfWLIS19PGXHyZs8Wb1IFAb4xWn8GbWsnhJdpokGPlELIbs2H7jzlQUp8/BCyWegMGYPrU3qcuqGdz2yJiKjnZMuGgX6mWqPmqVjJWHQIDAQABAoIBABEXDEAi+DFNGZSuOe5na56v9X4DQpKeg4Nb+4Ug76wyI8aLBmB2AHmx0mG9YszPMpYx7Xj1fIdOIjJQEZAtbYiyDuC7IxoEDeMMrPtmCUyjSTOuazwFriw1SNgiPODqdS2OAojjk6xPOV/TDrzBn+f3nWHxaLkqhMl44hoiDKpvra8YXHA8eggoy8DDnPohJp542ruC8ySlUuIeQ2pN2GgcngYNbFECuP1F8ycQjAUWvzWzOgwD2d1dtHXaVvNlKjRjYs4oKeFf8mp6V9P7kgcun2IXNNaA0Wwp0ilpX76hYOoN4wTCECkU2rTH18paagnUCd16Dkcv8gDANbtqoQUCgYEA0txT+HjXN/5SHx979mi6ynYQ8seGTbwhYmxwYLCqf7H3FuPka9G4fSIy4JCrLzGPnqYGDvxxr8GULNJzewr/FomQTpcSixXS/s/6ru4ys79Phofcs1100MksP+BZihf4F5Ho+A7ZgXTAf92OgEsLH+LvFXRZVEl28alJXVXpV4cCgYEAwddaOwD7yQEgFz26U5s/ReY9W9HXWYvWMVSjeLv2TjrREEX/0MNqjhDRQu+9f1RQxhJrAtuwiP7V4p1iY616l8ZNoWUMfxoyNGAC+AkJ6MFvzPk2FKrSfkVUnZf8mucgxP6NaIuH8qDb/34CWbNDSrxuuL2yKfToaQ0u838yBjsCgYBd/M+BBXwI/VdlgAclQnFgJVhQnxcCN0U6NdOxhY259X2JunLqjESLol7DMjjbhF/b+2zf6S5ThRmjEPtgcPpa9V5ZaYVecY/m/JVku8/lxvSPpqd9W77iAYmzvzCqGR0AhI0vZI8W4Q+c7wjBrrF6uRCQo5fdthFKjoahD9Y+qQKBgDaXSNEfOMnmKDyDZOtQ6KPt8M/gLC8K49rmxFcnUHm9tM1JeX842dSCxfx8+jhW7Zyq6TpX1sLuShxVSLVb0Q/XiFtw0vEk1ojLlWp3WTQU7kCi2uk9JqTrL6ZmfHy/pQn1yqtryHC7ftnYih7rDoOIyAH9YqTQVXfof5WR9+urAoGAepqLVuyaLOmin0BKfmfOOKydof+kNxVVB3APeAWRlCQdy0jNSgXn1JZ43sWMtjosbGpE7v+xEmj+hQEjnsjNLbvR50AWCFk47L19WJKQ5LzePaeVkrkrfhouIHNE5Ms3XLdGwpNH4Nypse2Pzg48EiogVdOinLzHyHFeJb3Emvo=";
    $private_key = "-----BEGIN RSA PRIVATE KEY-----\n" . $merchantPrivateKey . "\n-----END RSA PRIVATE KEY-----";

    return $private_key;
}

function signACookie($video)
{

    $resourceKey = $video;

    $expires = time() + 3000; // 5 minutes (5 * 60 seconds) from now.
    $privateKey = GetPrivateKey();
    $keyPairId = 'K1PULSVF6KXNHG';

    $cloudFrontClient = new CloudFrontClient([
        'profile' => 'default',
        'version' => '2014-11-06',
        'region' => 'us-east-1'
    ]);

    $result = signCookie($cloudFrontClient, $resourceKey, $expires, 
        $privateKey, $keyPairId);

    /* If successful, returns something like:
    CloudFront-Expires = 1589926678
    CloudFront-Signature = Lv1DyC2q...2HPXaQ__
    CloudFront-Key-Pair-Id = AAPKAJIKZATYYYEXAMPLE
    */

    return $result;
    // foreach($result as $key => $value)
    // {
       
    //     setcookie($key, $value, time() +300);
    //     // echo $key . ' = ' . $value . "\n";
    // }
}

function rsa_sha1_sign($policy, $private_key_filename) {
    $signature = "";
    // load the private key
    $fp = fopen($private_key_filename, "r");
    $priv_key = fread($fp, 8192);
    fclose($fp);
    $pkeyid = openssl_get_privatekey($priv_key);
    // compute signature
    openssl_sign($policy, $signature, $pkeyid);
    // free the key from memory
    openssl_free_key($pkeyid);
    return $signature;
}

function url_safe_base64_encode($value) {
    $encoded = base64_encode($value);
    // replace unsafe characters +, = and / with the safe characters -, _ and ~
    return str_replace(
        array('+', '=', '/'),
        array('-', '_', '~'),
        $encoded);
}

function create_stream_name($stream, $policy, $signature, $key_pair_id, $expires) {
    $result = $stream;
    $path = '';
    // if the stream already contains query parameters, attach the new query parameters to the end
    // otherwise, add the query parameters
    $separator = strpos($stream, '?') == FALSE ? '?' : '&';
    // the presence of an expires time means we're using a canned policy
    if($expires) {
        $result .= $path . $separator . "Expires=" . $expires . "&Signature=" . $signature . "&Key-Pair-Id=" . $key_pair_id;
    }
    // not using a canned policy, include the policy itself in the stream name
    else {
        $result .= $path . $separator . "Policy=" . $policy . "&Signature=" . $signature . "&Key-Pair-Id=" . $key_pair_id;
    }

    // new lines would break us, so remove them
    return str_replace('\n', '', $result);
}

function encode_query_params($stream_name) {
    // Adobe Flash Player has trouble with query parameters being passed into it,
    // so replace the bad characters with their URL-encoded forms
    return $stream_name;
    return str_replace(
        array('?', '=', '&'),
        array('%3F', '%3D', '%26'),
        $stream_name);
}

function get_canned_policy_stream_name($video_path, $private_key_filename, $key_pair_id, $expires) {
    // this policy is well known by CloudFront, but you still need to sign it, since it contains your parameters
    $canned_policy = '{"Statement":[{"Resource":"' . $video_path . '","Condition":{"DateLessThan":{"AWS:EpochTime":'. $expires . '}}}]}';
    // the policy contains characters that cannot be part of a URL, so we base64 encode it
    $encoded_policy = url_safe_base64_encode($canned_policy);
    // sign the original policy, not the encoded version
    $signature = rsa_sha1_sign($canned_policy, $private_key_filename);
    // make the signature safe to be included in a URL
    $encoded_signature = url_safe_base64_encode($signature);

    // combine the above into a stream name
    $stream_name = create_stream_name($video_path, null, $encoded_signature, $key_pair_id, $expires);
    // URL-encode the query string characters to support Flash Player
    // print_r($stream_name);
    return encode_query_params($stream_name);
}

function get_custom_policy_stream_name($video_path, $private_key_filename, $key_pair_id, $policy) {
    // the policy contains characters that cannot be part of a URL, so we base64 encode it
    $encoded_policy = url_safe_base64_encode($policy);
    // sign the original policy, not the encoded version
    $signature = rsa_sha1_sign($policy, $private_key_filename);
    // make the signature safe to be included in a URL
    $encoded_signature = url_safe_base64_encode($signature);

    // combine the above into a stream name
    $stream_name = create_stream_name($video_path, $encoded_policy, $encoded_signature, $key_pair_id, null);
    // URL-encode the query string characters to support Flash Player
    return encode_query_params($stream_name);
}

function getStram(){
    $private_key_filename = 'http://localhost:9000/private_key.pem';
    $key_pair_id = 'K1PULSVF6KXNHG';

    // $video_path = 'https://d1i3sxhupzjlf.cloudfront.net/chokhchokh.m3u8';
    $video_path = 'https://d1i3sxhupzjlf.cloudfront.net/chokh.mp4';

    $expires = time() + 3000; // 5 min from now
    return get_canned_policy_stream_name($video_path, $private_key_filename, $key_pair_id, $expires);
}

